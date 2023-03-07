<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ApprovKasAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slc_ket = DB::table('eset.uti_setting')
            ->select('uset_value1 AS kode', 'uset_value1 AS ket')
            ->where('uset_modul', 'KASKET')
            // ->orderBy(1)
            ->get();

        // dd($slc_ket);

        $slc_tipe_diang = "SELECT mta_pk kode,mta_keterangan ket FROM epms.mst_tipe_anggaran   ORDER BY 1";
        $tipe_diang = __dbRow($slc_tipe_diang);

        $slc_kel_kas = "SELECT mkk_pk kode,mkk_nama ket FROM epms.mst_kelompok_kas ORDER BY 1";
        $kelompok_kas = __dbRow($slc_kel_kas);


        return view('pages.keuangan.kas.approv-kas-anggaran.index', [
            'slc_ket' => $slc_ket,
            'slc_tipe_diang' => $tipe_diang,
            'slc_kel_kas' => $kelompok_kas
        ]);
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
        //
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

    public function api_approv_kas_anggaran(Request $request)
    {
        $tambah = "";
        $group = "";


        if (isset($request['e_baris'])) {
            $baris = $request['e_baris'];
            // $baris = '10';
        } else {
            $baris = '100';
        }
        if (isset($request['c_group'])) {
            $group = $group . "ORDER BY " . $request['e_group'] . " ASC";
        } else {
            $group = $group . "ORDER BY tkad_mta_pk ASC";
        }

        // if (isset($request['c_periode'])) {
        //     $tambah = $tambah . " and month(tdna_tgl_aju) between '" . $request['e_probulan1'] . "' and '" . $request['e_probulan2'] . "' and year(tdna_tgl_aju)='" . $request['e_protahun'] . "' ";
        // }


        if ($request->get('c_periode') == "1") {
            if (!empty($request->get('e_probulan1')) 
            && !empty($request->get('e_probulan2')) && !empty($request->get('e_protahun'))) {
                $tambah = $tambah . " and month(tdna_tgl_aju) between '" . $request['e_probulan1'] . "' and '" . $request['e_probulan2'] . "' and year(tdna_tgl_aju)='" . $request['e_protahun'] . "' ";
            }
        }

        $cmd = "
        SELECT 
        tdna_pk,
        tkad_pk,
        tkad_atjh_pk,
        DATE_FORMAT(tdna_tgl_aju,'%d-%m-%Y') tdna_tgl_aju,
        tdna_kode_vcr,
        tdna_pk,
        mlok_nama,
        mlok_kode,
        tkad_askn_kode,
        tkad_keterangan,
        IF(tkad_tipe_dk='K',tkad_total,0) debit,
        IF(tkad_tipe_dk='D',tkad_total,0) kredit,
        tkad_tipe_dk,
        tkad_total,
        CONCAT(`tkad_mta_pk`,'|',`mta_keterangan`) `mta_keterangan`,
        CONCAT(`tkad_relops`,'|',`mrops_keterangan`) `mrops_keterangan`,
        CONCAT(`tkad_kelompokas`,'|',`mkk_nama`) mkk_nama,
        IF(tkad_approvkeu1=1,'SETUJU',IF(tkad_approvkeu1=2,'TOLAK','-')) approv_staffkeu,
        IF(tkad_approvkeu2=1,'SETUJU',IF(tkad_approvkeu2=2,'TOLAK','-')) approv_kbgkeu,
        IF(tkad_approvpms=1,'SETUJU',IF(tkad_approvpms=2,'TOLAK','-')) approv_pms,
        IF(tkad_approvacc=1,'SETUJU',IF(tkad_approvacc=2,'TOLAK','-')) approv_acc
        FROM epms.`trs_kas_dtl`
        LEFT JOIN eacc.`ams_sub_akun` ON asakn_kode=tkad_askn_kode
        LEFT JOIN epms.`trs_dana_aju` ON tkad_atjh_pk=tdna_pk
        LEFT JOIN emst.`mst_lokasi` ON mlok_kode=tdna_mlok_kode
        LEFT JOIN emst.mst_relops ON tkad_relops = mrops_pk
        LEFT JOIN epms.`mst_kelompok_kas` ON `mkk_pk`= tkad_kelompokas
        LEFT JOIN epms.`mst_tipe_anggaran` ON tkad_mta_pk=mta_pk
        WHERE 1=1 AND asakn_buku_kas!='1'
            " . $tambah . "  
            GROUP BY tkad_pk
            " . $group . " 
        LIMIT " . $baris . " ";

        $data = __dbAll($cmd);
        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if ($request->get('c_cabang') == "1") {
                    if (!empty($request->get('tdna_mlok_kode'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['mlok_kode'], $request->get('tdna_mlok_kode')) ? true : false;
                        });
                    }
                }

                if ($request->get('c_keu1') == "1") {
                    if (!empty($request->get('e_keu1'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tkad_approvkeu1'], $request->get('tkad_approvkeu1')) ? true : false;
                        });
                    }
                }
                if ($request->get('c_keu2') == "1") {
                    if (!empty($request->get('e_keu2'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tkad_approvkeu2'], $request->get('tkad_approvkeu2')) ? true : false;
                        });
                    }
                }
                if ($request->get('c_pms') == "1") {
                    if (!empty($request->get('e_pms'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tkad_approvpms'], $request->get('tkad_approvpms')) ? true : false;
                        });
                    }
                }
                if ($request->get('c_acc') == "1") {
                    if (!empty($request->get('e_acc'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tkad_approvacc'], $request->get('tkad_approvacc')) ? true : false;
                        });
                    }
                }

                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['tkad_atjh_pk']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['mrops_keterangan']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['mlok_nama']), Str::lower($request->get('search')))) {
                            return true;
                        }
                        return false;
                    });
                }
            })
            ->make(true);
    }

    public function selectCabang(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_lokasi')
            ->select('mlok_kode', 'mlok_nama');

        if (!empty($request->q)) {
            $vtable->where('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
            ->groupBy('mlok_nama')
            ->orderBy('mlok_kode')
            ->offset($offset)
            ->limit($rows)
            ->get();

        return response()->json($data);
    }

    // public function getCabang(Request $request, $id)
    // {
    //     $data = [];
    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = DB::table('emst.mst_lokasi')
    //             ->select('*')
    //             ->where([
    //                 ['mlok_pk', $id],
    //                 ['mlok_nama', 'like', "%$search%"],
    //             ])
    //             ->get();
    //     } else {
    //         $data = DB::table('emst.mst_lokasi')
    //             ->select('*')
    //             ->where([
    //                 ['mlok_pk', $id],
    //             ])
    //             ->get();
    //     }

    //     return response()->json($data);
    // }

    public function get_kaskeu(Request $request)
    {
        $tambah = "";
        if (isset($request['kode'])) {
            if ($request['kode'] != "") {
                $tambah .= " and tkad_pk='" . $request['kode'] . "'";
            }
        }

        $cmd =
            "
            SELECT
            tkad_pk,  
            tkad_atjh_pk,
            tkad_askn_kode,
            LOWER(tkad_keterangan) AS tkad_keterangan,
            tkad_tipe_dk,
            FORMAT(tkad_total,2) tkad_total,
            tkad_jns_realisasi,
            mar_nama e_realisasi,
            tkad_tkb_pk,
            tkad_mta_pk,
            mta_keterangan,
            tkad_kd_keterangan,
            tkad_relops,
            tkad_kelompokas
            FROM   epms.trs_kas_dtl	
            LEFT JOIN eacc.ams_sub_akun  ON asakn_kode=tkad_askn_kode 
            LEFT JOIN epms.`mst_tipe_anggaran` ON mta_pk=tkad_mta_pk
            LEFT JOIN `emst`.`mst_anggaran_realisasi` on mar_kode=tkad_jns_realisasi
            WHERE 1=1   $tambah  limit 1 
            ";
        $r = __dbRow($cmd);

        return response()->json($r);
        // return $r;
    }

    public function selectKeterangan(Request $request)
    {
        $vtable = DB::table('eset.uti_setting')->where('uset_value1', $request['id'])->first();

        return __json($vtable);
    }

    public function selectTipeAnggaran(Request $request)
    {
        $vtable = DB::table('epms.mst_tipe_anggaran')->where('mta_pk', $request['id'])->first();

        return __json($vtable);
    }
    public function selectKelompokKas(Request $request)
    {
        $vtable = DB::table('epms.mst_kelompok_kas')->where('mkk_pk', $request['id'])->first();

        return __json($vtable);
    }

    public function p_approv_kaskeu(Request $request)
    {
        extract($_POST);
        $cmd = "";
        $scr = "";
        $val = "";
        $nomor = "";
        $aret = array();
        $vtable = "epms.trs_kas_dtl";
        $user = $request->user()->email;

        // return $request->user();

        $cek = "SELECT tkad_approvkeu1,tkad_approvkeu2,tkad_approvpms,tkad_approvacc FROM $vtable WHERE tkad_pk='" . $_POST['tkad_pk'] .  "'";

        $sts = __dbRow($cek);

        if ($sts['tkad_approvkeu1'] == '0') {
            if (__getHak("sjab_level") == "STF" && __getHak("sjab_kode") == "STFKEU" && $user == "nabila") {
                $_POST['tkad_approvkeu1'] = $_POST['statusx'];
                $_POST['tkad_approvkeu1_date'] = date('Y-m-d H:i:s');
                $_POST['tkad_approvkeu1_user'] = $request->user()->email;
            }
        }

        if ($sts['tkad_approvkeu1'] == '1' || $sts['tkad_approvkeu2'] == '1' || $sts['tkad_approvpms'] == '1' || $sts['tkad_approvacc'] == '1') {
            if (__getHak("sjab_level") == "STF" && __getHak("sjab_kode") == "STFKEU" && $user == "nabila") {
                $_POST['tkad_approvkeu1'] = $_POST['statusx'];
                $_POST['tkad_relops'] = $_POST['tkad_relops'];
                $_POST['tkad_kelompokas'] = $_POST['tkad_kelompokas'];
                $_POST['tkad_mta_pk'] = $_POST['tkad_mta_pk'];
            }
        }



        if ($sts['tkad_approvkeu2'] == '0') {
            if (__getHak("sjab_level") == "KBG" && __getHak("sjab_kode") == "KBGKEU") {
                $_POST['tkad_approvkeu2'] = $_POST['statusx'];
                $_POST['tkad_approvkeu2_date'] = date('Y-m-d H:i:s');
                $_POST['tkad_approvkeu2_user'] = $request->user()->email;
            }
        }

        if ($sts['tkad_approvpms'] == '0') {
            if (__getHak("sjab_level") == "SPV" && __getHak("sjab_kode") == "SPV2") {
                $_POST['tkad_approvpms'] = $_POST['statusx'];
                $_POST['tkad_approvpms_date'] = date('Y-m-d H:i:s');
                $_POST['tkad_approvpms_user'] = $request->user()->email;
            }
        }

        if ($sts['tkad_approvacc'] == '0') {
            if (__getHak("sjab_level") == "SPV" && __getHak("sjab_kode") == "SPVKEUJAK") {
                $_POST['tkad_approvacc'] = $_POST['statusx'];
                $_POST['tkad_approvacc_date'] = date('Y-m-d H:i:s');
                $_POST['tkad_approvacc_user'] = $request->user()->email;
            }
        }

        if ($sts['tkad_approvacc'] == '0') {
            if (__getHak("sjab_kode") == "STFAKU") {
                $_POST['tkad_approvacc'] = $_POST['statusx'];
                $_POST['tkad_approvacc_date'] = date('Y-m-d H:i:s');
                $_POST['tkad_approvacc_user'] = $request->user()->email;
            }
        }

        if ($sts['tkad_approvacc'] == '0') {
            if (__getHak("sjab_level") == "KBG" && __getHak("sjab_kode") == "KBGACCLOLA") {
                $_POST['tkad_approvacc'] = $_POST['statusx'];
                $_POST['tkad_approvacc_date'] = date('Y-m-d H:i:s');
                $_POST['tkad_approvacc_user'] = $request->user()->email;
            }
        }

        if (
            $sts['tkad_approvacc'] == '1' or $sts['tkad_approvpms'] == 1 or $sts['tkad_approvkeu2'] == 1 or
            $sts['tkad_approvkeu1'] == 1
        ) {
            if (__getHak("sjab_kadiv_acc") == 1) {
                $_POST['tkad_approvacc'] = $_POST['statusx'];
                $_POST['tkad_approvacc_date'] = date('Y-m-d H:i:s');
                $_POST['tkad_approvacc_user'] = $request->user()->email;
            }
        }


        $field = __getKode("tkad_", $_POST);
        $cmd = __toSQL($vtable, $field, "U", "  WHERE  tkad_pk='" . $_POST['tkad_pk'] . "'", true, '');
        //echo $cmd;

        $cmdz = " select tkad_pk from " . $vtable . " where  tkad_pk='" . $_POST['tkad_pk'] . "'";
        $res = __dbAll($cmdz);
        return response()->json([
            'success' => 'Berhasil Disimpan'
        ]);




        // if (count($res) > 0 && trim($res[0]['tkad_pk']) == trim($_POST['tkad_pk'])) {
        //     $json_data = "" . json_encode($res) . "";
        //     $json_data = str_replace("[{", "{", $json_data);
        //     $json_data = str_replace("}]", "}", $json_data);
        //     echo $json_data;
        // } else {
        //     echo '{"error" : " Gagal Simpan ... , coba simpan ulang  ERROR MESSAGE "}';
        //     return;
        // }
    }

    public function op_file_danaju(Request $request)
    {
        extract($_GET);
        $ket="";
        $filex="";

        $cmd = "select ifnull(tdna_bukti,'')  tdna_bukti , ifnull(tdna_file_vcr,'')  tdna_file_vcr , tdna_indexfolder indexfolder
		FROM epms.trs_dana_aju where tdna_pk='".$nomor."'";
        $res= __dbRow($cmd);

        // $sdir=_getdirId($res['indexfolder']);
        // $uploaddir ='/live/'.$sdir['dir'];
        //echo $uploaddir;

        $uploaddir = 'public/keuangan/kas/master-kas/';
        // $fileOri = $dokumen->getClientOriginalName();

        // if (file_exists($uploaddir.$res['tdna_bukti'])) {
        //     echo "ada";
        // } else {
        //     echo "tidak ada!";
        // }
        if($tipe=="0")
        {
        $sfile=$res['tdna_bukti'];
        $filex=$uploaddir.$sfile;
        }
        if($tipe=="1")
        {
        $sfile=$res['tdna_file_vcr'];
        $filex=$uploaddir.$sfile;
        }

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$filex) && trim($sfile)!="")
        {
            return $filex;
        }else{
            return 'FILE TIDAK ADA';
        }
    }
}
