<?php

namespace App\Http\Controllers\Tehnik;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use App\Models\Tehnik\Polis;
use App\Models\Tehnik\Ojk;
use App\Models\Tehnik\Lini;
use App\Models\Tehnik\Golongan;
use App\Models\Tehnik\Lokasi;
use App\Models\Tehnik\Jaminan;
use App\Models\Tehnik\Nasabah;
use App\Models\Tehnik\Rekanan;
use App\Models\Tehnik\Programasuransi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class EntryPolisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $carirekanan = Rekanan::select('mrkn_nama as nama')
        ->where('mrkn_kantor_pusat', '=', 1)
        ->where('mrkn_status', '!=', 1)
        ->orderBy('mrkn_kode', 'ASC')
        ->get();*/
        $carirekanan = DB::table('emst.mst_rekanan as cb')
        ->select('cb.mrkn_kode as kode', DB::raw("if(cb.mrkn_nama = ps.mrkn_nama OR ps.mrkn_nama IS NULL, cb.mrkn_nama, concat(ps.mrkn_nama, ' ', cb.mrkn_nama)) as nama"))
        ->leftJoin('emst.mst_rekanan as ps', 'ps.mrkn_kode', '=', 'cb.mrkn_kode')
        ->where([
            ['cb.mrkn_kode','<>',''],
            ['cb.mrkn_kantor_pusat','1'],
            ['cb.mrkn_nama','!=',''],
            // ['cb.mrkn_nama','like',"%$search%"],
        ])->get();
        $cariojk = Ojk::select('mpojk_nama')
        ->get();

        $carilini = Lini::select('mlu_nama')
        ->get();

        $carigolongan = Golongan::select('mgol_nama')
        ->get();


            return view('pages.tehnik.polis.entry-master-polis.index', [
                'carirekanan' => $carirekanan,
                'cariojk' => $cariojk,
                'carilini' => $carilini,
                'carigolongan' => $carigolongan,
            ]);
    }

   /* public function selectPmgPolis(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_rekanan as cb')
        ->select('cb.mrkn_kode as kode', DB::raw("if(cb.mrkn_nama = ps.mrkn_nama OR ps.mrkn_nama IS NULL, cb.mrkn_nama, concat(ps.mrkn_nama, ' ', cb.mrkn_nama)) as nama"))
        ->leftJoin('emst.mst_rekanan as ps', 'ps.mrkn_kode', '=', 'cb.mrkn_kode')
        ->where([
            ['cb.mrkn_kode','<>',''],
            ['cb.mrkn_kantor_pusat','1'],
            ['cb.mrkn_nama','!=',''],
            // ['cb.mrkn_nama','like',"%$search%"],
        ]);

        if (!empty($request->q)) {
            $vtable->where('cb.mrkn_kode', 'LIKE', "%$request->q%")->orWhere('cb.mrkn_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        //return response()->json($data);
        echo response()->json($data);
    }*/

    public function selectSOC(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('eopr.mst_soc')
        ->select('msoc_mjns_kode','msoc_mssp_kode','msoc_mpras_kode','msoc_mjm_kode','msoc_mft_kode','msoc_mekanisme','msoc_jns_perusahaan','msoc_mekanisme2','msoc_kode','msoc_mrkn_nama', 'mjm.mjm_nama as msoc_mjm_nama',
        'msoc_mujh_persen','msoc_mmfe_persen','msoc_overreding','msoc_mfee_persen','msoc_mkom_persen','msoc_mdr_kode','mjns_Keterangan',
        'mssp_nama','mpras_nama','mjns_wp_pens','mjns_phk_pens','mjm_jiwa','mjm_gu','mjm_tlo','mjm_fire','mpras_uptambah','mpras_ujrah_referal','mpras_disc_rate','mjns_jl','mjns_jl_pst','mjns_jl_pas','mjns_mpid_nomor',
        'mft_nama','mkm_nama','mpras_nama','mkm_ket2','mker_nama','msoc_ins_date','msoc_ins_user','mjm_nama', DB::raw("if(mjm_kode='05',0,mjm_phk) mjm_phk"),DB::raw("if(mjm_kode='05',0,mjm_wp) mjm_wp"),
        DB::RAW("IF(mjns_kode!='11' OR mjns_kode!='14',0,mjm_wp_pensiun) mjm_wp_pensiun"),DB::raw("IF(mjns_kode='11' OR mjns_kode='14',0,mjm_wp_pns) mjm_wp_pns"),
        DB::RAW("IF(mjns_kode='11' OR mjns_kode='14',0,mjm_wp_swasta) mjm_wp_swasta"), DB::RAW(" IF(mjns_kode!='11' OR mjns_kode!='14',0,mjm_phk_pensiun) mjm_phk_pensiun"),
        DB::RAW("IF(mjns_kode='11' OR mjns_kode='14',0,mjm_phk_pns) mjm_phk_pns"),DB::RAW("IF(mjns_kode='11' OR mjns_kode='14',0,mjm_phk_swasta) mjm_phk_swasta"),DB::RAW("if(msoc_jenis_bayar=2,'PER BULAN',if(msoc_jenis_bayar=1,'PER TAHUN','SEKALIGUS')) bayar "))
        ->leftJoin('emst.mst_jenis_nasabah as mjns', 'mjns.mjns_kode', '=', 'msoc_mjns_kode')
        ->leftJoin('emst.mst_produk_segment as mssp', 'mssp.mssp_kode', '=', 'msoc_mssp_kode')
        ->leftJoin('emst.mst_program_asuransi as mpras', 'mpras.mpras_kode', '=', 'msoc_mpras_kode')
        ->leftJoin('emst.mst_jaminan as mjm', 'mjm.mjm_kode', '=', 'msoc_mjm_kode')
        ->leftJoin('emst.mst_manfaat_plafond', 'mft_kode', '=', 'msoc_mft_kode')
        ->leftJoin('emst.mst_mekanisme', 'mkm_kode', '=', 'msoc_mekanisme')
        ->leftJoin('emst.mst_pekerjaan', 'mker_kode', '=', 'msoc_jns_perusahaan')
        ->leftJoin('emst.mst_mekanisme2', 'mkm_kode2', '=', 'msoc_mekanisme2')
        ->where([
            ['msoc_mrkn_kode',$request->q],
            ['msoc_approve','1'],
            ['msoc_endos','!=','3'],
        ]);
        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
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

    // public function getTipepolis($id)
    // {
    //     $polisTipe = Polis::where('mpol_kode', $id)
    //     // ->where(function($row) {
    //     //     $row->where('wmn_key', 'MAIN');
    //     //     // ->orwhere('wmn_key', 'wmn_kode');
    //     // })
    //     // ->where('wmn_key', '=', $request->wmn_kode)
    //     ->get();
    //     return response()->json($polisTipe);
    // }

    // public function edit($id)
    // {
    //     // $menu = Menu::where('wmn_kode', $id)->first();
    //     $polis = Polis::findOrFail($id);
    //     // $menu = Menu::findOrFail($id);
    //     return response()->json($polis);
    // }

    // public function keyPolis($id)
    // {
    //     $keyPolis = Polis::where('mpol_kode', $id)->first();
    //     return response()->json($keyPolis);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //PK MANUAL
    //     $validasi = Validator::make($request->all(), [
    //         // 'mpol_kode' => 'required',
    //         // 'sdir_ket' => 'required',
    //         // 'sdir_kode_surat' => 'required',
    //     ]);

    //      if ($validasi->fails()) {
    //         return response()->json([
    //             'error' => $validasi->errors()
    //         ]);
    //     }

    //     $vTable = DB::connection('eopr')->table('mst_polis');
    //     $data = $request->all();
    //     $data = $request->except('_token');

    //     $vTable->insert($data);

    //     return response()->json([
    //         'success' => 'Data berhasil disimpan dengan Kode '.$request->mpol_kode.'!'
    //     ]);

    // }


        //PK OTOMATIS
        $validasi = Validator::make($request->all(), [
            'mpol_mrkn_nama' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        if ($request->mpol_kode == "") {
            $vTable = DB::table('eopr.mst_polis');
            $kode = KodeController::__getPK($vTable->max('mpol_kode'), 14);
            // $kode = KodeController::__getKey(14);
            $data = $request->all();
            $data = $request->except('_token');

            $data['mpol_kode'] = $kode;
            $data['mpol_ins_user'] = $request->user()->email;
            $data['mpol_ins_date'] = date('Y-m-d H:i:s');

            //NILAI JIKA CUSTOM NULL DI TABEL
            // $data['mpol_kode_ori'] = 0;
            // $data['mpol_endos'] = 0;
            // $data['mpol_aktif'] = 1;
            // $data['mpol_mekanisme'] = 0;
            // $data['mpol_mekanisme2'] = 0;
            // $data['mpol_endos_idx'] = 0;
            // $data['mpol_file_page'] = 0;
            // $data['mpol_max_up'] = 0;
            // $data['mpol_openpolis'] = 0;
            // $data['mpol_mssp_kode'] = 0;
            // $data['mpol_mssp_nama'] = 0;
            // $data['mpol_mlok_kode'] = 0;
            // $data['mpol_mkar_kode_mkr'] = 0;
            // $data['mpol_mgol_kode'] = 0;
            // $data['mpol_mgp_kode'] = 0;
            // $data['mpol_mgs_kode'] = 0;
            // $data['mpol_mlu_kode'] = 0;
            // $data['mpol_usia_min'] = 17;
            // $data['mpol_usia_max'] = 74;
            // $data['mpol_jatuh_tempo'] = 0;
            // $data['mpol_lapor_data'] = 0;
            // $data['mpol_lapor_stnc'] = 0;
            // $data['mpol_byr_premi'] = 0;
            // $data['mpol_mujh_persen'] = 0;
            // $data['mpol_mkomdisc_persen'] = 0;
            // $data['mpol_referal'] = 0;
            // $data['mpol_maintenance'] = 0;
            // $data['mpol_pajakfee'] = 0;
            // $data['mpol_handlingfee'] = 0;
            // $data['mpol_pajakfee_persen'] = 0;
            // $data['mpol_pajakkom_persen'] = 0;
            // $data['mpol_jns_tarif'] = 0;
            // $data['mpol_ket_endors'] = 0;
            // $data['mpol_tgl_terbit'] = '1881-01-01';
            // $data['mpol_mmft_kode_gu'] = 0;
            // $data['mpol_mmft_kode_wp_swasta'] = 0;
            // $data['mpol_mmft_kode_wp_pns'] = 0;
            // $data['mpol_mmft_kode_wp_pensiun'] = 0;
            // $data['mpol_mmft_kode_phk_pensiun'] = 0;
            // $data['mpol_mmft_kode_phk_swasta'] = 0;
            // $data['mpol_mmft_kode_phk_pns'] = 0;
            // $data['mpol_mmft_kode_tlo'] = 0;
            // $data['mpol_mmft_kode_fire'] = 0;
            // $data['mpol_mmft_kode_jiwa'] = 0;
            // $data['mpol_no_endors'] = 0;
            // $data['mpol_approve'] = 0;
            // $data['mpol_jl'] = 0;
            // $data['mpol_jl_pst'] = 0;
            // $data['mpol_jl_pasangan'] = 0;
            // $data['mpol_msoc_kode'] = 0;
            // $data['mpol_aprove_fc'] = 0;
            // $data['mpol_mjns_mpid_kode'] = 0;
            // $data['mpol_ketagihan'] = 'Ujrah / Diskon Pemegang Polis';
            // $data['mpol_indexfolder'] = 3;
            // $data['mpol_ujroh_treaty'] = 0;
            // $data['mpol_trbr_date'] = '1881-01-01';
            // $data['mpol_sync'] = '1881-01-01';
            // $data['mpol_standar_perlindungan'] = 0;
            // $data['mpol_standar_premi'] = 0;
            // $data['mpol_host2host'] = 0;
            // $data['mpol_convert_img'] = 0;
            // $data['mpol_iscopy'] = 0;
            // $data['mpol_pilihan_cetak'] = 0;
            // $data['mpol_mjasu_kode'] = 0;
            // $data['mpol_acc_tek'] = 0;
            // $data['mpol_kode'] = $request->mpol_kode.'01234';
            //  $data['mpol_mrkn_nama'] = $request->mpol_mrkn_nama;
            //  $data['mpol_msoc_kode'] = $request->mpol_msoc_kode;
            //  $data['mpol_mspaj_nomor'] = $request->mpol_mspaj_nomor;
            // $data['mpol_mrkn_nama'] = $request->mpol_mrkn_nama;
            $vTable->insert($data);
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode '.$kode.'!'
            ]);
            // return $data;

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
