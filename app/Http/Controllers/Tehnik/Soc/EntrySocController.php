<?php

namespace App\Http\Controllers\Tehnik\Soc;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
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
    public function index()
    {
        $meka1 = DB::connection('emst')
        ->table('mst_mekanisme')
        ->select(DB::raw("mkm_kode kode, mkm_nama nama"))
        ->where([
            ['mkm_aktif', '!=', 1],
        ])
        ->orderBy('mkm_kode', 'ASC')
        ->get();

        $meka2 = DB::connection('emst')
        ->table('mst_mekanisme2')
        ->select(DB::raw("mkm_kode2 kode, mkm_ket2 nama"))
        ->orderBy('mkm_kode2', 'ASC')
        ->get();

        $jnsKer = DB::connection('emst')
        ->table('emst.mst_pekerjaan')
        ->select(DB::raw("mker_kode kode, mker_nama ket"))
        ->orderBy('mker_kode', 'ASC')
        ->get();

        return view('pages.tehnik.soc.create', [
            'meka1' => $meka1,
            'meka2' => $meka2,
            'jnsKer' => $jnsKer,
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
        $validasi = Validator::make($request->all(), [
            'msoc_mrkn_kode' => 'required',
            // 'mth_ket' => 'required',
            // 'mth_tipe_rumus' => 'required',
            // 'mth_kolom' => 'required',
            // 'mth_baris' => 'required',
            'msoc_dok' => 'required|mimes:pdf',
        ],
        [
            'msoc_mrkn_kode.required'=>'Data pemegang polis harus terisi!',
            'msoc_mekanisme.required'=>'Data mekanisme 1 harus terisi!',
            'msoc_mekanisme2.required'=>'Data mekanisme 2 harus terisi!',
            'msoc_mpojk_kode.required'=>'Data produk harus terisi!',
            'msoc_jenis_bayar.required'=>'Data produk harus terisi!',
            'msoc_jenis_tarif.required'=>'Data jenis tarif harus terisi!',
            // 'mth_ket.required'=>'Data keterangan harus terisi!',
            // 'mth_tipe_rumus.required'=>'Data perhitungan tarif harus terisi!',
            // 'mth_kolom.required'=>'Data kolom harus terisi!',
            // 'mth_baris.required'=>'Data baris harus terisi!',
            'msoc_dok.required'=>'File excel harus terisi!',
            'msoc_dok.mimes'=>'File harus berbentuk *pdf!',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            if (empty($request->msoc_kode)) {
                $vtable = DB::table('eopr.mst_soc');
                $kdAwal = $request->msoc_mjns_kode . '.' . $request->msoc_mpid_kode;
                $kdAkhir = $request->msoc_mft_kode . '.' . $request->msoc_mjm_kode . '.' . $request->msoc_mpras_kode . '.' . $request->msoc_jns_perusahaan;
                $kode = KodeController::__getNo($kdAwal, $vtable->max('msoc_kode'), 4);
                $data = $request->all();
                $data = $request->except(
                    '_token',
                    'e_nasabah',
                    'mpid_mssp_kode',
                    'e_cabalamin',
                    'e_manfaat',
                    'e_manfaat_pol',
                    'e_marketing',
                    'e_pinca',
                    'e_pras',
                    'e_tarif',
                    'e_uw',
                    'edit_akses',
                    'mpid_nama',
                );
                if ($request->msoc_mpid_kode != "" && $request->msoc_endos != "2") {
                    $data['msoc_kode'] = $kode . '.' . $kdAkhir;
                    $data['msoc_kode_ori'] = $kode . '.' . $kdAkhir;
                    $data['msoc_nomor'] = $kode;
                    $data['msoc_approve'] = '0';
                    $data['msoc_endos'] = '0';
                }
                if ($request->hasFile('msoc_dok')) {
                    $msoc_dok = $request->file('msoc_dok');
                    $dir = 'public/tehnik/soc/doc';
                    $fileOri = $msoc_dok->getClientOriginalName();
                    $namaFile = $kode . '.' . $kdAkhir . '-DokumenSoc-' . $fileOri;
                    $path = Storage::putFileAs($dir, $msoc_dok, $namaFile);
                    $data['msoc_dok'] = $namaFile;
                }

                $data['msoc_mkom_persen'] = '0';
                $data['msoc_mkomdisc_persen'] = '0';
                $data['msoc_referal'] = '0';
                $data['msoc_maintenance'] = '0';
                $data['msoc_pajakfee'] = '0';
                $data['msoc_handlingfee'] = '0';
                $data['msoc_handlingfee2'] = '0';
                $data['msoc_ins_date'] = date('Y-m-d H:i:s');
                $data['msoc_ins_user'] = Auth::user()->email;
                $data['msoc_upd_date'] = date('Y-m-d H:i:s');
                $data['msoc_upd_user'] = Auth::user()->email;
                $data['msoc_disc_lain'] = '0';
                $data['msoc_status'] = '0';
                $data['msoc_indexfolder'] = '0';
                $data['msoc_iscopy'] = '0';

                // return $data;
                $vtable->insert($data);

                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode '.$kode . '.' . $kdAkhir.' !'
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

    public function selectPmgPolis(Request $request)
    {
        $search = $request->q;
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $data = DB::connection('emst')
        ->table('mst_rekanan as cb')
        ->select('cb.mrkn_kode as kode', DB::raw("if(cb.mrkn_nama = ps.mrkn_nama OR ps.mrkn_nama IS NULL, cb.mrkn_nama, concat(ps.mrkn_nama, ' ', cb.mrkn_nama)) as nama"))
        ->leftJoin('emst.mst_rekanan as ps', 'ps.mrkn_kode', '=', 'cb.mrkn_kode')
        ->where([
            ['cb.mrkn_kode','<>',''],
            ['cb.mrkn_kantor_pusat','1'],
            ['cb.mrkn_nama','!=',''],
            ['cb.mrkn_nama','like',"%$search%"],
        ])
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function selectJnsNasabah(Request $request)
    {
        $search = $request->q;
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $data = DB::table('emst.mst_jenis_nasabah')
            ->select(DB::raw("mpol_mjns_kode, mpid_nama, mjns_kode, mjns_keterangan, mjns_jl, mjns_jl_pst, mjns_jl_pas, mjns_wp_pens, mjns_phk_pens, mjns_mpid_nomor, mjns_pbiaya"))
            ->leftJoin('eopr.mst_polis', 'mpol_mjns_kode', '=', 'mjns_kode')
            ->leftJoin('emst.mst_produk_induk', 'mpid_kode', '=', 'mjns_mpid_nomor')
            ->where([
                ['mjns_kode', '<>', ''],
                ['mjns_kode', '!=', '00'],
                ['mjns_keterangan', 'like', "%$search%"],
            ])
            ->groupBy('mjns_kode')
            ->offset($offset)
            ->limit($rows)
            ->get();
        return response()->json($data);
    }

    public function selectSegmen(Request $request)
    {
        $vtable1 = DB::table('emst.mst_produk_segment')
        ->select('mssp_kode as value', 'mssp_nama as text', 'mssp_group as group')
        ->where([
            ['mssp_group', '<>', ''],
        ]);
        $vtable2 = DB::table('emst.mst_produk_segment')
        ->select('mssp_kode as value', 'mssp_nama as text')
        ->where([
            ['mssp_group', '=', ''],
        ]);

        if (!empty($request->mjns)) {
            $in = DB::table('emst.mst_protree_2')->select('mptr_kode')->where('mptr_induk', $request->mjns);
            $vtable1->whereIn('mssp_kode', $in);
            $vtable2->whereIn('mssp_kode', $in);
        }

        $data1 = $vtable1->get();
        $data2 = $vtable2->get();
        $merge = $data2->merge($data1);

        return response()->json($merge);
    }

    public function selectNoSpaj(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::connection('eopr')
                ->table('mst_spaj_polis')
                ->select(DB::raw("mspaj_nomor, mspaj_keterangan"))
                ->where([
                    ['mspaj_nomor', '<>', ''],
                    ['mspaj_keterangan', 'like', "%$search%"],
                ])
                ->get();
        } else {
            $data = DB::connection('eopr')
                ->table('mst_spaj_polis')
                ->select(DB::raw("mspaj_nomor, mspaj_keterangan"))
                ->where([
                    ['mspaj_nomor', '<>', ''],
                ])
                ->get();
        }
        return response()->json($data);
    }

    // public function selectMeka1(Request $request)
    // {
    //     $data = [];
    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = DB::connection('emst')
    //             ->table('mst_mekanisme')
    //             ->select(DB::raw("mkm_kode, mkm_nama"))
    //             ->where([
    //                 ['mkm_aktif', '!=', 1],
    //                 ['mkm_nama', 'like', "%$search%"],
    //             ])
    //             ->orderBy('mkm_kode', 'ASC')
    //             ->get();
    //     } else {
    //         $data = DB::connection('emst')
    //             ->table('mst_mekanisme')
    //             ->select(DB::raw("mkm_kode, mkm_nama"))
    //             ->where([
    //                 ['mkm_aktif', '!=', 1],
    //             ])
    //             ->orderBy('mkm_kode', 'ASC')
    //             ->get();
    //     }
    //     return response()->json($data);
    // }

    // public function selectMeka2(Request $request)
    // {
    //     $data = [];
    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = DB::connection('emst')
    //             ->table('mst_mekanisme2')
    //             ->select(DB::raw("mkm_kode2, mkm_ket2"))
    //             ->where([
    //                 ['mkm_ket2', 'like', "%$search%"],
    //             ])
    //             ->orderBy('mkm_kode2', 'ASC')
    //             ->get();
    //     } else {
    //         $data = DB::connection('emst')
    //             ->table('mst_mekanisme2')
    //             ->select(DB::raw("mkm_kode2, mkm_ket2"))
    //             ->orderBy('mkm_kode2', 'ASC')
    //             ->get();
    //     }
    //     return response()->json($data);
    // }

    public function selectManfaatAsu(Request $request)
    {
        $search = $request->q;
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_manfaat_plafond')
        ->select(DB::raw("mft_kode kode, mft_nama nama"))
        ->leftJoin('emst.mst_protree_5', 'mptr_kode', '=', 'mft_kode')
        ->where([
            ['mft_kode', '<>', ''],
            ['mft_nama', 'like', "%$search%"],
        ]);

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

    // public function selectJnsKerja(Request $request)
    // {
    //     $data = [];
    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = DB::connection('emst')
    //             ->table('mst_pekerjaan')
    //             ->select(DB::raw("mker_kode, mker_nama"))
    //             ->where([
    //                 ['mker_nama', 'like', "%$search%"],
    //             ])
    //             ->orderBy('mker_kode', 'ASC')
    //             ->get();
    //     } else {
    //         $data = DB::connection('emst')
    //             ->table('mst_pekerjaan')
    //             ->select(DB::raw("mker_kode, mker_nama"))
    //             ->orderBy('mker_kode', 'ASC')
    //             ->get();
    //     }
    //     return response()->json($data);
    // }

    public function selectGetSoc(Request $request)
    {
        $vtable = DB::table('eopr.mst_soc_induk')
        ->select(DB::raw("msli_nomor msotd_msoc_nomor,
        msli_nomor msoc_nomor,
        msli_mrkn_kode,
        msli_mrkn_nama,
        msli_mpras_kode"))
        ->leftJoin('eopr.mst_soc as msoc', 'msoc.msoc_nomor', '=', 'msli_nomor')
        ->leftJoin('emst.mst_rekanan as rkn', 'rkn.mrkn_kode', '=', 'msli_mrkn_kode')
        ->whereIn('msli_status_endos', [0,1,2]);

        if (!empty($request->pmgpolis)) {
            $vtable->where('msli_mrkn_kode', $request->pmgpolis);
        }
        if (!empty($request->nopolis)) {
            $vtable->where('msli_nomor', $request->nopolis);
        }
        if (!empty($request->nasabah)) {
            $vtable->where('msli_mjns_kode', $request->nasabah);
        }
        if (!empty($request->mft)) {
            $vtable->where('msoc_mft_kode', $request->mft);
        }
        if (!empty($request->mekanisme)) {
            $vtable->where('msoc_mekanisme', $request->mekanisme);
        }
        if (!empty($request->mekanisme2)) {
            $vtable->where('msoc_mekanisme2', $request->mekanisme2);
        }
        if (!empty($request->perus)) {
            $vtable->where('msli_mrkn_kode', $request->perus);
        }
        if (!empty($request->jns_bayar)) {
            $vtable->where('msoc_jenis_bayar', $request->jns_bayar);
        }
        if (!empty($request->mrkn_nama)) {
            $vtable->where('msli_mrkn_nama', $request->mrkn_nama);
        }

        $data = $vtable->get();
        return response()->json($data);
    }

    public function selectJamiAsu(Request $request)
    {
        $search = $request->q;
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_jaminan')
        ->select(DB::raw("mjm_kode, mjm_nama, mjm_bundling, mjm_jiwa, mjm_gu, mjm_phk, mjm_tlo, mjm_fire, mjm_wp, mjm_umut, mpid_kode, mpid.mpid_nama mpid_nama"))
        ->leftJoin('emst.mst_protree_3 as mptr3', 'mptr3.mptr_kode', '=', 'mjm_kode')
        ->leftJoin('emst.mst_produk_induk as mpid', 'mpid.mpid_kode', '=', 'mptr_mpid_kode')
        ->where([
            ['mjm_kode', '<>', ''],
            ['mjm_nama', 'like', "%$search%"],
        ]);

        if (!empty($request->mjns)) {
            $vtable->where('mptr_induk_nasabah', $request->mjns);
        }
        if (!empty($request->mssp)) {
            $vtable->where('mptr_induk', $request->mssp);
        }
        $data = $vtable->orderBy('mpid_nama', 'ASC')->offset($offset)->limit($rows)->get();
        return response()->json($data);
    }

    public function pilihProgramAsuransi(Request $request)
    {
        $search = $request->q;
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_program_asuransi')
        ->select(DB::raw("mpras_kode,
        mpras_nama,
        mpras_uptambah,
        mpras_ujrah_referal,
        mpras_disc_rate,
        mpras_info,
        mpras_mmft_kode_jiwa,
        msoc_mekanisme,
        ifnull(msoc_kode,'') msoc_kode,
        msoc_mekanisme2"))
        ->leftJoin('emst.mst_protree_4 as mptr', 'mptr.mptr_kode', '=', 'mpras_kode')
        ->leftJoin('eopr.mst_soc', 'mpras_kode', '=', 'msoc_mpras_kode')
        ->where([
            ['mpras_kode', '<>', ''],
            ['mpras_nama','like',"%$search%"],
        ]);
        if (!empty($request->mjns)) {
            $vtable->where('msoc_mjns_kode', $request->mjns);
        }
        if (!empty($request->mft)) {
            $vtable->where('msoc_mft_kode', $request->mft);
        }
        if (!empty($request->mrkn)) {
            $vtable->where('msoc_mrkn_kode', $request->mrkn);
        }
        if (!empty($request->mssp)) {
            $vtable->where('msoc_mssp_nama', $request->mssp);
        }
        if (!empty($request->mkm)) {
            $vtable->where('msoc_mekanisme', $request->mkm);
        }
        if (!empty($request->mkm2)) {
            $vtable->where('msoc_mekanisme2', $request->mkm2);
        }
        if (!empty($request->perush)) {
            $vtable->where('msoc_jns_perusahaan', $request->perush);
        }
        if (!empty($request->byr)) {
            $vtable->where('msoc_jenis_bayar', $request->byr);
        }
        if (!empty($request->mjm)) {
            $vtable->where('msoc_mjm_kode', $request->mjm);
        }
        if (!empty($request->mpid)) {
            $vtable->where('msoc_mpid_kode', $request->mpid);
        }

        $data = $vtable->groupBy('mpras_kode')->offset($offset)->limit($rows)->get();

        return response()->json($data);
    }

    public function selectSalDistri(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_saluran_distribusi')
                ->select(DB::raw("mslr_kode, mslr_ket"))
                ->where([
                    ['mslr_ket', 'like', "%$search%"],
                ])
                ->orderBy('mslr_kode', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_saluran_distribusi')
                ->select(DB::raw("mslr_kode, mslr_ket"))
                ->orderBy('mslr_kode', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectProdOjk(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_produk_ojk')
                ->select(DB::raw("mpojk_kode, mpojk_nama"))
                ->where([
                    ['mpojk_nama', 'like', "%$search%"],
                ])
                ->orderBy('mpojk_kode', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_produk_ojk')
                ->select(DB::raw("mpojk_kode, mpojk_nama"))
                ->orderBy('mpojk_kode', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectCabAlamin(Request $request)
    {
        $data2 = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data1 = DB::table('emst.mst_lokasi')
                ->select(DB::raw("mlok_kode kode,
                mlok_nama nama,
                IFNULL(skar_pk,'') kd_pinca,
                IFNULL(skar_nama,'') nm_pinca,
                mlok_sn sn"))
                ->leftJoin('esdm.sdm_karyawan_new', 'skar_mlok_kode', '=', 'mlok_kode')
                ->whereIn('skar_sjab_kode', ['KACAB','PINCA','PJSKACAB','PLTKACAB','WAKACAB'])
                ->where([
                    ['mlok_kode', '<>', ''],
                    ['mlok_nama', '!=', ''],
                    ['mlok_nama', 'like', "%$search%"],
                ])
                ->groupBy('mlok_kode');
            $data2 = DB::table('emst.mst_lokasi')
                ->select(DB::raw("mlok_kode kode,
                mlok_nama nama,
                '' kd_pinca,
                '' nm_pinca,
                mlok_sn sn"))
                ->where([
                    ['mlok_tipe', 0],
                    ['mlok_nama', '!=', ''],
                    ['mlok_nama', 'like', "%$search%"],
                ])
                ->groupBy('mlok_kode')
                ->union($data1)
                ->get();
        } else {
            $data1 = DB::table('emst.mst_lokasi')
                ->select(DB::raw("mlok_kode kode,
                mlok_nama nama,
                IFNULL(skar_pk, '') kd_pinca,
                IFNULL(skar_nama, '') nm_pinca,
                mlok_sn sn"))
                ->leftJoin('esdm.sdm_karyawan_new', 'skar_mlok_kode', '=', 'mlok_kode')
                ->whereIn('skar_sjab_kode', ['KACAB','PINCA','PJSKACAB','PLTKACAB','WAKACAB'])
                ->where([
                    ['mlok_kode', '<>', ''],
                    ['mlok_nama', '!=', ''],
                ])
                ->groupBy('mlok_kode');
            $data2 = DB::table('emst.mst_lokasi')
                ->select(DB::raw("mlok_kode kode,
                mlok_nama nama,
                '' kd_pinca,
                '' nm_pinca,
                mlok_sn sn"))
                ->where([
                    ['mlok_tipe', 0],
                    ['mlok_nama', '!=', ''],
                ])
                ->groupBy('mlok_kode')
                ->union($data1)
                ->get();
        }
        return response()->json($data2);
    }

    public function selectMarketing(Request $request, $kode)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('esdm.sdm_karyawan_new')
                ->select(DB::raw("skar_pk kode,
                skar_nama nama,
                '0' skar_komisi,
                '0' skar_overreding"))
                ->leftJoin('esdm.sdm_jabatan', 'sjab_kode', '=', 'skar_sjab_kode')
                ->where([
                    ['skar_mlok_kode', $kode],
                    ['skar_nip_lama', '<>', ''],
                    ['skar_mlok_kode', '!=', 01],
                    ['skar_nama', 'like', "%$search%"],
                ])
                ->whereIn('skar_status_kary', [0,1,4])
                ->get();
        } else {
            $data = DB::table('esdm.sdm_karyawan_new')
                ->select(DB::raw("skar_pk kode,
                skar_nama nama,
                '0' skar_komisi,
                '0' skar_overreding"))
                ->leftJoin('esdm.sdm_jabatan', 'sjab_kode', '=', 'skar_sjab_kode')
                ->where([
                    ['skar_mlok_kode', $kode],
                    ['skar_nip_lama', '<>', ''],
                    ['skar_mlok_kode', '!=', 01],
                ])
                ->get();
        }
        return response()->json($data);
    }

    public function selectFeePPn(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_manajemen_fee')
                ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"))
                ->where([
                    ['mmfee_tampil', 'like', "%$search%"],
                ])
                ->orderBy('mmfee_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_manajemen_fee')
                ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"))
                ->orderBy('mmfee_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectFeePPh23(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_manajemen_fee')
                ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"))
                ->where([
                    ['mmfee_tampil', 'like', "%$search%"],
                ])
                ->orderBy('mmfee_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_manajemen_fee')
                ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"))
                ->orderBy('mmfee_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectUjroh(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_ujroh')
                ->select(DB::raw("mujh_tampil persen, mujh_persen tampil"))
                ->where([
                    ['mujh_tipe', 'Ujroh'],
                    ['mujh_persen', 'like', "%$search%"],
                ])
                ->orderBy('mujh_tampil', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_ujroh')
                ->select(DB::raw("mujh_tampil persen, mujh_persen tampil"))
                ->where([
                    ['mujh_tipe', 'Ujroh'],
                ])
                ->orderBy('mujh_tampil', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectMnFee(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_manajemen_fee')
                ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"))
                ->where([
                    ['mmfee_tampil', 'like', "%$search%"],
                ])
                ->orderBy('mmfee_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_manajemen_fee')
                ->select(DB::raw("mmfee_persen persen, mmfee_tampil tampil"))
                ->orderBy('mmfee_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectKomtidakpot(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_komisi')
                ->select(DB::raw("mkom_persen persen, mkom_tipe tipe"))
                ->where([
                    ['mkom_tipe', 'like', "%$search%"],
                ])
                ->orderBy('mkom_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_komisi')
                ->select(DB::raw("mkom_persen persen, mkom_tipe tipe"))
                ->orderBy('mkom_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectKompot(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_komisi')
                ->select(DB::raw("mkom_persen persen, mkom_tipe tipe"))
                ->where([
                    ['mkom_tipe', 'like', "%$search%"],
                ])
                ->orderBy('mkom_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_komisi')
                ->select(DB::raw("mkom_persen persen, mkom_tipe tipe"))
                ->orderBy('mkom_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectReferal(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_discount_rate')
                ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"))
                ->where([
                    ['mdr_tipe', 'like', "%$search%"],
                ])
                ->orderBy('mdr_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_discount_rate')
                ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"))
                ->orderBy('mdr_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectMaintenence(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_discount_rate')
                ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"))
                ->where([
                    ['mdr_tipe', 'like', "%$search%"],
                ])
                ->orderBy('mdr_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_discount_rate')
                ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"))
                ->orderBy('mdr_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectFeebtidakpotong(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_fee')
                ->select(DB::raw("mfee_persen persen, mfee_tipe tipe"))
                ->where([
                    ['mfee_tipe', 'like', "%$search%"],
                ])
                ->orderBy('mfee_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_fee')
                ->select(DB::raw("mfee_persen persen, mfee_tipe tipe"))
                ->orderBy('mfee_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectFeebpotong(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_discount_rate')
                ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"))
                ->where([
                    ['mdr_tipe', 'like', "%$search%"],
                ])
                ->orderBy('mdr_persen', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_discount_rate')
                ->select(DB::raw("mdr_persen persen, mdr_tipe tipe"))
                ->orderBy('mdr_persen', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectTarifImport(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_tarif')
                ->select(DB::raw("mth_nomor kode, mth_ket nama"))
                ->where([
                    ['mth_nomor', '<>', ''],
                    ['mth_ket', 'like', "%$search%"],
                ])
                ->orderBy('mth_nomor', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_tarif')
                ->select(DB::raw("mth_nomor kode, mth_ket nama"))
                ->where([
                    ['mth_nomor', '<>', ''],
                ])
                ->orderBy('mth_nomor', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function selectUnderwritingImport(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_polis_uwtable')
                ->select(DB::raw("mpuw_nomor kode, mpuw_nama nama"))
                ->where([
                    ['mpuw_nomor', '<>', ''],
                    ['mpuw_nama', 'like', "%$search%"],
                ])
                ->orderBy('mpuw_nomor', 'ASC')
                ->get();
        } else {
            $data = DB::table('emst.mst_polis_uwtable')
                ->select(DB::raw("mpuw_nomor kode, mpuw_nama nama"))
                ->where([
                    ['mpuw_nomor', '<>', ''],
                ])
                ->orderBy('mpuw_nomor', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function lihatTarif(Request $request, $kode)
    {
        if ($request->ajax()) {
            $data = DB::table('emst.mst_tarif_usia_jwaktu')
                ->select('*')
                ->where([
                    ['mstuj_mth_pk', $kode],
                ])
                ->get();

            return DataTables::of($data)->make(true);
        }
    }

    public function lihatUw(Request $request, $kode)
    {
        if ($request->ajax()) {
            $data = DB::table('emst.mst_polis_uwtable_dtl')
                ->select('*')
                ->where([
                    ['mrmp_mpuw_nomor', $kode],
                ])
                ->get();

            return DataTables::of($data)->make(true);
        }
    }
}
