<?php

namespace App\Http\Controllers\wwLoad;

use App\Http\Controllers\Controller;
use App\Http\Controllers\wwLib\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Load extends Controller
{
    public function lod_cabalamin(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_lokasi');
        $vField = DB::raw("mlok_kode kode,mlok_nama nama");

        $vtable->select($vField)->where('mlok_kode', '<>', '');

        if (!empty($request->q)) {
            $vtable->where('mlok_kode', 'LIKE', "%$request->q%")->orWhere('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

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
        $rekan = __getGlobalValue('mrkn_kode_induk');
        if (!empty($rekan)) {
            $rekan = __getGlobalValue('mrkn_kode_induk');
        }
        $nasabah = str_replace(",", "','", __getGlobalValue('mjns_kode'));
        $menutipe = __getGlobalValue('menu_tipe');
        if ($menutipe=="REKAN") {
            $tambah .= "and (cb.mrkn_kode='".$rekan."'  or  cb.mrkn_mrkn_kode_induk='".$rekan."')";
            if (trim($rekan)=="") $tambah .= "and 1=0";
        }

        $cmd = DB::select("SELECT
        $vfield
        FROM $vtable
        WHERE $vkey<>'' $tambah
        LIMIT $offset,$rows");

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_soc(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable="";

        if (isset($request['q'])) {
            $e_value = $request['q'];
        }

        $vidxkey="msoc_kode";
        $vfldname="msoc_mrkn_nama";

        $vfield = "msoc_mjns_kode,
        msoc_mssp_kode,
        msoc_mpras_kode,
        msoc_mjm_kode,
        msoc_mft_kode,
        msoc_mekanisme,
        msoc_jns_perusahaan,
        msoc_mekanisme2,
        msoc_kode,
        msoc_mrkn_nama,
        mjm.`mjm_nama` msoc_mjm_nama,
        msoc_mujh_persen,
        msoc_mmfe_persen,
        msoc_overreding,
        msoc_mfee_persen,
        msoc_mkom_persen,
        msoc_mdr_kode,
        mjns_Keterangan,
        mssp_nama,
        mpras_nama,
        mjns_wp_pens,
        mjns_phk_pens,
        mjm_jiwa,
        mjm_gu,
        if(mjm_kode='05',0,mjm_phk) mjm_phk,
        mjm_tlo,
        mjm_fire,

        if(mjm_kode='05',0,mjm_wp) mjm_wp,
        IF(mjns_kode!='11' OR mjns_kode!='14',0,mjm_wp_pensiun) mjm_wp_pensiun,
        IF(mjns_kode='11' OR mjns_kode='14',0,mjm_wp_pns) mjm_wp_pns,
        IF(mjns_kode='11' OR mjns_kode='14',0,mjm_wp_swasta) mjm_wp_swasta,

        IF(mjns_kode!='11' OR mjns_kode!='14',0,mjm_phk_pensiun) mjm_phk_pensiun,
        IF(mjns_kode='11' OR mjns_kode='14',0,mjm_phk_pns) mjm_phk_pns,
        IF(mjns_kode='11' OR mjns_kode='14',0,mjm_phk_swasta) mjm_phk_swasta,
        mpras_uptambah,
        mpras_ujrah_referal,
        mpras_disc_rate,
        mjns_jl,
        mjns_jl_pst,
        mjns_jl_pas,
        mjns_mpid_nomor,
        mft_nama,
        mkm_nama,

        mpras_nama,
        mkm_ket2,
        mker_nama,msoc_ins_date,msoc_ins_user,
        mjm_nama,
        if(msoc_jenis_bayar=2,'PER BULAN',if(msoc_jenis_bayar=1,'PER TAHUN','SEKALIGUS')) bayar";

        $tambah="and msoc_mrkn_kode='".$request['pmgpolis']."' AND msoc_approve='1' AND msoc_endos!='3'";

        $vtable = "eopr.mst_soc
        LEFT JOIN emst.`mst_jenis_nasabah` mjns ON mjns.`mjns_kode`=msoc_mjns_kode
        LEFT JOIN emst.`mst_produk_segment` mssp ON mssp.`mssp_kode`=msoc_mssp_kode
        LEFT JOIN emst.`mst_program_asuransi` mpras ON mpras.`mpras_kode`=msoc_mpras_kode
        LEFT JOIN emst.`mst_jaminan` mjm ON mjm.`mjm_kode`=msoc_mjm_kode
        LEFT JOIN emst.`mst_manfaat_plafond`  ON `mft_kode`=msoc_mft_kode
        LEFT JOIN emst.`mst_mekanisme`  ON `mkm_kode`=msoc_mekanisme
        LEFT JOIN emst.`mst_pekerjaan`  ON `mker_kode`=msoc_jns_perusahaan
        LEFT JOIN emst.`mst_mekanisme2` ON `mkm_kode2`=msoc_mekanisme2";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $cmd = __select("
        SELECT $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        GROUP BY msoc_kode
        limit 10000");

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_nasabah(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable="";

        if (isset($request['q'])) {
            $e_value = $request['q'];
        }

        $vidxkey="mjns_kode";
        $vfldname="mjns_keterangan";

        $vfield = "
        mpol_mjns_kode,
        mpid_nama,
        mjns_kode,
        mjns_keterangan,
        mjns_jl,
        mjns_jl_pst,
        mjns_jl_pas,
        mjns_wp_pens,
        mjns_phk_pens,
        mjns_mpid_nomor,
        mjns_pbiaya";

        $vtable = "emst.mst_jenis_nasabah
        LEFT JOIN eopr.mst_polis on mpol_mjns_kode=mjns_kode
        LEFT JOIN emst.mst_produk_induk ON mpid_kode=mjns_mpid_nomor";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        $rekan = __getGlobalValue('mrkn_kode_induk');
        $nasabah = str_replace(",", "','", __getGlobalValue('mjns_kode'));
        if (!empty($nasabah)) {
            $tambah = "and mpol_mjns_kode IN ('".$nasabah."')";
        }

        $cmd = __select("
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>''
        $tambah and mjns_kode!='00'
        GROUP BY mjns_kode
        LIMIT $offset,$rows");

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_mpid(Request $request)
    {
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable="";

        if (isset($request['q'])) {
            $e_value = $request['q'];
        }

        $vidxkey="mpid_kode";
        $vfldname="mpid_nama";

        $vfield = "mpid_kode, mpid_nama";

        $vtable = "emst.mst_produk_induk
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_mpid_nomor=mpid_kode";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $tambah = "and mjns_mpid_nomor='".$request['mjns']."'";

        $cmd = __select("
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        GROUP BY 1
        LIMIT $offset,$rows");

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function get_nopolis(Request $request)
    {
        // $tambah = "";
        // $msoc = $request['msoc'];
        // $cek = substr($msoc, 0, 4);
        // $cek2 = substr($msoc, 0, 5);

        // $resjns = __dbRow(__select("SELECT msoc_mjns_kode mjns FROM eopr.mst_soc WHERE msoc_kode='".$msoc."'"));

        // if ($cek=='EDS.') {
        //     $msoc = substr($msoc, 4, 2);
        // }
        // if ($cek2=='EDS1.' || $cek2=='EDS2.' || $cek2=='EDS3.') {
        //     $msoc = substr($msoc, 5, 2);
        // }
        // if (isset($request['pmgpolis'])) {
        //     if (!empty($request['pmgpolis'])) {
        //         $tambah.=" and mpli_mrkn_kode='".$request['pmgpolis']."'";
        //     }
        // }
        // if (isset($request['nopolis'])) {
        //     if (!empty($request['nopolis'])) {
        //         $tambah.=" and mpli_nomor='".$request['nopolis']."'";
        //     }
        // }
        // if (isset($request['mekanisme'])) {
        //     if (!empty($request['mekanisme'])) {
        //         $tambah.=" and mpol_mekanisme='".$request['mekanisme']."'";
        //     }
        // }
        // if (isset($request['jns_bayar'])) {
        //     if (!empty($request['jns_bayar'])) {
        //         $tambah.=" and mpol_jenis_bayar='".str_replace(".","",$request['jns_bayar'])."'";
        //     }
        // }
        // if (isset($request['mrkn_nama'])) {
        //     if (!empty($request['mrkn_nama']) && empty($request['pmgpolis']) ) {
        //         $tambah.=" and mpli_mrkn_nama='".$request['mrkn_nama']."' ";
        //     }
        // }

        // $cmd = __select("
        // SELECT
        // mpli_nomor mpol_nomor,
        // mpli_nomor mpol_nomor_cetak,
        // mpli_mrkn_kode,
        // mpli_mrkn_nama,
        // mpli_mpras_kode
        // FROM eopr.mst_polis_induk
        // LEFT JOIN eopr.mst_polis ON mpol_nomor=mpli_nomor
        // LEFT JOIN emst.mst_rekanan rkn on mrkn_kode=mpli_mrkn_kode
        // WHERE 1=1 AND mpli_mjns_kode='".$resjns['mjns']."' and mpli_status_endos in (0,1,2)
        // $tambah");

        // $res = __dbRow($cmd);

        // return __json($res);
        $user['jabatan'] = __now();

        return __json($user);
    }
}
