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
        $validasi = Validator::make($request->all(), [
            'mpol_mrkn_nama' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        if ($request->mpol_kode == "") {
            $kode = KodeController::__getKey(14);
            $data = $request->all();
            $data = $request->except('_token');

            $data['mpol_kode'] = $kode;
            $data['mpol_mrkn_nama'] = $request->mpol_mrkn_nama;
            // $request->merge([
            //         'mpol_kode' => $kode,
            //         'mpol_kode_ori'  => '0',
            //         'mpol_endos' => '0',
            //         'mpol_aktif' => '0',
            //         'mpol_mekanisme' => '0',
            //         'mpol_mekanisme2' => '0',
            //         'mpol_endos_idx' => '0',
            //         'mpol_file_page' => '0',
            //         'mpol_max_up' => '0',
            //         'mpol_openpolis' => '0',
            //         'mpol_mgol_kode' => '0',
            //         'mpol_mgp_kode' => '0',
            //         'mpol_mgs_kode' => '0',
            //         'mpol_mlu_kode' => '0',
            //         'mpol_jns_perusahaan' => '0',
            //         'mpol_mja_kode' => '0',
            //         'mpol_mgpp_kode' => '0',
            //         'mpol_usia_min' => '0',
            //         'mpol_usia_max' => '0',
            //         'mpol_jatuh_tempo' => '0',
            //         'mpol_lapor_data' => '0',
            //         'mpol_lapor_stnc' => '0',
            //         'mpol_byr_premi' => '0',
            //         'mpol_mujh_persen' => '0',
            //         'mpol_mkomdisc_persen' => '0',
            //         'mpol_referal' => '0',
            //         'mpol_maintenance' => '0',
            //         'mpol_pajakfee' => '0',
            //         'mpol_handlingfee' => '0',
            //         'mpol_pajakfee_persen' => '0',
            //         'mpol_pajakkom_persen' => '0',
            //         'mpol_jns_tarif' => '0',
            //         'mpol_max_pst' => '0',
            //         'mpol_tipe_uw'=> '0',
            //         'mpol_kadaluarsa_klaim'=> '0',
            //         'mpol_mmft_kode_gu'=> '0',
            //         'mpol_mmft_kode_wp_swasta'=> '0',
            //         'mpol_mmft_kode_wp_pns'=> '0',
            //         'mpol_mmft_kode_phk_pensiun'=> '0',
            //         'mpol_mmft_kode_phk_swasta'=> '0',
            //         'mpol_mmft_kode_phk_pns'=> '0',
            //         'mpol_mmft_kode_tlo'=> '0',
            //         'mpol_mmft_kode_fire'=> '0',
            //         'mpol_mmft_kode_jiwa'=> '0',
            //         'mpol_approve'=> '0',
            //         'mpol_ins_date'=> date('Y-m-d'),
            //         'mpol_ins_user'=> '0',
            //         'mpol_upd_date'=> date('Y-m-d'),
            //         'mpol_upd_user'=> '0',
            //         'mpol_jl'=> '0',
            //         'mpol_jl_pst'=> '0',
            //         'mpol_jl_pasangan'=> '0',
            //         'mpol_aprove_fc'=> '0',
            //         'mpol_sts_akun'=> '0',
            //         'mpol_jenis_cetak'=> '0',
            //         'mpol_jenis_bayar'=> '0',
            //         'mpol_cetak_lunas'=> '0',
            //         'mpol_online'=> '0',
            //         'mpol_online_individual'=> '0',
            //         'mpol_online_rekan'=> '0',
            //         'mpol_surat_tambah'=> '0',
            //         'mpol_va'=> '0',
            //         'mpol_ketagihan'=> '0',
            //         'mpol_indexfolder'=> '0',
            //         'mpol_surplus'=> '0',
            //         'mpol_disc_lain'=> '0',
            //         'mpol_nomor_cetak'=> '0',
            //         'mpol_jenis_login'=> '0',
            //         'mpol_alias'=> '0',
            //         'mpol_status_polis'=> '0',
            //         'mpol_note'=> '0',
            //         'mpol_fee_tampil'=> '0',
            //         'mpol_ujroh_treaty'=> '0',
            //         'mpol_trbr_date'=> date('Y-m-d'),
            //         'mpol_sync'=> '0',
            //         'mpol_payonline'=> '0',
            //         'mpol_agent'=> '0',
            //         'mpol_pemgroupusaha'=> '0',
            //         'mpol_standar_perlindungan'=> '0',
            //         'mpol_standar_premi'=> '0',
            //         'mpol_host2host'=> '0',
            //         'mpol_convert_img'=> '0',
            //         'mpol_iscopy'=> '0',
            //         'mpol_pilihan_cetak'=> '0',
            //         'mpol_mjasu_kode'=> '0',
            //         'mpol_acc_tek'=> '0',
            // ])->except('_token');

            // return $request;
            // Polis::create($request->all());
            $vTable = DB::table('eopr.mst_polis');
            $vTable->insert($data);
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode '.$kode.'!'
            ]);
            // return $data;

        }
        // else {
        //     $menu = Polis::findOrFail($request->wmn_kode);
        //     $menu->update($request->all());

        //     return response()->json([
        //         'success' => 'Data berhasil diupdate dengan Kode '.$request->wmn_kode.'!'
        //     ]);
        // }
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
