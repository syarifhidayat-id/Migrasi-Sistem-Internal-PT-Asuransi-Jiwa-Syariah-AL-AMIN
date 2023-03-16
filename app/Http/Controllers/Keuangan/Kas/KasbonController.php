<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class KasbonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.kas.kasbon.index');
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

        $validasi = Validator::make(
            $request->all(),
            [
                'e_cabalamin' => 'required',
                'e_karyawan' => 'required',
                'e_realisasi' => 'required',
                'e_akunkas' => 'required',
                'tkb_tanggal' => 'required',
                'tkb_nominal' => 'required||numeric',
                'tkb_peruntukan_dana' => 'required',
               
            ],
            [
                'e_cabalamin.required' => 'form tidak boleh kosong!',
                'e_karyawan.required' => 'form tidak boleh kosong!',
                'e_realisasi.required' => 'form tidak boleh kosong!',
                'e_akunkas.required' => 'form tidak boleh kosong!',
                'tkb_tanggal.required' => 'form tidak boleh kosong!',
                'tkb_nominal.required' => 'form tidak boleh kosong!',
                'tkb_nominal.numeric' => 'form harus angka!',
                'tkb_peruntukan_dana.required' => 'form tidak boleh kosong!'
            ]
        );

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {

        extract($_POST);
        $cmd = "";
        $scr = "";
        $val = "";
        $nomor = "";
        $aret = array();
        $vtable = "ekeu.trs_kasbon";
        $user = $request->user()->email;
        $kode = __getKey(14);

        if ($request['tkb_pk'] == "") {
        $_POST['tkb_ins_user'] = $user;
        $_POST['tkb_ins_date'] = date('Y-m-d');;
        $_POST['tkb_status'] ="0";
        $_POST['tkb_tanggal'] = __str2($request['tkb_tanggal'],'D');
        $_POST['tkb_pk'] = $kode;
        $_POST['tkb_mlok_kode'] = $_POST['e_cabalamin'];
        $_POST['tkb_skar_pk'] = $_POST['e_karyawan'];
        $_POST['tkb_jns_realisasi'] = $_POST['e_realisasi'];
        $_POST['tkb_asakn_kode'] = $_POST['e_akunkas'];
        $field= __getKode("tkb_", $_POST);
        $cmd=__toSQL($vtable,$field,"I",'',true,'');
        // var_dump($_POST);
        }else {
            $_POST['tkb_upd_user']= $user;
            $_POST['tkb_upd_date'] = date('Y-m-d');;
            $field=__getKode("tkb_",$_POST);
            $cmd=__toSQL($vtable,$field,"U","  WHERE  tkb_pk='".$_POST['tkb_pk']."'",true,'');
        }
        
        $cmdz=" select * from ".$vtable." where  tkb_pk='".$_POST['tkb_pk']."'";
        $res=__dbAll($cmdz);

        return response()->json([
            'success' => 'Berhasil menyimpan data dengan nomor kode ' . $kode . '!'
        ]);
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

    public function lod_ang_realisasi(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_anggaran_realisasi')
            ->select('mar_kode', 'mar_nama');

        if (!empty($request->q)) {
            $vtable->where('mar_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
            ->groupBy('mar_nama')
            ->offset($offset)
            ->limit($rows)
            ->get();

        return response()->json($data);
    }

    public function grd_lihat_kasbon(Request $request)
    {
        // extract($_GET);
        $cab = "";
        $menu_tipe = "";
        $tambah = "";
        $nama = "";

        if ($request->get('c_periode') == "1") {
            if (
                !empty($request->get('e_probulan1'))
                && !empty($request->get('e_probulan2')) && !empty($request->get('e_protahun'))
            ) {
                $tambah = $tambah . " and month(tkb_tanggal) between '" . $request['e_probulan1'] . "' and '" . $request['e_probulan2'] . "' and year(tkb_tanggal)='" . $request['e_protahun'] . "' ";
            }
        }

        $cmd = "   
        SELECT 
    tkb_pk,
    skar_pk,
    tkb_skar_pk,
    skar_nama,
    DATE_FORMAT(tkb_tanggal,'%d-%m-%Y') tkb_tanggal,
    DATE_FORMAT(tkb_ins_date,'%d-%m-%Y') tkb_ins_date,
    DATE_FORMAT(tkb_tanggal_balik,'%d-%m-%Y') tkb_tanggal_balik,
    FORMAT(tkb_nominal,2)  tkb_nominal,
    CASE tkb_status
    WHEN '0' THEN 'Belum'
    WHEN '1' THEN 'Sudah'
    END status_kasbon
    FROM ekeu.`trs_kasbon`
    LEFT JOIN esdm.`sdm_karyawan_new` ON skar_pk=tkb_skar_pk
         " . $tambah . "
        order by tkb_tanggal asc
    ";

        ///  echo $cmd;  //  tpprd_approv1<>0 AND tpprd_approv2<>0  AND tpprd_approv3<>0 AND

        //    var_dump($tambah);

        $res = __dbAll($cmd);
        return DataTables::of($res)->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if ($request->get('c_jenis') == "1") {
                    if (!empty($request->get('e_realiasasix'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['tkb_jns_realisasi'], $request->get('e_realiasasix')) ? true : false;
                        });
                    }
                }
                if ($request->get('c_nama') == "1") {
                    if (!empty($request->get('e_nmkaryawan'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['skar_pk'], $request->get('e_nmkaryawan')) ? true : false;
                        });
                    }
                }
            })->make(true);
        }
    }

