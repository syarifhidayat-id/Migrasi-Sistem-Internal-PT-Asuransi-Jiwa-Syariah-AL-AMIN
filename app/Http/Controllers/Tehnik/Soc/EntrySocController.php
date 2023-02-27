<?php

namespace App\Http\Controllers\Tehnik\Soc;

use App\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EntrySocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.tehnik.soc.entry-soc.create');
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
        extract($_POST);
        $cmd = "";
        $vtable = "";

        $validasi = Validator::make($request->all(), [
            // 'msoc_mrkn_nama' => 'required',
            'e_nasabah' => 'required',
            'msoc_mssp_nama' => 'required',
            'msoc_mekanisme' => 'required',
            'e_manfaat_pol' => 'required',
            'msoc_jenis_bayar' => 'required',
            'msoc_jns_perusahaan' => 'required',
            'e_manfaat' => 'required',
            'e_pras' => 'required',
            'msoc_mslr_kode' => 'required',
            'msoc_mpojk_kode' => 'required',
            'e_cabalamin' => 'required',
            'msoc_pajakfee' => 'required',
            'msoc_handlingfee' => 'required',
            'msoc_handlingfee2' => 'required',
            'e_tarif' => 'required',
            'e_uw' => 'required',
            'msoc_dok' => 'mimes:pdf',
        ],
        [
            // 'msoc_mrkn_nama.required'=>'Pemegang polis tidak boleh kosong!',
            'e_nasabah.required'=>'Nasabah bank/peserta tidak boleh kosong!',
            'msoc_mssp_nama.required'=>'Segmen pasar tidak boleh kosong!',
            'msoc_mekanisme.required'=>'Mekanisme 1 tidak boleh kosong!',
            'e_manfaat_pol.required'=>'Manfaat asuransi tidak boleh kosong!',
            'msoc_jenis_bayar.required'=>'Pembayaran kontribusi tidak boleh kosong!',
            'msoc_jns_perusahaan.required'=>'Jenis pekerjaan tidak boleh kosong!',
            'e_manfaat.required'=>'Jaminan asuransi tidak boleh kosong!',
            'e_pras.required'=>'Program asuransi tidak boleh kosong!',
            'msoc_mslr_kode.required'=>'Saluran distribusi tidak boleh kosong!',
            'msoc_mpojk_kode.required'=>'Produk ojk tidak boleh kosong!',
            'e_cabalamin.required'=>'Cabang alamin tidak boleh kosong!',
            'msoc_pajakfee.required'=>'Penanggung pajak fee tidak boleh kosong!',
            'msoc_handlingfee.required'=>'Fee ppn tidak boleh kosong!',
            'msoc_handlingfee2.required'=>'Fee ppn 23 tidak boleh kosong!',
            'e_tarif.required'=>'Jenis tarif tidak boleh kosong!',
            'e_uw.required'=>'Jenis underwriting tidak boleh kosong!',
            // 'msoc_dok.required'=>'File excel harus terisi!',
            'msoc_dok.mimes'=>'File harus berbentuk *pdf!',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            $vtable = "eopr.mst_soc";
            $kodepolisendos = "";
            if (trim($_POST['endors'])=="2") {
                if (trim($_POST['msoc_nomor'])=="") {
                    return __json([ 'error' => 'Gagal Simpan Endos , Nomor SOC Kosong !!' ]);
                }
                if (trim($_POST['msoc_kode'])=="") {
                    return __json([ 'error' => 'Gagal Simpan Endos , Kode SOC Kosong !!' ]);
                }
                $msoc_endos_idx = 0;
                $cmd = "SELECT IFNULL(max(msoc_endos_idx),0)+1 idx ,msoc_kode_ori FROM $vtable WHERE msoc_kode='".$_POST['msoc_kode']."'";
                $res = __dbRow($cmd);
                $msoc_endos_idx = strval($res['idx']);

                $kodepolisendos = "EDS".$msoc_endos_idx.'.'.$res['msoc_kode_ori'];
                $cmd = "UPDATE $vtable SET msoc_endos=3 WHERE msoc_kode='".$_POST['msoc_kode']."'";
                __dbRow($cmd);

                $nomorx = substr($res['msoc_kode_ori'],0,10);
                $_POST['msoc_kode'] = "";
                $_POST['msoc_endos'] = "1";
                $_POST['msoc_approve'] = "0";
                $_POST['msoc_kode_ori'] = $res['msoc_kode_ori'];
                $_POST['msoc_endos_idx'] = $msoc_endos_idx;
            }

            if ((trim($_POST['msoc_kode']))=="") {
                if ((trim($_POST['msoc_mpid_kode']))!="" && ($_POST['endors']!="2")) {
                    $kdx = $_POST['msoc_mjns_kode'].'.'.$_POST['msoc_mpid_kode'].'.';
                    $kd = __get_no('',$kdx,'2016-01-01','Y','SOC','0');

                    $_POST['msoc_nomor'] = $kd;
                    $_POST['msoc_approve'] = "0";
                }

                if (trim($kodepolisendos)!="") {
                    $_POST['msoc_kode'] = $kodepolisendos;
                    $_POST['msoc_nomor'] = $nomorx;
                } else {
                    $_POST['msoc_kode'] = $_POST['msoc_nomor'].'.'.$_POST['msoc_mft_kode'].'.'.$_POST['msoc_mjm_kode'].'.'.$_POST['msoc_mpras_kode'].'.'.$_POST['msoc_jns_perusahaan'].'.'.$_POST['msoc_mekanisme'].'.'.$_POST['msoc_mekanisme2'];
                    $_POST['msoc_kode_ori'] = $_POST['msoc_kode'];
                }

                $_POST['msoc_ins_date'] = __now();
                $_POST['msoc_ins_user'] = __getUser();
                $_POST['msoc_upd_date'] = __now();
                $_POST['msoc_upd_user'] = __getUser();

                $field = __getKode('msoc_', $_POST);
                $cmd = __toSQL($vtable, $field, "I", "", true, "");
            } else {
                $_POST['msoc_upd_date'] = __now();
                $_POST['msoc_upd_user'] = __getUser();

                $field = __getKode('msoc_', $_POST);
                $cmd = __toSQL($vtable, $field, "U", "WHERE msoc_kode='".$_POST['msoc_kode']."'", true, "");
            }

            if (!empty($_FILES['msoc_dok']['name'])) {
                $msoc_dok = $request->file('msoc_dok');
                $dir = 'public/tehnik/soc/doc';
                $fileOri = $msoc_dok->getClientOriginalName();
                $namaFile = $_POST['msoc_kode'] . '-DokumenSoc-' . $fileOri;
                $path = __upfile($dir, $msoc_dok, $namaFile);
                // $_POST['msoc_dok'] = $namaFile;
                $cmd = "UPDATE $vtable SET msoc_dok='".$namaFile."', msoc_indexfolder='1' WHERE msoc_kode='".$_POST['msoc_kode']."'";
                __dbRow($cmd);
            }

            return __json([
                'success' => 'Data berhasil disimpan dengan Kode '.$_POST['msoc_kode']. ' !'
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

    public function selectJnsNasabah(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_jenis_nasabah')
        ->select(DB::raw("mpol_mjns_kode, mpid_nama, mjns_kode, mjns_keterangan, mjns_jl, mjns_jl_pst, mjns_jl_pas, mjns_wp_pens, mjns_phk_pens, mjns_mpid_nomor, mjns_pbiaya"))
        ->leftJoin('eopr.mst_polis', 'mpol_mjns_kode', '=', 'mjns_kode')
        ->leftJoin('emst.mst_produk_induk', 'mpid_kode', '=', 'mjns_mpid_nomor')
        ->where([
            ['mjns_kode', '<>', ''],
            ['mjns_kode', '!=', '00'],
            // ['mjns_keterangan', 'like', "%$search%"],
        ]);

        if (!empty($request->q)) {
            $vtable->where('mjns_kode', 'LIKE', "%$request->q%")->orWhere('mjns_keterangan', 'LIKE', "%$request->q%");
        }

        $data = $vtable
            ->groupBy('mjns_kode')
            ->offset($offset)
            ->limit($rows)
            ->get();

        return response()->json($data);
    }

    public function selectSegmen(Request $request)
    {
        $in = DB::table('emst.mst_protree_2')->select('mptr_kode')->where('mptr_induk', $request->mjns);

        $vtable1 = DB::table('emst.mst_produk_segment')
        ->select('mssp_kode as value', 'mssp_nama as text', 'mssp_group as group')
        ->where([
            ['mssp_group', '<>', ''],
        ]);
        if (!empty($request->mjns)) {
            $vtable1->whereIn('mssp_kode', $in);
            // if (!empty($request->q)) {
            //     $vtable1->where('mssp_kode', 'LIKE', "%$request->q%")->orWhere('mssp_nama', 'LIKE', "%$request->q%");
            // }
        }
        $data1 = $vtable1->get();

        $vtable2 = DB::table('emst.mst_produk_segment')
        ->select('mssp_kode as value', 'mssp_nama as text')
        ->where([
            ['mssp_group', '=', ''],
        ]);
        if (!empty($request->mjns)) {
            $vtable2->whereIn('mssp_kode', $in);
            // if (!empty($request->q)) {
            //     $vtable2->where('mssp_kode', 'LIKE', "%$request->q%")->orWhere('mssp_nama', 'LIKE', "%$request->q%");
            // }
        }
        $data2 = $vtable2->get();
        $all = $data2->merge($data1);
        return response()->json($all);
    }

    public function selectNoSpaj(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('eopr.mst_spaj_polis')
        ->select(DB::raw("mspaj_nomor, mspaj_keterangan"))
        ->where([
            ['mspaj_nomor', '<>', ''],
            // ['mspaj_keterangan', 'like', "%$search%"],
        ]);

        if (!empty($request->q)) {
            $vtable->where('mspaj_nomor', 'LIKE', "%$request->q%")->orWhere('mspaj_keterangan', 'LIKE', "%$request->q%");
        }

        $data = $vtable->offset($offset)->limit($rows)->get();

        return response()->json($data);
    }

    public function selectMeka1(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_mekanisme')
        ->select(DB::raw("mkm_kode, mkm_nama"))
        ->where([
            ['mkm_aktif', '!=', 1],
        ]);

        if (!empty($request->q)) {
            $vtable->where('mkm_kode', 'LIKE', "%$request->q%")->orWhere('mkm_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mkm_kode', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
        // return $data;
    }

    public function selectMeka2(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_mekanisme2')
        ->select(DB::raw("mkm_kode2, mkm_ket2"));

        if (!empty($request->q)) {
            $vtable->where('mkm_kode2', 'LIKE', "%$request->q%")->orWhere('mkm_ket2', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mkm_kode2', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
        // return $data;
    }

    public function selectManfaatAsu(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_manfaat_plafond')
        ->select(DB::raw("mft_kode kode, mft_nama nama"))
        ->leftJoin('emst.mst_protree_5', 'mptr_kode', '=', 'mft_kode')
        ->where([
            ['mft_kode', '<>', ''],
            // ['mft_nama', 'like', "%$search%"],
        ]);

        if (!empty($request->q)) {
            $vtable->where('mft_kode', 'LIKE', "%$request->q%")->orWhere('mft_nama', 'LIKE', "%$request->q%");
        }

        if (!empty($request->mjns)) {
            if($request->mjns == '01') {
                $vtable->where([
                    ['mft_kode', '!=', '01'],
                    ['mptr_induk_nasabah', $request->mjns],
                ]);
            }
            $vtable->where('mptr_induk_nasabah', $request->mjns);
        }
        $data = $vtable->offset($offset)->limit($rows)->get();
        return response()->json($data);
    }

    public function selectJnsKerja(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_pekerjaan')
        ->select(DB::raw("mker_kode, mker_nama"));

        if (!empty($request->q)) {
            $vtable->where('mker_kode', 'LIKE', "%$request->q%")->orWhere('mker_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mker_kode', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
        // return $data;
    }

    public function selectJamiAsu(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_jaminan')
        ->select(DB::raw("mjm_kode, mjm_nama, mjm_bundling, mjm_jiwa, mjm_gu, mjm_phk, mjm_tlo, mjm_fire, mjm_wp, mjm_umut, mpid_kode, mpid.mpid_nama mpid_nama"))
        ->leftJoin('emst.mst_protree_3 as mptr3', 'mptr3.mptr_kode', '=', 'mjm_kode')
        ->leftJoin('emst.mst_produk_induk as mpid', 'mpid.mpid_kode', '=', 'mptr_mpid_kode')
        ->where([
            ['mjm_kode', '<>', ''],
            // ['mjm_nama', 'like', "%$search%"],
        ]);

        if (!empty($request->q)) {
            $vtable->where('mjm_kode', 'LIKE', "%$request->q%")->orWhere('mjm_nama', 'LIKE', "%$request->q%");
        }

        if (!empty($request->mjns)) {
            $vtable->where('mptr_induk_nasabah', $request->mjns);
        }
        if (!empty($request->mssp)) {
            $vtable->where('mptr_induk', $request->mssp);
        }
        $data = $vtable->orderBy('mpid_nama', 'ASC')->offset($offset)->limit($rows)->get();
        return response()->json($data);
    }

    public function selectSalDistri(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_saluran_distribusi')
        ->select(DB::raw("mslr_kode, mslr_ket"));

        if (!empty($request->q)) {
            $vtable->where('mslr_kode', 'LIKE', "%$request->q%")->orWhere('mslr_ket', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mslr_kode', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
        // return $data;
    }

    public function selectProdOjk(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_produk_ojk')
        ->select(DB::raw("mpojk_kode, mpojk_nama"));

        if (!empty($request->q)) {
            $vtable->where('mpojk_kode', 'LIKE', "%$request->q%")->orWhere('mpojk_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mpojk_kode', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
        // return $data;
    }

    public function selectCabAlamin(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable1 = DB::table('emst.mst_lokasi')
        ->select(DB::raw("mlok_kode kode,
        mlok_nama nama,
        IFNULL(skar_pk, '') kd_pinca,
        IFNULL(skar_nama, '') nm_pinca,
        mlok_sn sn"))
        ->leftJoin('esdm.sdm_karyawan_new', function($join) {
            $join->on('skar_mlok_kode', '=', 'mlok_kode')
            ->whereIn('skar_sjab_kode', ['KACAB','PINCA','PJSKACAB','PLTKACAB','WAKACAB']);
        })
        ->where([
            ['mlok_kode', '<>', ''],
            ['mlok_nama', '!=', ''],
        ]);

        $vtable2 = DB::table('emst.mst_lokasi')
        ->select(DB::raw("mlok_kode kode,
        mlok_nama nama,
        '' kd_pinca,
        '' nm_pinca,
        mlok_sn sn"))
        ->where([
            ['mlok_tipe', 0],
            ['mlok_nama', '!=', ''],
        ]);

        if (!empty($request->q)) {
            $vtable1->where('mlok_kode', 'LIKE', "%$request->q%")->orWhere('mlok_nama', 'LIKE', "%$request->q%");
            $vtable2->where('mlok_kode', 'LIKE', "%$request->q%")->orWhere('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data1 = $vtable1->groupBy('mlok_kode');
        $data2 = $vtable2
        ->union($data1)
        ->groupBy('mlok_kode')
        ->get();

        return response()->json($data2);
    }

    public function selectMarketing(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('esdm.sdm_karyawan_new')
        ->select(DB::raw("skar_pk kode,
        skar_nama nama,
        '0' skar_komisi,
        '0' skar_overreding"))
        ->leftJoin('esdm.sdm_jabatan', 'sjab_kode', '=', 'skar_sjab_kode')
        ->where([
            ['skar_nip_lama', '<>', ''],
            // ['skar_mlok_kode', '!=', 01],
        ]);

        if (!empty($request->q)) {
            $vtable->where('skar_nip_lama', 'LIKE', "%$request->q%")->orWhere('skar_nama', 'LIKE', "%$request->q%");
        }
        if (!empty($request->mlok)) {
            $vtable->where('skar_mlok_kode', $request->mlok);
        }

        $data = $vtable
        ->whereIn('skar_status_kary', [0,1,4])
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function selectFeePPn(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_manajemen_fee')
        ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"));

        if (!empty($request->q)) {
            $vtable->where('mmfee_persen', 'LIKE', "%$request->q%")->orWhere('mmfee_tampil', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mmfee_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectFeePPh23(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_manajemen_fee')
        ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"));

        if (!empty($request->q)) {
            $vtable->where('mmfee_persen', 'LIKE', "%$request->q%")->orWhere('mmfee_tampil', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mmfee_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectUjroh(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_ujroh')
        ->select(DB::raw("mujh_tampil persen, mujh_persen tampil"))
        ->where([
            ['mujh_tipe', 'Ujroh'],
        ]);

        if (!empty($request->q)) {
            $vtable->where('mujh_tampil', 'LIKE', "%$request->q%")->orWhere('mujh_persen', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mujh_tampil', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectMnFee(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_manajemen_fee')
        ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"));

        if (!empty($request->q)) {
            $vtable->where('mmfee_persen', 'LIKE', "%$request->q%")->orWhere('mmfee_tampil', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mmfee_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectKomtidakpot(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_komisi')
        ->select(DB::raw("mkom_persen persen, mkom_tipe tipe"));

        if (!empty($request->q)) {
            $vtable->where('mkom_persen', 'LIKE', "%$request->q%")->orWhere('mkom_tipe', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mkom_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectKompot(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_komisi')
        ->select(DB::raw("mkom_persen persen, mkom_tipe tipe"));

        if (!empty($request->q)) {
            $vtable->where('mkom_persen', 'LIKE', "%$request->q%")->orWhere('mkom_tipe', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mkom_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectReferal(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_discount_rate')
        ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"));

        if (!empty($request->q)) {
            $vtable->where('mdr_persen', 'LIKE', "%$request->q%")->orWhere('mdr_tipe', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mdr_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectMaintenence(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_discount_rate')
        ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"));

        if (!empty($request->q)) {
            $vtable->where('mdr_persen', 'LIKE', "%$request->q%")->orWhere('mdr_tipe', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mdr_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectFeebtidakpotong(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_fee')
        ->select(DB::raw("mfee_persen persen, mfee_tipe tipe"));

        if (!empty($request->q)) {
            $vtable->where('mfee_persen', 'LIKE', "%$request->q%")->orWhere('mfee_persen', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mfee_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectFeebpotong(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_discount_rate')
        ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"));

        if (!empty($request->q)) {
            $vtable->where('mdr_persen', 'LIKE', "%$request->q%")->orWhere('mdr_tipe', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mdr_persen', 'ASC')
        ->offset($offset)
        ->limit($rows)
        ->get();

        // return response()->json($data);
        return $data;
    }

    public function selectTarifImport(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_tarif')
        ->select(DB::raw("mth_nomor kode, mth_ket nama"))
        ->where([
            ['mth_nomor', '<>', ''],
            // ['mth_ket', 'like', "%$search%"],
        ]);

        if (!empty($request->q)) {
            $vtable->where('mth_nomor', 'LIKE', "%$request->q%")->orWhere('mth_ket', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mth_nomor', 'ASC')
        // ->offset($offset)
        // ->limit($rows)
        ->get();
        return response()->json($data);
        // return $data;
    }

    public function selectUnderwritingImport(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_polis_uwtable')
        ->select(DB::raw("mpuw_nomor kode, mpuw_nama nama"))
        ->where([
            ['mpuw_nomor', '<>', ''],
            // ['mpuw_nama', 'like', "%$search%"],
        ]);

        if (!empty($request->q)) {
            $vtable->where('mpuw_nomor', 'LIKE', "%$request->q%")->orWhere('mpuw_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->orderBy('mpuw_nomor', 'ASC')
        // ->offset($offset)
        // ->limit($rows)
        ->get();

        return response()->json($data);
        // return $data;
    }

    public function lihatTarif(Request $request, $kode)
    {
        if ($request->ajax()) {
            $data = DB::table('emst.mst_tarif_usia_jwaktu')
                ->where([
                    ['mstuj_mth_pk', $kode],
                ])
                ->get();

            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function lihatUw(Request $request, $kode)
    {
        if ($request->ajax()) {
            $data = DB::table('emst.mst_polis_uwtable_dtl')
                ->where([
                    ['mrmp_mpuw_nomor', $kode],
                ])
                ->get();

            return DataTables::of($data)->make(true);
        }
    }
}
