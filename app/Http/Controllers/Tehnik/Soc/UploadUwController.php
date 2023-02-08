<?php

namespace App\Http\Controllers\tehnik\Soc;

use App\Http\Controllers\Controller;
use App\Http\Controllers\wwLib\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadUwController extends Controller
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
            'mpuw_tipe_pertanggungan' => 'required',
            'mpuw_nama' => 'required',
            'mpuw_type_uw' => 'required',
            'mpuw_baris' => 'required',
            'mpuw_file' => 'required|mimes:xls,xlsx',
        ],
        [
            'mpuw_tipe_pertanggungan.required'=>'Data dipertemukan harus terisi!',
            'mpuw_nama.required'=>'Data keterangan harus terisi!',
            'mpuw_type_uw.required'=>'Data tipe uw harus terisi!',
            'mpuw_baris.required'=>'Data baris harus terisi!',
            'mpuw_file.required'=>'File excel harus terisi!',
            'mpuw_file.mimes'=>'File harus berbentuk *xlsx!',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            $vtable = DB::table('emst.mst_polis_uwtable');
            $kodeImportUw = Lib::__getpx($vtable->max('mpuw_nomor'), 14);
            $data = $request->all();
            $data = $request->except('_token');
            if ($request->hasFile('mpuw_file')) {
                $mpuw_file = $request->file('mpuw_file');
                $dir = 'public/tehnik/soc/import/import-uw';
                $fileOri = $mpuw_file->getClientOriginalName();
                $namaFile = $kodeImportUw . '-ImportUw-' . $fileOri;
                $path = Storage::putFileAs($dir, $mpuw_file, $namaFile);
                $data['mpuw_file'] = $namaFile;
            }
            $data['mpuw_nomor'] = $kodeImportUw;
            $data['mpuw_tanggal'] = date('Y-m-d H:i:s');

            // $importTarif = new UploadTarifSocImport($kodeImportTarif, $kolom, $baris);
            // Excel::import($importTarif, $mth_file);

            $objReader = IOFactory::createReader('Xlsx');
            $objReader->setReadDataOnly(TRUE);
            $objPHPExcel = $objReader->load($mpuw_file);
            $objWorkSheet = $objPHPExcel->getActiveSheet();

            $highestRow = $objWorkSheet->getHighestRow();
            $highestColumn = $objWorkSheet->getHighestColumn();
            $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
            $tinggiRow = $highestRow;
            $tinggiCol = $highestColumnIndex-1;
            $rows = array();
            $rowxls = strval($request->mpuw_baris+1);

            $row=0;
            for ($row=2; $row <= $rowxls; $row++) {
                $vtable2 = DB::table('emst.mst_polis_uwtable_dtl');
                $rows['mrmp_pk'] = Lib::__getpx($vtable2->max('mrmp_pk'), 18);
                $rows['mrmp_mpuw_nomor'] = $kodeImportUw;
                $rows['mrmp_tipe_masa'] = $objWorkSheet->getCellByColumnAndRow(1, $row)->getCalculatedValue();
                $rows['mrmp_masa'] = $objWorkSheet->getCellByColumnAndRow(2, $row)->getCalculatedValue();
                $rows['mrmp_tipe_peserta'] = $objWorkSheet->getCellByColumnAndRow(3, $row)->getCalculatedValue();
                $rows['mrmp_ket1'] = $objWorkSheet->getCellByColumnAndRow(4, $row)->getCalculatedValue();
                $rows['mrmp_ket2'] = $objWorkSheet->getCellByColumnAndRow(5, $row)->getCalculatedValue();
                $rows['mrmp_urut'] = $objWorkSheet->getCellByColumnAndRow(6, $row)->getCalculatedValue();
                $rows['mrmp_min_umur'] = $objWorkSheet->getCellByColumnAndRow(7, $row)->getCalculatedValue();
                $rows['mrmp_max_umur'] = $objWorkSheet->getCellByColumnAndRow(8, $row)->getCalculatedValue();
                $rows['mrmp_total_min'] = $objWorkSheet->getCellByColumnAndRow(9, $row)->getCalculatedValue();
                $rows['mrmp_total_max'] = $objWorkSheet->getCellByColumnAndRow(10, $row)->getCalculatedValue();
                $rows['mrmp_xn_max'] = $objWorkSheet->getCellByColumnAndRow(11, $row)->getCalculatedValue();

                if ($rowxls == $tinggiRow) {
                    $vtable2->insert($rows);
                }
            }

            if ($rowxls == $tinggiRow) {
                $vtable->insert($data);
                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode '.$kodeImportUw.'!',
                    'kode' => $kodeImportUw
                ]);
            } else {
                return response()->json([
                    'errors' => 'Data excel tidak sesuai dengan jumlah baris yang di inputkan!'
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

    public function updateUw(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'mpuw_final' => 'required',
        ],
        [
            'mpuw_final.required'=>'Konfirmasi harus terisi!',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            $vtable = DB::table('emst.mst_polis_uwtable')->where('mpuw_nomor' ,$request->kode_import_uw);
            if ($request->mpuw_final == 1) {
                $data = $request->all();
                $data = $request->except(
                    '_token',
                    'kode_import_uw',
                );
                $vtable->update($data);

                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode '.$request->kode_import_uw.'!'
                ]);
            } else if ($request->mpuw_final == 0) {
                $vtable->delete();
                DB::table('emst.mst_polis_uwtable_dtl')->where('mrmp_mpuw_nomor', $request->kode_import_uw)->delete();

                return response()->json([
                    'success' => 'Data berhasil dihapus dengan Kode '.$request->kode_import_uw.'!'
                ]);
            }
        }
    }
}
