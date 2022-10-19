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
