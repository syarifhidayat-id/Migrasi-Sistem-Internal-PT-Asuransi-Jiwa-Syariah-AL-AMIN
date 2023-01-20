<?php

namespace App\Http\Controllers\Sdm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
use App\Models\Sdm\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Sdm\Jabatan;
use App\Models\Sdm\Level;
use App\Models\Sdm\Keahlian;

class EntryKeahlianController extends Controller
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

            return view('pages.sdm.master-keahlian.index', [
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
        $tampilkeahlian = Keahlian::select('skah_kode', 'skah_ket', 'skah_tunjangan')
        ->get();

        // $carilevel = Level::select('slv_keterangan')
        // ->get();


            return view('pages.sdm.master-keahlian.lihat-keahlian.index', [

                'tampilkeahlian' => $tampilkeahlian,
                // 'carilevel' => $carilevel,
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
            'skah_kode' => 'required',
            'skah_ket' => 'required',
            'skah_tunjangan' => 'required',


        ]);

         if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        $vTable = DB::connection('esdm')->table('sdm_keahlian');
        $data = $request->all();
        $data = $request->except('_token');

        //NILAI CUSTOM NULL
        // $data['slv_lembur'] = 0;


        $vTable->insert($data);

        return response()->json([
            'success' => 'Data berhasil disimpan dengan Kode '.$request->skah_kode.'!'
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
        //     $kode = Lib::__getKey(14);
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
