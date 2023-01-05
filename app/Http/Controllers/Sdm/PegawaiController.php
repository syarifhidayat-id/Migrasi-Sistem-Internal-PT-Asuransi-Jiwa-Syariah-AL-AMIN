<?php

namespace App\Http\Controllers\Sdm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use App\Models\Sdm\Direktorat;
use App\Models\Sdm\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Sdm\Jabatan;
use App\Models\Sdm\Level;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $carilevel = Level::select('slv_kode', 'slv_keterangan')
        // ->get();

        // $caridirektorat = Direktorat::select('sdir_ket')
        // ->get();

            return view('pages.sdm.master-pegawai.index', [
                // 'carilevel' => $carilevel,
                // // 'caridirektorat' => $caridirektorat,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil()
    {
        $tampillevel = Level::select('slv_kode', 'slv_keterangan', 'slv_tunjangan', 'slv_tun_inap', 'slv_tun_makan', 'slv_tun_saku_wd', 'slv_tun_saku_we', 'slv_tun_saku_lu', 'slv_tun_angkot')
        ->get();

        $carilevel = Level::select('slv_keterangan')
        ->get();


            return view('pages.sdm.master-level.lihat-level.index', [

                'tampillevel' => $tampillevel,
                'carilevel' => $carilevel,
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
            'slv_kode' => 'required',
            'slv_keterangan' => 'required',
            'slv_tunjangan' => 'required',
            'slv_tun_inap' => 'required',
            'slv_tun_makan' => 'required',
            'slv_tun_saku_wd' => 'required',
            'slv_tun_saku_we' => 'required',
            'slv_tun_saku_lu' => 'required',
            'slv_tun_angkot' => 'required',

        ]);

         if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        $vTable = DB::connection('esdm')->table('sdm_level');
        $data = $request->all();
        $data = $request->except('_token');

        //NILAI CUSTOM NULL
        $data['slv_lembur'] = 0;


        $vTable->insert($data);

        return response()->json([
            'success' => 'Data berhasil disimpan dengan Kode '.$request->slv_kode.'!'
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
        //     $kode = KodeController::__getKey(14);
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
