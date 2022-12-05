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
        $carirekanan = Rekanan::select('mrkn_nama')
        ->where('mrkn_kantor_pusat', '=', 1)
        ->where('mrkn_status', '!=', 1)
        ->orderBy('mrkn_kode', 'ASC')
        ->get();

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
