<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WewenangJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type_menu = DB::table('web_menu_tipe')
        ->select('wmt_kode','wmt_nama')
        ->get();

        $menu = DB::table('web_menu_jabatan')
        ->select(
            // '*',
            'wmj_pk', 'wmj_wmn_kode', 'wmn_descp', 'wmn_tipe', 'wmj_aktif'
        )
        ->leftJoin('web_menu', 'wmj_wmn_kode', '=', 'wmn_kode')
        ->where([
            // ['wmn_key', 'MAIN'],
            ['wmj_wmn_kode', DB::raw("wmn_kode")],
            ['wmn_tipe', 'ADMAGENSAN'],
        ])
        ->groupBy('wmj_pk')
        ->orderBy('wmn_descp')
        ->get();

        // return $menu;
        return view('pages.utility.wewenang-jabatan.index', [
            'type_menu' => $type_menu,
            'list_menu' => $menu,
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
}
