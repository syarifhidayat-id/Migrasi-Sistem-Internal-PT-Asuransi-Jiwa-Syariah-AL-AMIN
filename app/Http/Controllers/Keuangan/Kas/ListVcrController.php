<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ListVcrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.keuangan.kas.list-vcr-kas.index');
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

    public function rpt_kas(Request $request)
    {
        extract($_GET);
        $tambah = "";
        $tgl1 = __str2($e_entry1, 'D');
        $tgl2 = __str2($e_entry2, 'D');
        if ($_GET['c_keu'] == '1') {
                $tambah .= " AND tdna_aprov_ho='" . $e_keu . "' ";
        }
        if ($_GET['c_jur'] == '1') {
                $tambah .= " AND tdna_sts_jurnal='" . $e_jur . "' ";
        }
        // if ($_GET['c_keu'] == '1') {
        //     if (!empty($e_keu)) {
        //         $tambah .= " AND tdna_aprov_ho='" . $e_keu . "' ";
        //     }
        // }
        // if ($_GET['c_jur'] == '1') {
        //     if (!empty($e_jur)) {
        //         $tambah .= " AND tdna_sts_jurnal='" . $e_jur . "' ";
        //     }
        // }
        $tambah.= "AND tdna_mlok_kode='".$mlok_kode."' AND (tdna_tgl_aju BETWEEN '".$tgl1."' AND '".$tgl2."')";

        $vtable = "
        SELECT * FROM epms.trs_dana_aju LEFT JOIN emst.mst_lokasi ON mlok_kode=tdna_mlok_kode WHERE 1=1 ".$tambah." ";

        $cmd = __dbAll($vtable);
        return DataTables::of($cmd)->addIndexColumn()->make(true);
    }
}
