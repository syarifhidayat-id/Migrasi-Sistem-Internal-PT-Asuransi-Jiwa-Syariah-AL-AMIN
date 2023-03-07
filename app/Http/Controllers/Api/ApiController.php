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

    public function kantor_cabang(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_lokasi')
            ->select('mlok_kode', 'mlok_nama');

        if (!empty($request->q)) {
            $vtable->where('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
            ->groupBy('mlok_nama')
            ->orderBy('mlok_kode')
            ->offset($offset)
            ->limit($rows)
            ->get();

        return response()->json($data);
    }
    public function lod_karyawan(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $cmd = "SELECT `skar_pk` kode, `skar_nama` nama, `skar_nip` nik FROM `esdm`.`sdm_karyawan_new`
        WHERE `skar_mlok_kode`='" . $request['mlok'] . "';";

        $res = __dbAll($cmd);
        return __json($res);
    }
    public function lod_ang_realisasi(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $cmd = "SELECT `mar_kode` kode, `mar_nama` nama FROM `emst`.`mst_anggaran_realisasi`;";

        $res = __dbAll($cmd);
        return __json($res);
    }

    public function lod_akunkascab(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $cmd = "SELECT `asakn_kode` akun,`asakn_keterangan` nama FROM eacc.`ams_sub_akun`
        WHERE `asakn_mlok_kode`='" . $request['mlok'] . "' AND `asakn_mrpt_kode`='NEROPR' AND `asakn_aakn_kode`='540' AND RIGHT(asakn_kode,1)='1';";

        $res = __dbAll($cmd);
        return __json($res);
    }

}
