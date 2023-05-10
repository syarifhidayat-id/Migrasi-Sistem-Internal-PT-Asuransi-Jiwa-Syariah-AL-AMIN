<?php

namespace App\Http\Controllers\wwLoad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Lod extends Controller
{
    public function lod_menutipe()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "wmt_kode";
        $vfldname = "wmt_nama";

        $vfield = "
        wmt_kode kode,
        wmt_nama nama";

        $vtable = "wob_conf.web_menu_tipe";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_mainmenu()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "wmn_tipe";
        $vfldname = "wmn_descp";

        $vfield = "
        wmn_tipe kode,
        wmn_descp nama";

        $vtable = "web_conf.web_menu";

        if (!empty($e_value)) {
            $tambah .= $tambah . " and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if (!empty($tipe)) {
            $tambah .= $tambah . " and wmn_tipe='" . $tipe . "'";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_cabalamin()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mlok_kode";
        $vfldname = "mlok_nama";

        $vfield = "
        mlok_kode kode,
        mlok_nama nama";

        $vtable = "emst.mst_lokasi";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_Cabang_polis()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 500;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        $menu_tipe = __getGlbVal('menu_tipe');
        $cabx = __getGlbVal('lokasi');
        $tcab = strval(str_replace(",", "','", $cabx));
        $user = __getUser();

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mrkn_kode";
        $vfldname = "mrkn_nama";
        $vfldnamelain = "mrkn_nama_lain";

        $vfield = "
        mrkn_kode kode,
        CONCAT(mrkn_nama_lain,IF(mrkn_mrkn_kode_induk=mrkn_kode,' PUSAT','')) nama,
        mrkn_mrkn_kode_induk  kodeinduk,
        ifnull(mrkn_mlok_kode,'') tpprd_mlok_kode,
        ifnull(mrkn_mprov_kode,'') tpprd_mprov_kode,
        ifnull(mlok_nama,'') e_cabalamin,
        ifnull(mprov_nama,'') e_provinsi,
        mrkn_norekening norek";

        $vtable = "emst.mst_rekanan
        LEFT JOIN emst.mst_lokasi ON mrkn_mlok_kode=mlok_acc
        LEFT JOIN emst.mst_provinsi ON mrkn_mprov_kode=mprov_kode";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%' or $vfldnamelain like '%$e_value%')";
        }

        if ($menu_tipe == "CABANG") {
            if ($user == 'erin_dki') {
                $tambah = $tambah . "and mrkn_mlok_kode='" . $cab . "' ";
            } else {
                $tambah = $tambah . "and mrkn_mlok_kode IN ('" . $tcab . "') ";
            }
        }

        if ($menu_tipe == "ADMKORWIL" || $menu_tipe == "KORWIL") {
            $tambah =  $tambah . "and mlok_mreg_kode in (SELECT mlok_mreg_kode FROM emst.mst_lokasi WHERE mlok_kode='" . $cab . "' ) and mlok_tipe=1";
        }

        $tambah .= $tambah . "and (mrkn_mrkn_kode_induk ='" . $pmgpolis . "' " . $tambah . " )";

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        ORDER BY mrkn_nama ASC
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_perusahaan()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mpt_kode";
        $vfldname = "mpt_nama";
        // $vfldnamelain="mrkn_nama_lain";

        $vfield = "mpt_kode kode, mpt_nama nama";

        $vtable = "emst.mst_perusahaan";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        // if (isset($_GET['mjns'])) {
        //     if ($_GET['mjns']!="") {
        //         $tambah.=" and mpt_kode='".$_GET['mjns']."'";
        //     }
        // }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        AND mpt_aktif='1'
        ORDER BY mpt_nama ASC
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_perusahaansoc()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mpt_kode";
        $vfldname = "mpt_nama";
        // $vfldnamelain="mrkn_nama_lain";

        $vfield = "mpt_kode kode, mpt_nama nama";

