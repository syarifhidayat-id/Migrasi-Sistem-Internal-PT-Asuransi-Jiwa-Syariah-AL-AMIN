<?php

namespace App\Http\Controllers\Sdm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\wwLib\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Sdm\Direktorat;

class EntryDirektoratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $carirekanan = Rekanan::select('mrkn_nama')
        // ->where('mrkn_kantor_pusat', '=', 1)
        // ->where('mrkn_status', '!=', 1)
        // ->orderBy('mrkn_kode', 'ASC')
        // ->get();

        // $cariojk = Ojk::select('mpojk_nama')
        // ->get();

        // $carilini = Lini::select('mlu_nama')
        // ->get();

        // $carigolongan = Golongan::select('mgol_nama')
        // ->get();


            return view('pages.sdm.master-direktorat.index');
            // return view('pages.tehnik.polis.entry-master-polis.index', [
            //     'carirekanan' => $carirekanan,
            //     'cariojk' => $cariojk,
            //     'carilini' => $carilini,
            //     'carigolongan' => $carigolongan,
            // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil()
    {
        $caridir = Direktorat::select('sdir_kode', 'sdir_ket', 'sdir_kode_surat')
        ->get();

        $cariket = Direktorat::select('sdir_ket')
        ->get();


            return view('pages.sdm.master-direktorat.lihat-direktorat.index', [

                'caridir' => $caridir,
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
            'sdir_kode' => 'required',
            'sdir_ket' => 'required',
            'sdir_kode_surat' => 'required',
        ]);

         if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        $vTable = DB::connection('esdm')->table('sdm_direktorat');
        $data = $request->all();
        $data = $request->except('_token');

        //NILAI CUSTOM NULL
        $data['sdir_chat_ket'] = 0;
        $data['sdir_chat_rekan'] = 0;
        $data['sdir_chat_cabang'] = 0;
        $data['sdir_chat_pusat'] = 0;
        $data['sdir_chat_type'] = 0;

        $vTable->insert($data);

        return response()->json([
            'success' => 'Data berhasil disimpan dengan Kode '.$request->sdir_kode.'!'
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
