<?php

namespace App\Http\Controllers\Tehnik\Soc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EntrySocKhususController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tehnik.soc.entrytarifuw-lokasikhusus.create');
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
        extract($_GET);
        extract($_POST);
        $vtable = "";
        $valid = "";

        if ($_GET['id']=="formSocKhusus") {
            $vtable = "eopr.mst_soc_tarifuw_dtl";
            $valid = __valid($request->all(), [
                'msoc_mrkn_nama' => 'required',
                'e_nasabah' => 'required',
                'msoc_mssp_nama' => 'required',
                'msoc_mekanisme' => 'required',
                'msoc_mekanisme2' => 'required',
                'msoc_mft_kode' => 'required',
                'msoc_jenis_bayar' => 'required',
                'msoc_jns_perusahaan' => 'required',
                'e_manfaat' => 'required',
                'e_pras' => 'required',
                'msotd_status' => 'required',
                'msotd_ketentuan' => 'required',
                'msotd_berlaku' => 'required',
                'msotd_tgl2' => 'required',
                'msotd_mdr_persen' => 'required',
                'msotd_mdr_berlaku' => 'required',
                'msotd_mujh_persen' => 'required',
                'msotd_mfee_persen' => 'required',
                'msotd_jenis_tarif' => 'required',
                'msotd_tipe_uw' => 'required',
                'e_tarif' => 'required',
                'e_uw' => 'required',
            ],
            [
                'msoc_mrkn_nama.required' => 'Nama pemegang polis harus terisi!',
                'e_nasabah.required' => 'Nasabah bank/ peserta  harus terisi!',
                'msoc_mssp_nama.required' => 'Segmen pasar harus terisi!',
                'msoc_mekanisme.required' => 'Mekanisme 1 (umum) harus terisi!',
                'msoc_mekanisme2.required' => 'Mekanisme 2 (penutipan) harus terisi!',
                'msoc_mft_kode.required' => 'Manfaat asuransi harus terisi!',
                'msoc_jenis_bayar.required' => 'Pembayaran kontribusi harus terisi!',
                'msoc_jns_perusahaan.required' => 'Jenis pekerjaan harus terisi!',
                'e_manfaat.required' => 'Jaminan asuransi harus terisi!',
                'e_pras.required' => 'Program asuransi harus terisi!',
                'msotd_status.required' => 'Status soc khusus harus terisi!',
                'msotd_ketentuan.required' => 'Ketentuan khusus harus terisi!',
                'msotd_berlaku.required' => 'Soc berlaku harus terisi!',
                'msotd_tgl2.required' => 'Tanggal periode ke 2 harus terisi!',
                'msotd_mdr_persen.required' => 'Disc rate harus terisi!',
                'msotd_mdr_berlaku.required' => 'Berlaku harus terisi!',
                'msotd_mujh_persen.required' => 'Ujrah harus terisi!',
                'msotd_mfee_persen.required' => 'Fee base tidak potong harus terisi!',
                'msotd_jenis_tarif.required' => 'Import tarif harus terisi!',
                'msotd_tipe_uw.required' => 'Import uw harus terisi!',
                'e_tarif.required' => 'Jenis tarif harus terisi!',
                'e_uw.required' => 'Jenis uw harus terisi!',
            ]);

            if ($valid->fails()) {
                return __json([
                    "error" => $valid->errors()
                ]);
            } else {
                if (__getHak("sjab_kode")!="AKT" && __getHak("sjab_kode")!="KDVAKT") {
                    return __json([
                        'errors' => 'Tidak Punya Akses Modul !'
                    ]);
                }

                $_POST['msotd_tgl1'] = __str2($_POST['msotd_tgl1'],'D');
                $_POST['msotd_tgl2'] = __str2($_POST['msotd_tgl2'],'D');

                $kodeendos="";
                if ((trim($_POST['endors']))=="2") {
                    if ((trim($_POST['msotd_msoc_nomor']))=="") {
                        return __json([
                            'errors' => 'Gagal Simpan Endos , Nomor Polis Kosong !!'
                        ]);
                    }
                    if ((trim($_POST['msotd_msoc_kode']))=="") {
                        return __json([
                            'errors' => 'Gagal Simpan Endos , Kode Polis Kosong !!'
                        ]);
                    }

                    $msotd_endos_idx=0;
                    $cmd="SELECT MAX(msoc_endos_idx)+1 idx ,msotd_kode_ori FROM $vtable WHERE msotd_msoc_kode='".$_POST['msotd_msoc_kode']."'";
                    $res=__dbRow($cmd);
                    $msotd_endos_idx=strval($res['idx']);

                    $kodeendos="EDS".$msotd_endos_idx.'.'.$res['msotd_kode_ori'];
                    $cmd= "UPDATE $vtable SET msotd_endos=3 WHERE msotd_msoc_kode='".$_POST['msotd_msoc_kode']."' ";
                    __dbRow($cmd);
                    $nomorx=substr($res['msotd_kode_ori'],0,10);
                    $_POST['msotd_msoc_kode'] = "";
                    $_POST['msotd_endos'] = "1";
                    $_POST['msotd_kode_ori'] = $res['msoc_kode_ori'];
                    $_POST['msotd_endos_idx'] = $msoc_endos_idx;
                }

                if ((trim($_POST['endors']))=="0" && ($_POST['msotd_pk']=="")) {
                    $sql = __dbRow("SELECT MAX(msotd_pk) num FROM $vtable");
                    $kodesk = __getpx($sql['num'], 17);
                    $_POST['msotd_pk'] = $kodesk;
                    $_POST['msotd_ins_date'] = __now();
                    $_POST['msotd_ins_user'] = __getUser();
                    $_POST['msotd_upd_date'] = __now();
                    $_POST['msotd_upd_user'] = __getUser();

                    $field = __getKode("msotd_",$_POST);
                    $cmd = __toSQL($vtable, $field, "I", "", true, "");
                    $title = 'di simpan';
                } else {
                    $_POST['msotd_upd_date']=__now();
                    $_POST['msotd_upd_user']=__getUser();

                    $field = __getKode("msotd_",$_POST);
                    $cmd = __toSQL($vtable, $field, "U", "WHERE msotd_pk='".$_POST['msotd_pk']."'", true, "");
                    $title = 'di update';
                }

                return __json([
                    'success' => 'Data berhasil '.$title.' dengan Kode '.$_POST['msotd_pk'].' !'
                ]);
            }
        }

        if ($_GET['id']=="inputTK") {
            $vtable = "emst.mst_tarif";
            $vtable2 = "emst.mst_tarif_usia_jwaktu";
            $valid = __valid($request->all(), [
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

            if ($valid->fails()) {
                return __json([
                    "error" => $valid->errors()
                ]);
            } else {
                $sql = __dbRow("SELECT MAX(mth_nomor) num FROM $vtable");
                $kodeMth = __getpx($sql['num'], 14);
                $file = $_FILES['mth_file']['name'];
                $dir = 'public/tehnik/soc-khusus/import/import-tarif';
                if (!empty($file)) {
                    $fileOri = $request->file('mth_file');
                    $nameFile = $kodeMth . '-ImportTarif-' . $file;
                    $path = __upfile($dir, $fileOri, $nameFile);
                    $_POST['mth_file'] = $nameFile;
                }
                $_POST['mth_nomor'] = $kodeMth;
                $_POST['mth_tanggal'] = date('Y-m-d');

                $objReader = IOFactory::createReader('Xlsx');
                $objReader->setReadDataOnly(TRUE);
                $objPHPExcel = $objReader->load($fileOri);
                $objWorkSheet = $objPHPExcel->getActiveSheet();

                $highestRow = $objWorkSheet->getHighestRow();
                $highestColumn = $objWorkSheet->getHighestColumn();
                $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
                $tinggiRow = $highestRow;
                $tinggiCol = $highestColumnIndex-1;
                $rows = array();
                $colxls = strval($_POST['mth_kolom']+1);
                $rowxls = strval($_POST['mth_baris']+1);

                $row=0;
                for ($row=2; $row <= $rowxls; $row++) {
                    $sql2 = __dbRow("SELECT MAX(mstuj_pk) num FROM $vtable2");
                    $rows['mstuj_pk'] = __getpx($sql2['num'], 18);
                    $rows['mstuj_mth_pk'] = $_POST['mth_nomor'];
                    for ($col1=0; $col1 <= $tinggiCol; $col1++) {
                        $value = $objWorkSheet->getCellByColumnAndRow($col1+1, $row)->getValue();
                        $scol="mstuj_".($col1-1);
                        if ($col1==0) {
                            $scol="mstuj_usia";
                        }
                        $rows[$scol] = $value;
                    }
                    if ($colxls == $tinggiCol && $rowxls == $tinggiRow) {
                        $cmd = __toSQL($vtable2, $rows, "I", "", true, "");
                    }
                }
                if ($colxls == $tinggiCol && $rowxls == $tinggiRow) {
                    $field = __getKode("mth_", $_POST);
                    $cmd = __toSQL($vtable, $field, "I", "", true, "");
                    return __json([
                        'success' => 'Data berhasil disimpan dengan Kode '.$_POST['mth_nomor'].'!',
                        'kode' => $_POST['mth_nomor']
                    ]);
                } else {
                    return __json([
                        'errors' => 'Data excel tidak sesuai dengan jumlah kolom atau jumlah baris yang di inputkan!'
                    ]);
                }
            }
        }

        if ($_GET['id']=="updateTK") {
            $vtable = "emst.mst_tarif";
            $vtable2 = "emst.mst_tarif_usia_jwaktu";
            $valid = __valid($request->all(), [
                'mth_final' => 'required',
            ],
            [
                'mth_final.required'=>'Konfirmasi harus terisi!',
            ]);

            if ($valid->fails()) {
                return __json([
                    'error' => $valid->errors()
                ]);
            } else {
                if ($_POST['mth_final']==1) {
                    $field = __getKode("mth_", $_POST);
                    __toSQL($vtable, $field, "U", "WHERE mth_nomor='".$_POST['kode_skitk']."'", true, "");

                    return __json([
                        'success' => 'Data berhasil diupdate dengan Kode '.$_POST['kode_skitk'].' !'
                    ]);
                } else if ($_POST['mth_final']==0) {
                    __toSQL($vtable, "", "D", "WHERE mth_nomor='".$_POST['kode_skitk']."'", true, "");
                    __toSQL($vtable2, "", "D", "WHERE mstuj_mth_pk='".$_POST['kode_skitk']."'", true, "");

                    return __json([
                        'success' => 'Data berhasil dihapus dengan Kode '.$_POST['kode_skitk'].'!'
                    ]);
                }
            }
        }

        if ($_GET['id']=="inputUK") {
            $vtable = "emst.mst_polis_uwtable";
            $vtable2 = "emst.mst_polis_uwtable_dtl";
            $valid = __valid($request->all(), [
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

            if ($valid->fails()) {
                return __json([
                    "error" => $valid->errors()
                ]);
            } else {
                $sql = __dbRow("SELECT MAX(mpuw_nomor) num FROM $vtable");
                $kodeMrmp = __getpx($sql['num'], 14);
                $file = $_FILES['mpuw_file']['name'];
                $dir = 'public/tehnik/soc-khusus/import/import-uw';
                if (!empty($file)) {
                    $fileOri = $request->file('mpuw_file');
                    $nameFile = $kodeMrmp . '-ImportUw-' . $file;
                    $path = __upfile($dir, $fileOri, $nameFile);
                    $_POST['mpuw_file'] = $nameFile;
                }
                $_POST['mpuw_nomor'] = $kodeMrmp;
                $_POST['mpuw_tanggal'] = date('Y-m-d');

                $objReader = IOFactory::createReader('Xlsx');
                $objReader->setReadDataOnly(TRUE);
                $objPHPExcel = $objReader->load($fileOri);
                $objWorkSheet = $objPHPExcel->getActiveSheet();

                $highestRow = $objWorkSheet->getHighestRow();
                $highestColumn = $objWorkSheet->getHighestColumn();
                $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
                $tinggiRow = $highestRow;
                $tinggiCol = $highestColumnIndex-1;
                $rows = array();
                $rowxls = strval($_POST['mpuw_baris']+1);

                $row=0;
                for ($row=2; $row <= $rowxls; $row++) {
                    $sql2 = __dbRow("SELECT MAX(mrmp_pk) num FROM $vtable2");
                    $rows['mrmp_pk'] = __getpx($sql2['num'], 18);
                    $rows['mrmp_mpuw_nomor'] = $kodeMrmp;
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
                        // $vtable2->insert($rows);
                        $cmd = __toSQL($vtable2, $rows, "I", "", true, "");
                    }
                }

                if ($rowxls == $tinggiRow) {
                    $field = __getKode("mpuw_", $_POST);
                    $cmd = __toSQL($vtable, $field, "I", "", true, "");
                    return response()->json([
                        'success' => 'Data berhasil disimpan dengan Kode '.$_POST['mpuw_nomor'].' !',
                        'kode' => $_POST['mpuw_nomor']
                    ]);
                } else {
                    return response()->json([
                        'errors' => 'Data excel tidak sesuai dengan jumlah baris yang di inputkan!'
                    ]);
                }
            }
        }

        if ($_GET['id']=="updateUK") {
            $vtable = "emst.mst_polis_uwtable";
            $vtable2 = "emst.mst_polis_uwtable_dtl";
            $valid = __valid($request->all(), [
                'mpuw_final' => 'required',
            ],
            [
                'mpuw_final.required'=>'Konfirmasi harus terisi!',
            ]);

            if ($valid->fails()) {
                return __json([
                    'error' => $valid->errors()
                ]);
            } else {
                if ($_POST['mpuw_final']==1) {
                    $field = __getKode("mpuw_", $_POST);
                    __toSQL($vtable, $field, "U", "WHERE mpuw_nomor='".$_POST['kode_skiuk']."'", true, "");

                    return __json([
                        'success' => 'Data berhasil diupdate dengan Kode '.$_POST['kode_skiuk'].' !'
                    ]);
                } else if ($_POST['mpuw_final']==0) {
                    __toSQL($vtable, "", "D", "WHERE mpuw_nomor='".$_POST['kode_skiuk']."'", true, "");
                    __toSQL($vtable2, "", "D", "WHERE mrmp_mpuw_nomor='".$_POST['kode_skiuk']."'", true, "");

                    return __json([
                        'success' => 'Data berhasil dihapus dengan Kode '.$_POST['kode_skiuk'].'!'
                    ]);
                }
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
}