        $vtable = "emst.mst_perusahaan";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if (isset($_GET['mjns'])) {
            if ($_GET['mjns'] != "") {
                $tambah .= " and mpt_kode='" . $_GET['mjns'] . "'";
            }
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        ORDER BY mpt_nama ASC
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_jnskerja()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mker_kode";
        $vfldname = "mker_nama";
        // $vfldnamelain="mrkn_nama_lain";
        $vfield = "mker_kode kode, mker_nama nama";
        $vtable = "emst.mst_pekerjaan";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        ORDER BY 1
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_ocab()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mlok_kode";
        $vfldname = "mlok_nama";
        // $vfldnamelain="mrkn_nama_lain";

        $vfield = "mlok_kode kode, mlok_nama nama, 0  ck";

        $vtable = "emst.mst_lokasi";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_pmg_polis()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 1000;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $tambah = "and cb.mrkn_kantor_pusat=1 and cb.mrkn_nama!=''";

        $vkey = "cb.mrkn_kode";
        $vname = "cb.mrkn_nama";

        $vfield = "cb.mrkn_kode kode, if(cb.mrkn_nama=ps.mrkn_nama OR ps.mrkn_nama IS NULL,cb.mrkn_nama,concat(ps.mrkn_nama,' ',cb.mrkn_nama)) nama";
        $vtable = "emst.mst_rekanan cb left join emst.mst_rekanan ps on ps.mrkn_kode=cb.mrkn_mrkn_kode_induk";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vkey like '%$e_value%' or $vname like '%$e_value%')";
        }
        $rekan = __getGlbVal('mrkn_kode_induk');
        if (!empty($rekan)) {
            $rekan = __getGlbVal('mrkn_kode_induk');
        }
        $nasabah = str_replace(",", "','", __getGlbVal('mjns_kode'));
        $menutipe = __getGlbVal('menu_tipe');
        if ($menutipe == "REKAN") {
            $tambah .= "and (cb.mrkn_kode='" . $rekan . "'  or  cb.mrkn_mrkn_kode_induk='" . $rekan . "')";
            if (trim($rekan) == "") $tambah .= "and 1=0";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vkey<>'' $tambah
        LIMIT $offset,$rows";
        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_oldpolis()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $tambah = "and mpol_mrkn_kode='" . $pmgpolis . "' and mpol_approve='1' and mpol_endos!=3";

        $vkey = "mpol_kode";
        $vname = "mpol_mrkn_nama";

        $vfield = "mpol_kode,
        mpol_msoc_kode,
        mpol_mrkn_nama,
        mjm.mjm_nama mpol_mjm_nama,
        mpol_mujh_persen,
        mpol_mmfe_persen,
        mpol_overreding,
        mpol_mfee_persen,
        mpol_mkom_persen,
        mpol_mdr_kode,
        mjns_Keterangan,
        mssp_nama,
        mpras_nama,
        mjns_wp_pens,
        mjns_phk_pens,
        mjm_jiwa,
        mjm_gu,
        mjm_phk,
        mjm_tlo,
        mjm_fire,
        mjm_wp,
        mjm_wp_pensiun,
        mjm_wp_pns,
        mjm_wp_swasta,
        mjm_phk_pensiun,
        mjm_phk_pns,
        mjm_phk_swasta,
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
        mker_nama,mpol_ins_date,mpol_ins_user,
        mjm_nama,
        if(mpol_jenis_bayar=2,'PER BULAN',if(mpol_jenis_bayar=1,'PER TAHUN','SEKALIGUS')) bayar";

        $vtable = "eopr.mst_polis
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=mpol_mjns_kode
        LEFT JOIN emst.mst_produk_segment mssp ON mssp.mssp_kode=mpol_mssp_kode
        LEFT JOIN emst.mst_program_asuransi mpras ON mpras.mpras_kode=mpol_mpras_kode
        LEFT JOIN emst.mst_jaminan mjm ON mjm.mjm_kode=mpol_mjm_kode
        LEFT JOIN emst.mst_manfaat_plafond  ON mft_kode=mpol_mft_kode
        LEFT JOIN emst.mst_mekanisme ON mkm_kode=mpol_mekanisme
        LEFT JOIN emst.mst_pekerjaan ON mker_kode=mpol_jns_perusahaan
        LEFT JOIN emst.mst_mekanisme2 ON mkm_kode2=mpol_mekanisme2";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vkey like '%$e_value%' or $vname like '%$e_value%')";
        }
        if (isset($mjm)) {
            $tambah .= "and mpol_mjm_kode='$mjm'";
        }
        if (isset($mpras)) {
            $tambah .= "and mpol_mpras_kode='$mpras'";
        }
        if (isset($mft)) {
            $tambah .= "and mpol_mft_kode='$mft'";
        }
        if (isset($mker)) {
            $tambah .= "and mpol_jns_perusahaan='$mker'";
        }
        if (isset($mkm)) {
            $tambah .= "and mpol_mekanisme='$mkm'";
        }
        if (isset($mkm2)) {
            $tambah .= "and mpol_mekanisme2='$mkm2'";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vkey<>'' $tambah
        GROUP BY 1
        LIMIT $offset,$rows";
        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_soc()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10000;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "msoc_kode";
        $vfldname = "mjns_Keterangan";

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
        mjm.mjm_nama msoc_mjm_nama,
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

        $vtable = "eopr.mst_soc
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=msoc_mjns_kode
        LEFT JOIN emst.mst_produk_segment mssp ON mssp.mssp_kode=msoc_mssp_kode
        LEFT JOIN emst.mst_program_asuransi mpras ON mpras.mpras_kode=msoc_mpras_kode
        LEFT JOIN emst.mst_jaminan mjm ON mjm.mjm_kode=msoc_mjm_kode
        LEFT JOIN emst.mst_manfaat_plafond  ON mft_kode=msoc_mft_kode
        LEFT JOIN emst.mst_mekanisme  ON mkm_kode=msoc_mekanisme
        LEFT JOIN emst.mst_pekerjaan  ON mker_kode=msoc_jns_perusahaan
        LEFT JOIN emst.mst_mekanisme2 ON mkm_kode2=msoc_mekanisme2";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        $tambah = "and msoc_mrkn_kode='" . $_GET['pmgpolis'] . "' and msoc_approve='1' and msoc_endos!='3'";

        $cmd = "
        SELECT $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        GROUP BY msoc_kode
        LIMIT $offset,$rows";
        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_nasabah()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mjns_kode";
        $vfldname = "mjns_keterangan";

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
        $rekan = __getGlbVal('mrkn_kode_induk');
        $nasabah = str_replace(",", "','", __getGlbVal('mjns_kode'));
        if (!empty($nasabah)) {
            $tambah = "and mpol_mjns_kode IN ('" . $nasabah . "')";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>''
        $tambah and mjns_kode!='00'
        GROUP BY mjns_kode
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_mpid()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mpid_kode";
        $vfldname = "mpid_nama";

        $vfield = "mpid_kode, mpid_nama";

        $vtable = "emst.mst_produk_induk
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_mpid_nomor=mpid_kode";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        if (!empty($mjns)) {
            $tambah = "and mjns_mpid_nomor='" . $mjns . "'";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        GROUP BY 1
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_spaj()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        if ($id == "spaj") {
            $tambah = "";
            $vtable = "";

            if (isset($_GET['q'])) {
                $e_value = $_GET['q'];
            }

            $vidxkey = "mspaj_nomor";
            $vfldname = "mspaj_keterangan";

            $vfield = "mspaj_nomor, mspaj_keterangan";

            $vtable = "eopr.mst_spaj_polis";

            if (!empty($e_value)) {
                $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
            }

            $cmd = "
            SELECT
            $vfield
            FROM $vtable
            WHERE $vidxkey<>'' $tambah
            LIMIT $offset,$rows";

            $res = __dbAll($cmd);

            return __json($res);
        }
    }

    public function lod_segmen()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        if ($id == "segmen") {
            $tambah = "";
            $vtable = "";

            if (isset($_GET['q'])) {
                $e_value = $_GET['q'];
            }

            $vidxkey = "mssp_kode";
            $vfldname = "mssp_nama";

            $vfield = "
            mssp_kode,
            mssp_nama,
            mssp_tgl_awal,
            mssp_tgl_ahir,
            mssp_komisi,
            mssp_feebase,
            mssp_openpolis";

            $vtable = "emst.mst_produk_segment";

            if (!empty($e_value)) {
                $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
            }

            $cmd = "
            SELECT
            $vfield
            FROM $vtable
            WHERE $vidxkey<>'' $tambah
            LIMIT $offset,$rows";

            $res = __dbAll($cmd);

            return __json($res);
        }
    }

    public function lod_manfaat()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mjm_kode";
        $vfldname = "mjm_nama";

        $vfield = "
        mjm_kode,
        mjm_nama,
        mjm_bundling,
        mjm_jiwa,
        mjm_gu,
        mjm_phk,
        mjm_tlo,
        mjm_fire,
        mjm_wp,
        mjm_umut,
        mpid_kode,
        mpid.mpid_nama mpid_nama";

        $vtable = "emst.mst_jaminan
        LEFT JOIN emst.mst_protree_3 mptr3 ON mptr3.mptr_kode=mjm_kode
        LEFT JOIN emst.mst_produk_induk mpid ON mpid.mpid_kode=mptr_mpid_kode";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if (isset($mjns)) {
            if (!empty($mjns)) {
                $tambah .= "and mptr_induk_nasabah='" . $mjns . "'";
            }
        }
        if (isset($mssp)) {
            if (!empty($mssp)) {
                $tambah .= "and mptr_induk='" . $mssp . "'";
            }
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        ORDER BY mpid_nama ASC
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_pras()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mpras_kode";
        $vfldname = "mpras_nama";

        $vfield = "
        mpras_kode,
        mpras_nama,
        mpras_uptambah,
        mpras_ujrah_referal,
        mpras_disc_rate,
        mpras_info,
        mpol_mekanisme,
        IFNULL(wpsw.mpwp_persen,0)+IFNULL(wpns.mpwp_persen,0)+IFNULL(mpol_mmft_kode_wp_pensiun ,0) wp,
        IFNULL(phkpns.mpwp_persen,0)+IFNULL(phkswa.mpwp_persen,0)+IFNULL(mpol_mmft_kode_phk_pensiun,0) phk";

        $vtable = "emst.mst_program_asuransi
        LEFT JOIN emst.mst_protree_4 mptr ON mptr.mptr_kode=mpras_kode
        LEFT JOIN eopr.mst_polis on mpol_mpras_kode=mpras_kode
        LEFT JOIN emst.mst_persen_wpphk wpns ON wpns.mpwp_kode=mpol_mmft_kode_wp_pns
        LEFT JOIN emst.mst_persen_wpphk wpsw ON wpsw.mpwp_kode=mpol_mmft_kode_wp_swasta
        LEFT JOIN emst.mst_persen_wpphk phkpns ON phkpns.mpwp_kode=mpol_mmft_kode_phk_pns
        LEFT JOIN emst.mst_persen_wpphk phkswa ON phkswa.mpwp_kode=mpol_mmft_kode_phk_swasta";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if (isset($mjns)) {
            if (!empty($mjns)) {
                $tambah .= " and mptr_induk='" . $mjns . "'";
            }
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_prassoc()
    {
        extract($_GET);
        $tambah = "";
        $vtable = "";

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mpras_kode";
        $vfldname = "mpras_nama";

        $vfield = "
        mpras_kode,
        mpras_nama,
        mpras_uptambah,
        mpras_ujrah_referal,
        mpras_disc_rate,
        mpras_info,
        msoc_mekanisme,
        ifnull(msoc_kode,'') msoc_kode,
        msoc_mekanisme2";

        $vtable = "emst.mst_program_asuransi
        LEFT JOIN emst.mst_protree_4 mptr ON mptr.mptr_kode=mpras_kode
        LEFT JOIN eopr.mst_soc on mpras_kode=msoc_mpras_kode
        and msoc_mpid_kode='" . $mpid . "'
        and msoc_mekanisme='" . $mkm . "'
        and msoc_mekanisme2='" . $mkm2 . "'
        and msoc_mft_kode='" . $mft . "'
        and msoc_mrkn_kode='" . $mrkn . "'
        and msoc_mssp_nama='" . $mssp . "'
        and msoc_mjm_kode='" . $mjm . "'
        and msoc_mjns_kode='" . $mjns . "'
        and msoc_jenis_bayar='" . $byr . "'
        and msoc_jns_perusahaan='" . $perush . "'
        and msoc_endos IN (0,1,2)";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        GROUP BY mpras_kode
        LIMIT $offset,$rows";
        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_cabalamin_komisi()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mlok_kode";
        $vfldname = "mlok_nama";

        $vfield = "
        mlok_kode kode,
        mlok_nama nama,
        ifnull(skar_pk,'') kd_pinca,
        ifnull(skar_nama,'') nm_pinca,
        mlok_sn sn";

        $vtable = "emst.mst_lokasi
        LEFT JOIN esdm.sdm_karyawan_new ON skar_mlok_kode=mlok_kode
        and skar_sjab_kode in ('KACAB','PINCA','PJSKACAB','PLTKACAB','WAKACAB')";

        $tambah .= $tambah . "and mlok_nama!=''";
        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if (isset($mjns)) {
            if (!empty($mjns)) {
                $tambah .= " and mptr_induk='" . $mjns . "'";
            }
        }

        $cmd = "
        (SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        GROUP BY mlok_kode)
        UNION
        (SELECT
        mlok_kode kode,
        mlok_nama nama,
        '' kd_pinca,
        '' nm_pinca,
        mlok_sn sn
        FROM emst.mst_lokasi
        WHERE mlok_tipe=0 $tambah
        GROUP BY mlok_kode)";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_marketing()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "skar_pk";
        $vfldname = "skar_nama";

        $vfield = "
        skar_pk kode,
        skar_nama nama,
        '0' skar_komisi,
        '0' skar_overreding";

        $vtable = "esdm.sdm_karyawan_new
        LEFT JOIN esdm.sdm_jabatan ON sjab_kode=skar_sjab_kode";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if (!empty($mlok)) {
            // $tambah.="and skar_mlok_kode!='01'";
            $tambah .= "and skar_mlok_kode='" . $mlok . "'";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' and skar_status_kary in (0,1,4) $tambah
        AND skar_mlok_kode!='01'
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_tarif()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mth_nomor";
        $vfldname = "mth_ket";

        $vfield = "
        mth_nomor kode,
        mth_ket nama";

        $vtable = "emst.mst_tarif";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        GROUP BY 1
        LIMIT $offset,$rows";
        $res = __dbAll($cmd);
        return __json($res);
    }

    public function lod_tarif_polis()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mth_nomor";
        $vfldname = "mth_ket";

        $vfield = "
        mth_nomor kode,
        trf.mth_ket nama";

        $vtable = "eopr.mst_soc
        LEFT JOIN emst.mst_tarif trf ON trf.mth_nomor=msoc_mth_nomor";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if ($jnspro != 4) {
            $tambah = "and mth_ket!='' and msoc_kode='" . $msoc . "' and msoc_mrkn_kode='" . $pmgpolis . "' ";
        } else {
            $tambah = "and mth_ket!=''";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_uw()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mpuw_nomor";
        $vfldname = "mpuw_nama";

        $vfield = "
        mpuw_nomor kode,
        mpuw_nama nama";

        $vtable = "emst.mst_polis_uwtable";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        GROUP BY 1
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);
        return __json($res);
    }

    public function lod_uw_polis()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mpuw_nomor";
        $vfldname = "mpuw_nama";

        $vfield = "
        mpuw_nomor kode,
        mpuw.mpuw_nama nama";

        $vtable = "eopr.mst_soc
        LEFT JOIN emst.mst_polis_uwtable mpuw ON mpuw.mpuw_nomor=msoc_mpuw_nomor";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if ($jnspro != 4) {
            $tambah = " and mpuw_nama!='' and msoc_kode='" . $msoc . "' and msoc_mrkn_kode='" . $pmgpolis . "' ";
        } else {
            $tambah = "and mpuw_nama!=''";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_provinsi()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        if ($_GET['id'] == 'polis') {
            $vidxkey = "mprov_kode";
            $vfldname = "mprov_nama";

            $vfield = "
            mprov_kode,
            mprov_nama,
            IF(IFNULL(mpwl_mpol_kode,'')='','0','1') ck";

            $vtable = "emst.mst_provinsi LEFT JOIN eopr.mst_polis_provinsi ON mpwl_mpol_kode='" . $polis . "'
            AND mprov_kode=mpwl_mprov_kode";

            if (!empty($e_value)) {
                $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
            }

            $cmd = "
            SELECT
            $vfield
            FROM $vtable
            WHERE $vidxkey<>'' $tambah
            LIMIT $offset,$rows";

            $res = __dbAll($cmd);
        }

        return __json($res);
    }

    public function lod_paymod()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey = "mpm_kode";
        $vfldname = "mpm_nama";

        $vfield = "
        mpm_kode kode,
        mpm_nama nama,
        mpm_tipe,
        mpm_no_pks,
        mpm_norek,
        mpm_noref,
        mpm_api_get,
        mpm_api_post,
        mpm_mui_file,
        mpm_web_file";

        $vtable = "emst.mst_pay_mode";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        // $rekan=__getGlbVal("mrkn_kode_induk";

        if (!empty($tipe)) {
            $tambah = "and mpm_tipe='" . $tipe . "'";
        }

        $cmd = "
        SELECT
        $vfield
        FROM $vtable
        WHERE $vidxkey<>'' $tambah
        LIMIT $offset,$rows";

        $res = __dbAll($cmd);

        return __json($res);
    }

    public function lod_user_tax()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable = "";

        if (!empty($_GET['q'])) {
            if (isset($_GET['q'])) {
                $e_value = $_GET['q'];
            }

            // if (isset($_GET['e_cab'])) {
            //     $tambah .= "and mrkn_mlok_kode ='" . $_GET['e_cab'] . "'";
            // }

            $vidxkey = "mtx_kode";
            $vfldname = "mtx_nama";

            $vfield = "
            mtx_kode kode,
            mtx_npwp npwp,
            mtx_nama nama,
            format(ifnull(msalk_saldo,0),2) mtx_saldo,
            case mtx_status
                when '0' then 'Karyawan'
                when '1' then 'Non Karyawan'
            end ket,
            mtx_status sts";

            $vtable = "
            emst.mst_tax
            LEFT JOIN emst.mst_saldo_komisi ON mtx_kode=msalk_mtx_kode
            AND msalk_tahun=YEAR(CURDATE())
            #AND IF(mtx_status=1,msalk_mtx_kode!='',msalk_tahun=IF(MONTH(CURDATE())='01',YEAR(CURDATE())-1,YEAR(CURDATE())))";

            if (!empty($e_value)) {
                $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
            }

            $cmd = "
            SELECT
            $vfield
            FROM $vtable
            WHERE $vidxkey<>'' $tambah
            LIMIT $offset,$rows";

            $res = __dbAll($cmd);

            return __json($res);
        }
    }

    public function coba()
    {
        // $cmd = "
        // SELECT *
        // FROM web_conf.web_menu
        // LEFT JOIN web_conf.user_accounts ON wmn_tipe=menu_tipe
        // LEFT JOIN web_conf.web_menu_jabatan ON wmn_kode=wmj_wmn_kode AND jabatan=wmj_sjab_kode
        // WHERE 1=1
        // AND wmn_key='MAIN'
        // AND wmn_tipe='".__getGlbVal('menu_tipe')."'
        // AND email='".__getGlbVal('email')."'
        // AND wmj_sjab_kode='".__getJab()."'
        // AND wmj_aktif=1
        // ORDER BY wmn_urut ASC";
        // $menulist = __dbAll($cmd);

        // return __json($menulist);

        // $cmd = "SELECT eset.f_get_pkw(20) pk";
        // $r = __dbRow($cmd);
        // $ret = $r['pk'];
        // return $ret;
        $cmd = "
        SELECT *
        FROM web_conf.web_menu
        LEFT JOIN web_conf.user_accounts ON wmn_tipe=menu_tipe
        LEFT JOIN web_conf.web_menu_jabatan ON wmn_kode=wmj_wmn_kode AND jabatan=wmj_sjab_kode
        WHERE wmn_tipe='ALL' OR menu_tipe='" . __getGlbVal('menu_tipe') . "'
        AND wmn_key='MAIN'
        AND email='" . __getGlbVal('email') . "'
        AND wmj_sjab_kode='" . __getJab() . "'
        AND wmj_aktif=1
        GROUP BY wmn_kode
        ORDER BY wmn_urut ASC";
        $menulist = __dbAll($cmd);
        return __json($menulist);
    }
}
