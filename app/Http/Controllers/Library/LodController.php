<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LodController extends Controller
{
    public function lod_pmg_polis(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;

        $tambah="";
        $vtable="";

        if (isset($request['q'])) {
            $e_value = $request['q'];
        }

        $tambah ="and cb.mrkn_kantor_pusat=1 and cb.mrkn_nama!=''";
        $vtable = "emst.mst_rekanan cb left join emst.mst_rekanan ps on ps.mrkn_kode=cb.mrkn_mrkn_kode_induk";
        $vkey = "cb.mrkn_kode";
        $vname = "cb.mrkn_nama";
        $vfield = "cb.mrkn_kode kode, if(cb.mrkn_nama=ps.mrkn_nama OR ps.mrkn_nama IS NULL,cb.mrkn_nama,concat(ps.mrkn_nama,' ',cb.mrkn_nama)) nama";


        if (!empty($e_value)) {
            $tambah .= $tambah . "and (cb.mrkn_kode like '%$e_value%' or cb.mrkn_nama like '%$e_value%')";
        }
        $rekan = Lib::__getGlobalValue('mrkn_kode_induk');
        if (!empty($rekan)) {
            $rekan = Lib::__getGlobalValue('mrkn_kode_induk');
        }
        $nasabah = str_replace(",", "','", Lib::__getGlobalValue('mjns_kode'));
        $menutipe = Lib::__getGlobalValue('menu_tipe');
        if ($menutipe=="REKAN") {
            $tambah .= "and (cb.mrkn_kode='".$rekan."'  or  cb.mrkn_mrkn_kode_induk='".$rekan."')";
            if (trim($rekan)=="") $tambah .= "and 1=0";
        }

        $cmd = DB::select("SELECT
        $vfield
        FROM $vtable
        WHERE $vkey<>'' $tambah
        LIMIT $offset,$rows");

        $res = Lib::__dbAll($cmd);

        return Lib::json($res);
    }
}
