<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;
use App\Models\Legal\Pks;


class PksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('eopr.mst_pks AS pks')
        ->join('emst.mst_rekanan AS rekanan', 'rekanan.mrkn_kode','=','pks.mpks_mrkn_kode')
        ->select('rekanan.mrkn_nama_induk','pks.*',
        DB::raw('DATE_FORMAT(mpks_tgl_mulai, "%d-%m-%Y") as awal_date'),
        DB::raw('DATE_FORMAT(mpks_tgl_akhir, "%d-%m-%Y") as akhir_date'))
        ->get();

        $polis = DB::table('emst.mst_rekanan')
        ->select('mrkn_nama','mrkn_mrkn_kode_induk', 'mrkn_kode')
        ->orderBy('mrkn_mrkn_kode_induk')
        ->get();
        // return View('pages.legal.pks.index', ['data' => $data]);
        return View('pages.legal.pks.index', compact('polis', 'data'));
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
        return $request;
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

     }


    public function viewPks($id)
    {
        $pks = DB::table('eopr.mst_pks AS pks')
        ->join('emst.mst_rekanan AS rekanan', 'rekanan.mrkn_kode', '=', 'pks.mpks_mrkn_kode')
        ->where('pks.mpks_pk', $id)
        ->select('pks.*','rekanan.mrkn_nama_induk',
        DB::raw('DATE_FORMAT(mpks_tgl_mulai, "%d-%m-%Y") as awal_date'),
        DB::raw('DATE_FORMAT(mpks_tgl_akhir, "%d-%m-%Y") as akhir_date'))
        ->first();
        // $pks = Pks::findOrFail($id);
        return response()->json($pks);
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
