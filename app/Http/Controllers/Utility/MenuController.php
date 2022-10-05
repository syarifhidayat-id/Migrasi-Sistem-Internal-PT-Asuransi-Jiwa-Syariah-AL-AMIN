<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use App\Models\Utility\Menu;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_menu = DB::table('web_menu_tipe')
        ->select('wmt_kode','wmt_nama')
        ->get();
        // $menu_main = DB::table('web_menu')
        // ->select('wmn_kode', 'wmn_descp', 'wmn_tipe')
        // ->leftJoin('web_menu_tipe', 'wmn_tipe', '=', 'wmt_kode')
        // ->where('wmn_tipe', '=', 'wmt_kode')
        // ->get();
        $listmenu = DB::table('web_menu')
        ->select('*')
        ->get();

        return view('pages.utility.membuat-menu.index', [
            'type_menu' => $type_menu,
            'list_menu' => $listmenu,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_menu = DB::table('web_menu_tipe')
        ->select('wmt_kode','wmt_nama')
        ->get();

        return view('pages.utility.membuat-menu.modal.create', [
            'type_menu' => $type_menu,
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
        $validasi = Validator::make($request->all(), [
            'wmn_tipe' => 'required',
            'wmn_key' => 'required',
            // 'wmn_icon' => 'required',
            'wmn_descp' => 'required',
            // 'wmn_url' => 'required',
            'wmn_url_o' => 'required',
            'wmn_urut' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        if ($request->wmn_kode == "") {
            $kode = KodeController::__getPK(Menu::all()->max('wmn_kode'), 15);

            if ($request->wmn_url == "") {
                $request->merge([
                    'wmn_url' => 'maintenance',
                ]);
            }

            $request->merge([
                'wmn_kode' => $kode,
                'wmn_slide' => 0,
                'wmn_timer' => 0,
                'wmn_open_w' => 0,
                'wmn_url_o_aktif' => 0,
                'wmn_bot' => 0,
            ]);

            Menu::create($request->all());

            // Menu::updateOrCreate(
            // [
            //     'wmn_kode' => $request->wmn_kode,
            // ],
            // [
            //     'wmn_kode' => $kode,
            //     'wmn_tipe' => $request->wmn_tipe,
            //     'wmn_key' => $request->wmn_key,
            //     'wmn_descp' => $request->wmn_descp,
            //     'wmn_icon' => $request->wmn_icon,
            //     'wmn_url' => $request->wmn_url,
            //     'mrkn_alamat1' => $request->mrkn_alamat1,
            //     'wmn_info' => $request->wmn_info,
            //     'wmn_url_o' => $request->wmn_url_o,
            //     'wmn_urut' => $request->wmn_urut,
            //     'wmn_mrkn_kode' => $request->wmn_mrkn_kode,
            //     'wmn_mpol_kode' => $request->wmn_mpol_kode,
            //     'wmn_slide' => 0,
            //     'wmn_timer' => 0,
            //     'wmn_open_w' => 0,
            //     'wmn_url_o_aktif' => 0,
            //     'wmn_bot' => 0,
            // ]);

            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode '.$kode.'!'
            ]);

        } else {
            $menu = Menu::findOrFail($request->wmn_kode);
            $menu->update($request->all());

            return response()->json([
                'success' => 'Data berhasil diupdate dengan Kode '.$request->wmn_kode.'!'
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
        // $menu = Menu::where('wmn_kode', $id)->first();
        $menu = Menu::findOrFail($id);
        // $menu = Menu::findOrFail($id);
        return response()->json($menu);
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
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json([
            'success' => 'Data berhasil dihapus dengan Kode '.$menu->wmn_kode.'!'
        ]);
    }

    public function keyMenu($id)
    {
        $keyMenu = Menu::where('wmn_kode', $id)->first();
        return response()->json($keyMenu);
    }

    public function getTipemenu($id)
    {
        $menuTipe = Menu::where('wmn_tipe', $id)
        // ->where(function($row) {
        //     $row->where('wmn_key', 'MAIN');
        //     // ->orwhere('wmn_key', 'wmn_kode');
        // })
        // ->where('wmn_key', '=', $request->wmn_kode)
        ->get();
        return response()->json($menuTipe);
    }

    public function loadmenu()
    {
        $menulist = Menu::select(
            'wmn_kode', 'wmn_key', 'wmn_descp', 'wmn_icon', 'wmn_url', 'wmn_url_o', 'wmn_tipe', 'email', 'menu_tipe', 'wmj_wmn_kode', 'wmj_sjab_kode', 'wmj_aktif', 'wmn_urut'
            // '*'
            // 'user.*',
            // 'jab.*'
        )
        ->leftJoin('user_accounts', 'wmn_tipe', '=', 'menu_tipe')
        ->leftJoin('web_menu_jabatan', 'wmn_kode', '=', 'wmj_wmn_kode')
        ->where([
            ['wmn_key', '=', 'MAIN'],
            ['wmn_tipe', '=', Auth::user()->menu_tipe],
            ['email', '=', Auth::user()->email],
            ['wmj_sjab_kode', '=', Auth::user()->jabatan],
            ['wmj_aktif', 1],
        ])
        ->orderBy('wmn_urut', 'ASC')
        // ->paginate();
        ->get();

        // return $menulist;

        return response()->json($menulist);
    }

    public static function menuDashboard()
    {
        $menulist = Menu::select(
            'wmn_kode', 'wmn_key', 'wmn_descp', 'wmn_icon', 'wmn_url', 'wmn_url_o', 'wmn_tipe', 'email', 'menu_tipe', 'wmj_wmn_kode', 'wmj_sjab_kode', 'wmj_aktif', 'wmn_urut'
            // '*'
            // 'user.*',
            // 'jab.*'
        )
        ->leftJoin('user_accounts', 'wmn_tipe', '=', 'menu_tipe')
        ->leftJoin('web_menu_jabatan', 'wmn_kode', '=', 'wmj_wmn_kode')
        ->where([
            ['wmn_key', '=', 'MAIN'],
            ['wmn_tipe', '=', Auth::user()->menu_tipe],
            ['email', '=', Auth::user()->email],
            ['wmj_sjab_kode', '=', Auth::user()->jabatan],
            ['wmj_aktif', 1],
        ])
        ->orderBy('wmn_urut', 'ASC')
        // ->paginate();
        ->get();

        return $menulist;

        // return view('layouts.main-admin', [
        //     'menulist' => $menulist
        // ]);
        // return response()->json([
        //     'menulist' => $menulist
        // ]);
    }
}
