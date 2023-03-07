<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ListTransaksiKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.kas.list-trs-kas.index');
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
        //
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

    public function rpt_kasbb()
    {
        extract($_GET);

        $tambah = "";

        $tgl1 = __str2($e_entry1,'D'); 
        $tgl2 = __str2($e_entry2,'D');

    $tambah.=" AND tdna_mlok_kode='". $mlok_kode ."'  AND tdna_askn_kode='".$tdna_askn_kode."' AND (tdna_tgl_aju BETWEEN '".$tgl1."' AND '".$tgl2."')";

    $vtable = "
    SELECT * FROM epms.trs_dana_aju WHERE 1=1 ".$tambah." ";

    $cmd = __dbAll($vtable);
    return DataTables::of($cmd)->addIndexColumn()->make(true);
    }
}
