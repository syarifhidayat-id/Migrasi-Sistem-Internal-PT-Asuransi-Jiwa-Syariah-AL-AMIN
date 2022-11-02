<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;



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


    public function mssp_kode(Request $request){
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_produk_segment')
            ->select('mssp_kode', 'mssp_nama')
            ->where('mssp_nama','like',"%$search%")
            ->get();
        } else {
            $data = DB::table('emst.mst_produk_segment')
            ->select('mssp_kode', 'mssp_nama')
            ->get();
        }
        return response()->json($data);
    }



    public function draftPks(Request $request) {
        
            $data = DB::table('emst.mst_draft_pks')->select('*', DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('DATE_FORMAT(mdp_ins_date, "%d-%m-%Y") as ins_date'))
            ->orderBy('mdp_ins_date', 'DESC')
            ;
           
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

    public function uu_asuransi(Request $request) {
        
        $data = DB::table('emst.mst_uu_asuransi')->select('*', DB::raw("@no:=@no+1 AS DT_RowIndex"),
        DB::raw('DATE_FORMAT(mua_ins_date, "%d-%m-%Y") as ins_date'))
        ->orderBy('mua_ins_date', 'DESC')
        ;
       
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
                        $w->orWhere('mua_tentang', 'LIKE', "%$search%")
                            ->orWhere('mua_nomor', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
    // }
}


public function viewPdf($id)
    {
        $data = DB::table('emst.mst_uu_asuransi')
        ->where('mua_pk', $id)->first();

        $path = Storage::get('public/legal/uu_asuransi/' . $data->mua_dokumen);

        $file = File::get($path);

        $response = Response::make($file,200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }


public function get_uu($id){
    $data = DB::table('emst.mst_uu_asuransi')
    ->where('mua_pk', '=', $id)
    ->get();

    return response()->json($data);
}

}
