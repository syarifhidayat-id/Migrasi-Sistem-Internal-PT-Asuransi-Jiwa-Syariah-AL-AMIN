<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Config;
use App\Models\Utility\Menu;
use App\Models\Utility\WewenangJabatan;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.utility.membuat-menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_menu = DB::table('web_menu_tipe')
            ->select('wmt_kode', 'wmt_nama')
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
        } else {

            if (empty($request->wmn_kode)) {
                $kode = Config::__getKey(14);
                $vtable = DB::table('web_menu');

                if (empty($request->wmn_url)) {
                    $request->merge([
                        'wmn_url_n' => 'maintenance',
                    ]);
                }
                $data = $request->all();
                $data = $request->except('_token');
                $data['wmn_kode'] = $kode;
                $data['wmn_slide'] = 0;
                $data['wmn_timer'] = 0;
                $data['wmn_open_w'] = 0;
                $data['wmn_url_o_aktif_n'] = 0;
                $data['wmn_bot'] = 0;

                $vtable->insert($data);

                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode '.$kode.'!'
                ]);

            } else {
                $vtable = DB::table('web_menu')->where('wmn_kode', $request->wmn_kode);
                $data = $request->all();
                $data = $request->except('_token');
                $vtable->update($data);

                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode '.$request->wmn_kode.'!'
                ]);
            }
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
        //$data = DB::table('')->where('', $id)->first();
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
            'success' => 'Data berhasil dihapus dengan Kode ' . $menu->wmn_kode . '!'
        ]);
    }

    public function selectTipeMenu(Request $request)
    {
        $vtable = DB::table('web_menu_tipe')->select('wmt_kode','wmt_nama');
        if (!empty($request->q)) {
            $vtable->where('wmt_nama', 'LIKE', "%$request->q%");
        }
        $data = $vtable->get();
        return response()->json($data);
    }

    public function tipeMenu($id)
    {
        $tipe = DB::table('web_menu_tipe')->where('wmt_kode', $id)->first();
        return response()->json($tipe);
    }

    public function keyMenu($id)
    {
        $keyMenu = Menu::where('wmn_kode', $id)->first();
        return response()->json($keyMenu);
    }

    public function selectMenu(Request $request)
    {
        $vtable = DB::table('web_menu')->select(DB::raw("wmn_kode, wmn_descp"));
        if (!empty($request->q)) {
            $vtable->where('wmn_descp', 'LIKE', "%$request->q%");
        }
        if (!empty($request->tipe)) {
            $vtable->where('wmn_tipe', $request->tipe);
        }
        $data = $vtable->get();

        return response()->json($data);
    }

    public function loadmenu()
    {
        $menulist = Menu::select(
            'wmn_kode',
            'wmn_key',
            'wmn_descp',
            'wmn_icon',
            'wmn_url',
            'wmn_url_o',
            'wmn_tipe',
            'email',
            'menu_tipe',
            'wmj_wmn_kode',
            'wmj_sjab_kode',
            'wmj_aktif',
            'wmn_urut'
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
            $data = DB::table('web_menu')->select(DB::raw("wmn_kode, wmn_icon, wmn_descp, wmn_tipe, wmn_url_n, wmn_url_o_n"))->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->filter (function ($instance) use ($request) {
                if ($request->get('check_1') == "1") {
                    if (!empty($request->get('wmn_tipe'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['wmn_tipe'], $request->get('wmn_tipe')) ? true : false;
                        });
                    }
                }
                if ($request->get('check_2') == "1") {
                    if (!empty($request->get('wmn_descp'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['wmn_descp'], $request->get('wmn_descp')) ? true : false;
                        });
                    }
                }
                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['wmn_tipe']), Str::lower($request->get('search')))){
                            return true;
                        }else if (Str::contains(Str::lower($row['wmn_descp']), Str::lower($request->get('search')))) {
                            return true;
                        }

                        return false;
                    });
                }
            })
            ->make(true);
        }
    }
}
