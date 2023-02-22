<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        // $data = $request->all();
        // return $data;

        $kode = __getKey(14);
        $data = $request->all();
        $data = request()->except(['_token']);

        $data['tkav_pk'] = $kode;

        $insert = DB::table('epms.trs_kas_vcr')->insert($data);

        if ($insert) {
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
            ]);
        } else {
            return response()->json([
                'error' => 'Data gagal disimpan !'
            ]);
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


    public function get_vcr_kode() {
        $kode = __getnx(4);
        $tahun = date('ym');
        // $bulan = date('m');
        // $noUrut =  rand(1000, 5999);
        $kode_vcr = $tahun .$kode;

        return 'VCR.'.$kode_vcr;

    }

    public function get_tkad_akun($id) {
        $data = DB::table('epms.trs_kas_dtl')->select('tkad_askn_kode')
        ->where('tkad_atjh_pk', $id)
        ->first();

        return response()->json($data);
    }
}
