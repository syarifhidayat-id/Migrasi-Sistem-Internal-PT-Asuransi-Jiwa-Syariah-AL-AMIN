<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;



class ApiController extends Controller
{

    public function hari(Request $request) {
        $data = DB::table('eset.hari')->select('*')->get();
        return response()->json($data);
    }
    public function bulan(Request $request) {
        $data = DB::table('eset.bulan')->select('*')->get();
        return response()->json($data);
    }
    public function tahun(Request $request) {
        $data = DB::table('eset.tahun')->select('*')->get();
        return response()->json($data);
    }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */

    // public function polis(Request $request)
    // {
    //     $data = [];
    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = DB::table('emst.mst_rekanan')
    //             ->select('mrkn_kode', 'mrkn_nama')
    //             ->where('mrkn_nama', 'like', "%$search%")
    //             ->orderBy('mrkn_kode')
    //             ->get();
    //     } else {
    //         $data = DB::table('emst.mst_rekanan')
    //             ->select('mrkn_kode', 'mrkn_nama')
    //             ->orderBy('mrkn_kode')
    //             ->get();
    //     }
    //     return response()->json($data);
    // }







    // public function peraturan_perusahaan(Request $request)
    // {
    //     $data = DB::table('emst.mst_atur_perusahaan')->select(
    //         '*',
    //         // DB::raw("@no:=@no+1 AS DT_RowIndex"),
    //         DB::raw("@no:=@no+1 AS DT_RowIndex"),
    //         DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
    //         DB::raw(
    //             'CASE
    //             WHEN map_jenis = "0" THEN "Peraturan Perusahaan"
    //             WHEN map_jenis = "1" THEN "SOP"
    //             WHEN map_jenis = "2" THEN "SK"
    //             WHEN map_jenis = "3" THEN "Pedoman"
    //             WHEN map_jenis = "4" THEN "Job Desc"
    //             END as jenis_map'),
    //         DB::raw(
    //             'CASE
    //             WHEN map_bulan = "1" THEN "Januari"
    //             WHEN map_bulan = "2" THEN "Februari"
    //             WHEN map_bulan = "3" THEN "Maret"
    //             WHEN map_bulan = "4" THEN "April"
    //             WHEN map_bulan = "5" THEN "Mei"
    //             WHEN map_bulan = "6" THEN "Juni"
    //             WHEN map_bulan = "7" THEN "Juli"
    //             WHEN map_bulan = "8" THEN "Agustus"
    //             WHEN map_bulan = "9" THEN "September"
    //             WHEN map_bulan = "10" THEN "Oktober"
    //             WHEN map_bulan = "11" THEN "November"
    //             WHEN map_bulan = "12" THEN "Desember"
    //             END as bulan_map')

    //     )->orderBy('map_ins_date', 'DESC');

    //     return Datatables::of($data)
    //         ->addIndexColumn()
    //         ->filter(function ($instance) use ($request) {
    //             // if($request->has('wmn_tipe') && $request->wmn_tipe!=null) {
    //             //     return $instance->where('wmn_tipe', $request->wmn_tipe);
    //             // }
    //             // if (!empty($request->get('wmn_tipe'))) {
    //             //     $instance->where('wmn_tipe', $request->get('wmn_tipe'));
    //             // }
    //             // if (!empty($request->get('wmn_descp'))) {
    //             //     $instance->where('wmn_descp', $request->get('wmn_descp'));
    //             // }
    //             if (!empty($request->get('search'))) {
    //                 $instance->where(function ($w) use ($request) {
    //                     $search = $request->get('search');
    //                     $w->orWhere('map_tentang', 'LIKE', "%$search%")
    //                         ->orWhere('map_nomor', 'LIKE', "%$search%");
    //                 });
    //             }
    //         })
    //         ->make(true);
    //     // }
    // }







    // public function viewPdf($id)
    // {
    //     $data = DB::table('emst.mst_uu_asuransi')
    //         ->where('mua_pk', $id)->first();
    //     $path = Storage::get('public/legal/uu_asuransi/' . $data->mua_dokumen);
    //     $file = File::get($path);
    //     $response = Response::make($file, 200);
    //     $response->header('Content-Type', 'application/pdf');
    //     return $response;
    // }



    // public function mssp_kode(Request $request)
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

    // public function getPojkPdf($id)
    // {
    //     $data = DB::table('emst.mst_pojk')
    //         ->where('mpojk_pk', $id)->first();
    //     $path = Storage::get('public/legal/pojk/' . $data->mpojk_dokumen);
    //     $file = File::get($path);
    //     $response = Response::make($file, 200);
    //     $response->header('Content-Type', 'application/pdf');
    //     return $response;
    // }

    // public function get_uu($id)
    // {
    //     $data = DB::table('emst.mst_uu_asuransi')
    //         ->where('mua_pk', '=', $id)
    //         ->get();
    //     return response()->json($data);
    // }

    // public function get_mojk_jenis(Request $request)
    // {
    //     $data = [];
    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = DB::table('emst.mst_laporan_berkala')
    //             ->select('mlapbkl_jenis', 'mlapbkl_pk')
    //             ->where('mlapbkl_jenis', 'like', "%$search%")
    //             // ->where('mlapbkl_pk', 'like', "%$search%")
    //             ->get();
    //     } else {
    //         $data = DB::table('emst.mst_laporan_berkala')
    //             ->select('mlapbkl_jenis', 'mlapbkl_pk')
    //             ->get();
    //     }
    //     return response()->json($data);
    // }
}
