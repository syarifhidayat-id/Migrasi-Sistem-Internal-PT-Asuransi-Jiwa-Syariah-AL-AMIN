<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Legal\Unit_Laporan_Berkala;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

    public function polis(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_rekanan')
                ->select('mrkn_kode', 'mrkn_nama')
                ->where('mrkn_nama', 'like', "%$search%")
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


   

    // public function map_nomor(Request $request)
    // {
    //     $data = [];
    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = DB::table('emst.mst_produk_segment')
    //             ->select('mssp_kode', 'mssp_nama')
    //             ->where('mssp_nama', 'like', "%$search%")
    //             ->get();
    //     } else {
    //         $data = DB::table('emst.mst_produk_segment')
    //             ->select('mssp_kode', 'mssp_nama')
    //             ->get();
    //     }
    //     return response()->json($data);
    // }



    public function draftPks(Request $request)
    {

        $data = DB::table('emst.mst_draft_pks')->select(
            '*',
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('DATE_FORMAT(mdp_ins_date, "%d-%m-%Y") as ins_date')
        )
            ->orderBy('mdp_ins_date', 'DESC');

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

    public function uu_asuransi(Request $request)
    {

        $data = DB::table('emst.mst_uu_asuransi')->select(
            '*',
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('DATE_FORMAT(mua_ins_date, "%d-%m-%Y") as ins_date')
        )
            ->orderBy('mua_ins_date', 'DESC');

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

    public function pojk_seojk(Request $request)
    {

        $data = DB::table('emst.mst_pojk')->select(
            '*',
            DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw('DATE_FORMAT(mpojk_ins_date, "%d-%m-%Y") as ins_date'),
            DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis')
        )->orderBy('mpojk_ins_date', 'DESC');

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
                        $w->orWhere('mpojk_tentang', 'LIKE', "%$search%")
                            ->orWhere('mpojk_nomor', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }

    public function peraturan_perusahaan(Request $request)
    {

        $data = DB::table('emst.mst_atur_perusahaan')->select(
            '*',
            // DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw("@no:=@no+1 AS DT_RowIndex")
            // DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
            // DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis')
        )->orderBy('map_ins_date', 'DESC');

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
                        $w->orWhere('map_tentang', 'LIKE', "%$search%")
                            ->orWhere('map_nomor', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }

    public function m_laporan_berkala(Request $request)
    {

        $data = DB::table('emst.mst_laporan_berkala')->select(
            '*',
            // DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw("@no:=@no+1 AS DT_RowIndex")
            // DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
            // DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis')
        )->orderBy('mlapbkl_update', 'DESC');

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
                        $w->orWhere('mlapbkl_jenis', 'LIKE', "%$search%")
                            ->orWhere('mlapbkl_pk', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }

    public function laporan_berkala(Request $request)
    {

        $data = DB::table('emst.mst_laporan_berkala_files')->select(
            '*',
            // DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw("@no:=@no+1 AS DT_RowIndex")
            // DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
            // DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis')
        )->orderBy('mojk_pk', 'desc');

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
                        $w->orWhere('mojk_ket_jenis', 'LIKE', "%$search%")
                            ->orWhere('mojk_pk', 'LIKE', "%$search%");
                    });
                }
            })
            ->make(true);
        // }
    }

    public function ojk(Request $request)
    {

        $data = DB::table('emst.mst_ojk')->select(
            '*',
            // DB::raw("@no:=@no+1 AS DT_RowIndex"),
            DB::raw("@no:=@no+1 AS DT_RowIndex")
            // DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
            // DB::raw('CASE WHEN mpojk_jenis = "2" THEN "POJK" WHEN mpojk_jenis = "1" THEN "SEOJK" END as jenis')
        )->orderBy('mojk_pk', 'desc');

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
                        $w->orWhere('mojk_judul', 'LIKE', "%$search%")
                            ->orWhere('mojk_pk', 'LIKE', "%$search%");
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

        $response = Response::make($file, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }

    public function unit_laporan_berkala(Request $request)
    {

            $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_unit_lap_berkala')
            ->select('id', 'nama')
            ->where('nama', 'like', "%$search%")
            ->get();

        } else {
            $data = DB::table('emst.mst_unit_lap_berkala')
            ->select('id', 'nama')
            ->orderBy('id')
            ->get();
            }

        return response()->json($data);
    }

    public function mssp_kode(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_produk_segment')
                ->select('mssp_kode', 'mssp_nama')
                ->where('mssp_nama', 'like', "%$search%")
                ->get();
        } else {
            $data = DB::table('emst.mst_produk_segment')
                ->select('mssp_kode', 'mssp_nama')
                ->get();
        }
        return response()->json($data);
    }
    


    public function getPojkPdf($id)
    {
        $data = DB::table('emst.mst_pojk')
            ->where('mpojk_pk', $id)->first();

        $path = Storage::get('public/legal/pojk/' . $data->mpojk_dokumen);

        $file = File::get($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }


    public function get_uu($id)
    {
        $data = DB::table('emst.mst_uu_asuransi')
            ->where('mua_pk', '=', $id)
            ->get();

        return response()->json($data);
    }

    public function get_mojk_jenis(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('emst.mst_laporan_berkala')
                ->select('mlapbkl_jenis', 'mlapbkl_pk')
                ->where('mlapbkl_jenis', 'like', "%$search%")
                // ->where('mlapbkl_pk', 'like', "%$search%")
                ->get();
        } else {
            $data = DB::table('emst.mst_laporan_berkala')
                ->select('mlapbkl_jenis', 'mlapbkl_pk')
                ->get();
        }
        return response()->json($data);
    }

    public function getJnsDoc($kode)
    {
        $data =  DB::table('emst.mst_laporan_berkala')
        ->select('mlapbkl_jenis', 'mlapbkl_pk')
        ->where('mlapbkl_pk', $kode)
        ->first();

        return response()->json($data);
    }
}
