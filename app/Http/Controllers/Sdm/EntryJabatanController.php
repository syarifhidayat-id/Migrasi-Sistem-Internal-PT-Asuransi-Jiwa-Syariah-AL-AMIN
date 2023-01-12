<?php

namespace App\Http\Controllers\Sdm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Config;
use App\Models\Sdm\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Sdm\Jabatan;
use App\Models\Sdm\Level;

class EntryJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carilevel = Level::select('slv_kode')
        ->get();

        $caridirektorat = Direktorat::select('sdir_ket')
        ->get();

            return view('pages.sdm.master-jabatan.index', [
                'carilevel' => $carilevel,
                'caridirektorat' => $caridirektorat,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil()
    {
        $carijab = Jabatan::select('sjab_kode', 'sjab_level', 'sjab_ket', 'sjab_sdir_kode')
        ->get();

        $cariket = Jabatan::select('sjab_ket')
        ->get();


            return view('pages.sdm.master-jabatan.lihat-jabatan.index', [

                'carijab' => $carijab,
                'cariket' => $cariket,
            ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //PK MANUAL

         $validasi = Validator::make($request->all(), [
            'sjab_kode' => 'required',
            'sjab_level' => 'required',
            'sjab_ket' => 'required',
            'sjab_sdir_kode' => 'required',
        ]);

         if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        $vTable = DB::connection('esdm')->table('sdm_jabatan');
        $data = $request->all();
        $data = $request->except('_token');

        //NILAI CUSTOM NULL
        $data['sjab_ket2'] = 0;
        $data['sjab_transport'] = 0;
        $data['sjab_lapproduksi'] = 0;
        $data['sjab_pks'] = 0;
        $data['sjab_master'] = 0;
        $data['sjab_soc'] = 0;
        $data['sjab_editsoc'] = 0;
        $data['sjab_polis'] = 0;
        $data['sjab_lihatpolis'] = 0;
        $data['sjab_klaim'] = 0;
        $data['sjab_peserta'] = 0;
        $data['sjab_peserta_kump'] = 0;
        $data['sjab_pesertaman'] = 0;
        $data['sjab_konfirmpst'] = 0;
        $data['sjab_reas'] = 0;
        $data['sjab_em'] = 0;
        $data['sjab_approv_em'] = 0;
        $data['sjab_batalpst'] = 0;
        $data['sjab_batalpstfix'] = 0;
        $data['sjab_rekonpst'] = 0;
        $data['sjab_giro'] = 0;
        $data['sjab_komisi'] = 0;
        $data['sjab_reguser'] = 0;
        $data['sjab_refundpst'] = 0;
        $data['sjab_aprovsoc'] = 0;
        $data['sjab_aprovpolis'] = 0;
        $data['sjab_cetakpstkump'] = 0;
        $data['sjab_aprovrefund'] = 0;
        $data['sjab_peserta_revisi'] = 0;
        $data['sjab_aprovsuratin'] = 0;
        $data['sjab_aprovsuratout'] = 0;
        $data['sjab_aprovlembur'] = 0;
        $data['sjab_aprovcuti'] = 0;
        $data['sjab_aprovizin'] = 0;
        $data['sjab_aprovpesertakump'] = 0;
        $data['sjab_aprovpeserta'] = 0;
        $data['sjab_aprovpesertacabang'] = 0;
        $data['sjab_aprovpesertadisc'] = 0;
        $data['sjab_aprovklaim'] = 0;
        $data['sjab_aprovklaimtipe'] = 0;
        $data['sjab_aprovreas'] = 0;
        $data['sjab_aprovgiro'] = 0;
        $data['sjab_aprovregkaryawan'] = 0;
        $data['sjab_hapuspst'] = 0;
        $data['sjab_hapus_agenda'] = 0;
        $data['sjab_byrpst'] = 0;
        $data['sjab_errpst'] = 0;
        $data['sjab_editbayar'] = 0;
        $data['sjab_aprovunlebih'] = 0;
        $data['sjab_limit'] = 0;
        $data['sjab_limit_nm'] = 0;
        $data['sjab_acc_jurnal'] = 0;
        $data['sjab_chat_tipe'] = 0;
        $data['sjab_target'] = 0;
        $data['sjab_hapusrekon'] = 0;
        $data['sjab_btlpst_rekon'] = 0;
        $data['sjab_revisikump'] = 0;
        $data['sjab_spt'] = 0;
        $data['sjab_tunjangan'] = 0;
        $data['sjab_hrd_1'] = 0;
        $data['sjab_editakun'] = 0;
        $data['sjab_del_trskeu'] = 0;
        $data['sjab_approv_suratout'] = 0;
        $data['sjab_approv_dknote'] = 0;
        $data['sjab_cek_dknote'] = 0;
        $data['sjab_approv_lembur'] = 0;
        $data['sjab_lembur'] = 0;
        $data['sjab_approvtc'] = 0;
        $data['sjab_upd_tglrk'] = 0;
        $data['sjab_jurmem'] = 0;
        $data['sjab_aprov_acc'] = 0;
        $data['sjab_approv_lembur_sdm'] = 0;
        $data['sjab_dboard'] = 0;
        $data['sjab_trt_kode'] = 0;
        $data['sjab_klmre_kadiv'] = 0;
        $data['sjab_kadiv_acc'] = 0;
        $data['sjab_editrk'] = 0;
        $data['sjab_hapustrs'] = 0;
        $data['sjab_final_rpt'] = 0;
        $data['sjab_aktif_batal'] = 0;
        $data['sjab_updbyr_admdenda'] = 0;
        $data['sjab_ins_bbnklm'] = 0;
        $data['sjab_spj'] = 0;
        $data['sjab_jam_absen'] = 0;
        $data['sjab_kel_absen'] = 0;
        $data['sjab_aprov2'] = 0;
        $data['sjab_aprov_status_1'] = 0;
        $data['sjab_aprov_status_2'] = 0;
        $data['sjab_aprov_status_3'] = 0;
        $data['sjab_aprov_status_4'] = 0;
        $data['sjab_aprov_status_5'] = 0;
        $data['sjab_aprov_status_6'] = 0;
        $data['sjab_aprov_value_1'] = 0;
        $data['sjab_aprov_value_2'] = 0;
        $data['sjab_aprov_value_3'] = 0;
        $data['sjab_aprov_value_4'] = 0;
        $data['sjab_aprov_value_5'] = 0;
        $data['sjab_aprov_value_6'] = 0;
        $data['sjab_aprov_nilai_1'] = 0;
        $data['sjab_aprov_nilai_2'] = 0;
        $data['sjab_aprov_nilai_3'] = 0;
        $data['sjab_aprov_nilai_4'] = 0;
        $data['sjab_aprov_nilai_5'] = 0;
        $data['sjab_aprov_nilai_6'] = 0;
        $data['sjab_aprov_comen_r'] = 0;
        $data['sjab_aprov_comen_c'] = 0;
        $data['sjab_aprov_comen_d'] = 0;
        $data['sjab_notifultah'] = 0;
        $data['sjab_perush'] = 0;

        $vTable->insert($data);

        return response()->json([
            'success' => 'Data berhasil disimpan dengan Kode '.$request->sjab_kode.'!'
        ]);


        //PK OTOMATIS

        // $validasi = Validator::make($request->all(), [
        //     'sdir_ket' => 'required',
        //     'sdir_kode_surat' => 'required',
        // ]);

        // if ($validasi->fails()) {
        //     return response()->json([
        //         'error' => $validasi->errors()
        //     ]);
        // }

        // if ($request->sdir_kode == "") {
        //     $kode = Config::__getKey(14);
        //     $data = $request->all();
        //     $data = $request->except('_token');

        //      $data['sdir_kode'] = $kode;


        //     $vTable = DB::table('esdm.sdm_direktorat');
        //     $vTable->insert($data);
        //     return response()->json([
        //         'success' => 'Data berhasil disimpan dengan Kode '.$kode.'!'
        //     ]);
        //     // return $data;

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
