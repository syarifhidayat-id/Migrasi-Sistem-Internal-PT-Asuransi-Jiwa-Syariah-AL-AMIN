<?php

namespace App\Http\Controllers\Tehnik\Soc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadTarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'mth_tipe_pertanggungan' => 'required',
            'mth_ket' => 'required',
            'mth_tipe_rumus' => 'required',
            'mth_kolom' => 'required',
            'mth_baris' => 'required',
            'mth_file' => 'required|mimes:xls,xlsx',
        ],
        [
            'mth_tipe_pertanggungan.required'=>'Data dipertemukan harus terisi!',
            'mth_ket.required'=>'Data keterangan harus terisi!',
            'mth_tipe_rumus.required'=>'Data perhitungan tarif harus terisi!',
            'mth_kolom.required'=>'Data kolom harus terisi!',
            'mth_baris.required'=>'Data baris harus terisi!',
            'mth_file.required'=>'File excel harus terisi!',
            'mth_file.mimes'=>'File harus berbentuk *xlsx!',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            $vtable = DB::table('emst.mst_tarif');
            $kodeImportTarif = __getpx($vtable->max('mth_nomor'), 14);
            $data = $request->all();
            $data = $request->except(
                '_token',
            );
            if ($request->hasFile('mth_file')) {
                $mth_file = $request->file('mth_file');
                $dir = 'public/tehnik/soc/import/import-tarif';
                $fileOri = $mth_file->getClientOriginalName();
                $namaFile = $kodeImportTarif . '-ImportTarif-' . $fileOri;
                $path = Storage::putFileAs($dir, $mth_file, $namaFile);
                $data['mth_file'] = $namaFile;
            }
            $data['mth_nomor'] = $kodeImportTarif;
            $data['mth_tanggal'] = date('Y-m-d');

            // $importTarif = new UploadTarifSocImport($kodeImportTarif, $kolom, $baris);
            // Excel::import($importTarif, $mth_file);

            $objReader = IOFactory::createReader('Xlsx');
            $objReader->setReadDataOnly(TRUE);
            $objPHPExcel = $objReader->load($mth_file);
            $objWorkSheet = $objPHPExcel->getActiveSheet();

            $highestRow = $objWorkSheet->getHighestRow();
            $highestColumn = $objWorkSheet->getHighestColumn();
            $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
            $tinggiRow = $highestRow;
            $tinggiCol = $highestColumnIndex-1;
            $rows = array();
            $colxls = strval($request->mth_kolom+1);
            $rowxls = strval($request->mth_baris+1);

            $row=0;
            for ($row=2; $row <= $rowxls; $row++) {
                $vtable2 = DB::table('emst.mst_tarif_usia_jwaktu');
                $rows['mstuj_pk'] = __getpx($vtable2->max('mstuj_pk'), 18);
                $rows['mstuj_mth_pk'] = $kodeImportTarif;
                for ($col1=0; $col1 <= $tinggiCol; $col1++) {
                    $value = $objWorkSheet->getCellByColumnAndRow($col1+1, $row)->getValue();
                    $scol="mstuj_".($col1-1);
                    if ($col1==0) {
                        $scol="mstuj_usia";
                    }
                    $rows[$scol] = $value;
                }
                if ($colxls == $tinggiCol && $rowxls == $tinggiRow) {
                    $vtable2->insert($rows);
                }
            }

            if ($colxls == $tinggiCol && $rowxls == $tinggiRow) {
                $vtable->insert($data);
                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode '.$kodeImportTarif.'!',
                    'kode' => $kodeImportTarif
                ]);
            } else {
                return response()->json([
                    'errors' => 'Data excel tidak sesuai dengan jumlah kolom atau jumlah baris yang di inputkan!'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateTarif(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'mth_final' => 'required',
        ],
        [
            'mth_final.required'=>'Konfirmasi harus terisi!',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            $vtable = DB::table('emst.mst_tarif')->where('mth_nomor' ,$request->kode_import_tarif);
            if ($request->mth_final == 1) {
                $data = $request->all();
                $data = $request->except(
                    '_token',
                    'kode_import_tarif',
                );
                $vtable->update($data);

                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode '.$request->kode_import_tarif.'!'
                ]);
            } else if ($request->mth_final == 0) {
                $vtable->delete();
                DB::table('emst.mst_tarif_usia_jwaktu')->where('mstuj_mth_pk', $request->kode_import_tarif)->delete();

                return response()->json([
                    'success' => 'Data berhasil dihapus dengan Kode '.$request->kode_import_tarif.'!'
                ]);
            }
        }
    }
}
