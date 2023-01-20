<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
use App\Models\Utility\Menu;
use App\Models\Utility\WewenangJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WewenangJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jns_menu = DB::table('web_menu_tipe')
        ->select('wmt_kode','wmt_nama')
        ->get();

        $form_menu = DB::table('web_menu')
        ->select('wmn_kode', 'wmn_descp')
        ->where('wmn_url_o_aktif_n', 0)
        ->orderBy('wmn_urut', 'ASC')
        ->get();

        $form_jab = DB::connection('esdm')
        ->table('sdm_jabatan')
        ->select('sjab_kode', 'sjab_ket')
        ->get();

        $list = DB::table('web_menu_jabatan')
        ->select(
            // '*',
            // DB::raw("wmj_pk, wmj_wmn_kode, wmn_kode, wmn_descp, wmn_tipe, wmj_aktif")
            'wmj_pk', 'wmj_wmn_kode', 'wmj_sjab_kode', 'wmn_descp', 'wmn_tipe', 'wmj_aktif'
        )
        ->leftJoin('web_menu', 'wmj_wmn_kode', '=', 'wmn_kode')
        // ->leftJoin('esdm.sdm_jabatan', 'wmj_sjab_kode', '=', 'sjab_kode')
        ->where([
            ['wmj_wmn_kode', DB::raw("web_menu.wmn_kode")],
            ['wmn_tipe', 'ALAMIN'],
            ['wmj_sjab_kode', 'KBGIT'],
        ])
        // ->groupBy('wmj_sjab_kode')
        ->orderBy('wmn_descp')
        ->get();

        // return $list;
        return view('pages.utility.wewenang-jabatan.index', [
            'jns_menu' => $jns_menu,
            'list' => $list,
            'form_menu' => $form_menu,
            'form_jab' => $form_jab,
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
        $validasi = Validator::make($request->all(), [
            'wmj_wmn_kode' => 'required',
            'wmj_sjab_kode' => 'required',
            'wmj_aktif' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        if ($request->wmj_pk == "") {

            $request->merge([
                'wmj_group' => 'A',
            ]);

            WewenangJabatan::create($request->all());
            if ($request->wmj_wmn_kode) {
                Menu::findOrFail($request->wmj_wmn_kode)
                ->update([
                    'wmn_url_o_aktif_n' => $request->wmj_aktif
                ]);
            }

            // return $request->wmj_pk;
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode '.$request->wmj_wmn_kode.'!'
            ]);

        } else {
            $menu = WewenangJabatan::findOrFail($request->wmj_pk);
            $menu->update($request->all());

            return response()->json([
                'success' => 'Data berhasil diupdate dengan Kode '.$request->wmj_pk.'!'
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

    public function wmj_wmn_kode()
    {
        $list_menu = DB::table('web_menu')
        ->select('wmn_kode', 'wmn_descp')
        ->leftJoin('web_menu_jabatan', 'wmn_kode', '=', 'wmj_wmn_kode')
        ->where([
            // ['wmj_wmn_kode', DB::raw("wmn_kode")]
            ['wmj_wmn_kode', ""]
        ])
        ->groupBy('wmn_kode')
        ->orderBy('wmn_urut', 'ASC')
        ->get();

        // return $list_menu;
        return response()->json($list_menu);
    }
}
