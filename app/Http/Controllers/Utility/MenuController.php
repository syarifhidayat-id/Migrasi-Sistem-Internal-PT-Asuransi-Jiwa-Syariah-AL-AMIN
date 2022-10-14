<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use App\Models\Utility\Menu;
use App\Models\Utility\WewenangJabatan;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

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
        $nama_menu = DB::table('web_menu')
        ->select('wmn_descp')
        ->get();

        return view('pages.utility.membuat-menu.index', [
            'type_menu' => $type_menu,
            'nama_menu' => $nama_menu,
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
            // 'wmn_url_n' => 'required',
            'wmn_url_o_n' => 'required',
            'wmn_urut' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }

        if ($request->wmn_kode == "") {
            $kode = KodeController::__getKey(14);

            if ($request->wmn_url == "") {
                $request->merge([
                    'wmn_url_n' => 'maintenance',
                ]);
            }

            $request->merge([
                'wmn_kode' => $kode,
                'wmn_slide' => 0,
                'wmn_timer' => 0,
                'wmn_open_w' => 0,
                'wmn_url_o_aktif_n' => 0,
                'wmn_bot' => 0,
            ]);

            Menu::create($request->all());

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
        WewenangJabatan::where('wmj_wmn_kode', $id)->delete();

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

    public function datamenu(Request $request)
    {
        if ($request->ajax()) {
            $data = Menu::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
