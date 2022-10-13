<?php

namespace App\Http\Controllers\Tehnik;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use App\Models\Tehnik\Polis;
use App\Models\Tehnik\Lokasi;
use App\Models\Tehnik\Jaminan;
use App\Models\Tehnik\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PolisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $listpolis = Polis::select('*', 'lok.mlok_nama', 'jns.mjns_keterangan', 'seg.mssp_nama', 'meka.mkm_nama', 'meka2.mkm_ket2', 'pek.mker_nama', 'man.mft_nama', 'mjm.mjm_nama', 'mpras.mpras_nama', 'ind.mpid_nama', 'ojk.mpojk_nama',
        DB::raw('CASE WHEN mpol_jenis_bayar = "0" THEN "Sekaligus" WHEN mpol_jenis_bayar = "1" THEN "Per Tahun" WHEN mpol_jenis_bayar = "2" THEN "Per Bulan" END as Bayar' ))
        ->leftJoin('emst.mst_lokasi AS lok', 'mpol_mlok_kode', '=', 'lok.mlok_kode')
        ->leftJoin('emst.mst_jenis_nasabah AS jns', 'mpol_mjns_kode', '=', 'jns.mjns_kode')
        ->leftJoin('emst.mst_produk_segment AS seg', 'mpol_mssp_kode', '=', 'seg.mssp_kode')
        ->leftJoin('emst.mst_mekanisme AS meka', 'mpol_mekanisme', '=', 'meka.mkm_kode')
        ->leftJoin('emst.mst_mekanisme2 AS meka2', 'mpol_mekanisme2', '=', 'meka2.mkm_kode2')
        ->leftJoin('emst.mst_pekerjaan AS pek', 'mpol_jns_perusahaan', '=', 'pek.mker_kode')
        ->leftJoin('emst.mst_manfaat_plafond AS man', 'mpol_mft_kode', '=', 'man.mft_kode')
        ->leftJoin('emst.mst_jaminan AS mjm', 'mpol_mjm_kode', '=', 'mjm.mjm_kode')
        ->leftJoin('emst.mst_program_asuransi AS mpras', 'mpol_mpras_kode', '=', 'mpras.mpras_kode')
        ->leftJoin('emst.mst_produk_induk AS ind', 'mpol_mpid_kode', '=', 'ind.mpid_kode')
        ->leftJoin('emst.mst_produk_ojk AS ojk', 'mpol_mpojk_kode', '=', 'ojk.mpojk_kode')

        // LEFT JOIN emst.mst_produk_ojk on mpojk_kode=mpol_mpojk_kode

        // ->orderBy('mlok_nama', 'ASC')
        // ->orderBy('mpol_mrkn_nama', 'ASC')

        ->get();

        $carilokasi = Lokasi::select('mlok_nama')
        ->get();

        $carijaminan = Jaminan::select('mjm_nama')
        ->get();

        $carinasabah = Nasabah::select('mjns_keterangan')
        ->get();

        $caripolis = Polis::select('mpol_mrkn_nama')
        ->get();


        return view('pages.tehnik.polis.lihat-polis.index', [
            'listpolis' => $listpolis,
            'carilokasi' => $carilokasi,
            'carijaminan' => $carijaminan,
            'carinasabah' => $carinasabah,
            'caripolis' => $caripolis,
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
        // $validasi = Validator::make($request->all(), [
        //     'email' => 'required',
        //     'no_hp' => 'required',
        //     'email_user' => 'required',
        //     'email_cc' => 'required',
        //     'name' => 'required',
        //     'password' => 'required',
        //     'menu_tipe' => 'required',
        // ]);

        // if ($validasi->fails()) {
        //     return response()->json([
        //         'error' => $validasi->errors()
        //     ]);
        // }

        // if ($request->id == "") {
        //     $kode = KodeController::__getPK(User::all()->max('id'), 15);

        //     // if ($request->wmn_url == "") {
        //     //     $request->merge([
        //     //         'wmn_url' => 'maintenance',
        //     //     ]);
        //     // }

        //     $request->merge([
        //         'id' => $kode,
        //     ]);

        //     User::create($request->all());

        //     return response()->json([
        //         'success' => 'Data berhasil disimpan dengan Kode '.$kode.'!'
        //     ]);

        // } else {
        //     $user = User::findOrFail($request->id);
        //     $user->update($request->all());

        //     return response()->json([
        //         'success' => 'Data berhasil diupdate dengan Kode '.$request->id.'!'
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
