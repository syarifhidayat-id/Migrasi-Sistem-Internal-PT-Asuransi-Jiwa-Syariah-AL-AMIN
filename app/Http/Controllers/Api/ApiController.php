<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Legal\Draft_pks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function polis(Request $request) {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_rekanan')
            ->select('mrkn_kode', 'mrkn_nama')
            ->where('mrkn_nama','like',"%$search%")
            ->orderBy('mrkn_kode')
            ->get();
        } else {
            $data = DB::table('emst.mst_rekanan')
            ->select('mrkn_kode', 'mrkn_nama')
            ->orderBy('mrkn_kode')
            ->get();
        }
        return response()->json($data);
    }



    public function draftPks(Request $request) {
        // $data = DB::table('emst.mst_draft_pks')->get();

        // return response()->json(['data' => $data]);

        // return DataTables::of(Draft_pks::query())->toJson();

        // if ($request->ajax()) {
            // $data = Menu::all();
            $data = DB::connection('emst')->table('mst_draft_pks')->select('*', DB::raw("@no:=@no+1 AS DT_RowIndex"));
            // $data = DB::select('select * from web_menu');

            // $data = DB::table('web_menu');
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    // if($request->has('wmn_tipe') && $request->wmn_tipe!=null) {
                    //     return $instance->where('wmn_tipe', $request->wmn_tipe);
                    // }
                    // if (!empty($request->get('wmn_tipe'))) {
                    //     $instance->where('wmn_tipe', $request->get('wmn_tipe'));
                    // }
                    // if (!empty($request->get('wmn_descp'))) {
                    //     $instance->where('wmn_descp', $request->get('wmn_descp'));
                    // }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('mdp_tentang', 'LIKE', "%$search%")
                                ->orWhere('mdp_pk', 'LIKE', "%$search%");
                        });
                    }
                })
                ->make(true);
        // }
    }

}
