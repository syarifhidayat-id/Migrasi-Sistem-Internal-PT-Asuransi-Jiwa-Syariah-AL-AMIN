<?php

namespace App\Http\Controllers\wwLoad;

use App\Http\Controllers\Controller;
use App\Http\Controllers\wwLib\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Whoops\Exception\ErrorException;

class Load extends Controller
{
    public function lod_cabalamin()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mlok_kode";
        $vfldname="mlok_nama";

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

    public function get_nosoc()
    {
        extract($_GET);
        $tambah = "";

        if (isset($_GET['pmgpolis'])) {
            if ($_GET['pmgpolis']!="") {
                $tambah = $tambah.=" and msli_mrkn_kode='".$_GET['pmgpolis']."'";
            }
        }

        if (isset($_GET['nopolis'])) {
            if ($_GET['nopolis']!="") {
                $tambah = $tambah.=" and msli_nomor='".$_GET['nopolis']."'";
            }
        }

        if (isset($_GET['nasabah'])) {
            if ($_GET['nasabah']!="") {
                $tambah = $tambah.=" and msli_mjns_kode='".$_GET['nasabah']."'";
            }
        }

        if (isset($_GET['mft'])) {
            if ($_GET['mft']!="") {
                $tambah = $tambah.=" and msoc_mft_kode='".$_GET['mft']."'";
            }
        }

        if (isset($_GET['mekanisme'])) {
            if ($_GET['mekanisme']!="") {
                $tambah = $tambah.=" and msoc_mekanisme='".$_GET['mekanisme']."'";
            }
        }

        if (isset($_GET['mekanisme2'])) {
            if ($_GET['mekanisme2']!="") {
                $tambah = $tambah.=" and msoc_mekanisme2='".$_GET['mekanisme2']."'";
            }
        }

        if (isset($_GET['perus'])) {
            if ($_GET['perus']!="") {
                $tambah = $tambah.=" and msoc_jns_perusahaan='".$_GET['perus']."'";
            }
        }

        if (isset($_GET['jns_bayar'])) {
            if ($_GET['jns_bayar']!="") {
                $tambah = $tambah.=" and msoc_jenis_bayar='".$_GET['jns_bayar']."'";
            }
        }

        if (isset($_GET['mrkn_nama'])) {
            if ($_GET['mrkn_nama']!="" && $_GET['pmgpolis']=="") {
                $tambah = $tambah.=" and msli_mrkn_nama='".$_GET['mrkn_nama']."'";
            }
        }

        $cmd = "
        SELECT
        msli_nomor msotd_msoc_nomor,
        msli_nomor msoc_nomor,
        msli_mrkn_kode,
        msli_mrkn_nama,
        msli_mpras_kode
        FROM eopr.mst_soc_induk
        LEFT JOIN eopr.mst_soc msoc ON msoc.msoc_nomor=msli_nomor
        LEFT JOIN emst.mst_rekanan rkn ON mrkn_kode=msli_mrkn_kode
        WHERE 1=1 and msli_status_endos in (0,1,2) ".$tambah."";
        $res = __dbRow($cmd);

        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd = "
            SELECT '' msoc_nomor,
            '' msli_kode";
            $res = __dbRow($cmd);
            return __json($res);
        }
    }

    public function get_kodesoc()
    {
        extract($_GET);
        $tambah = "";

        if ($_GET['id']=="msoc_kode") {
            if (isset($_GET['pmgpolis'])) {
                if ($_GET['pmgpolis']!="") {
                    $tambah.=" and msoc_mrkn_kode='".$_GET['pmgpolis']."'";
                }
            }

            if (isset($_GET['nopolis'])) {
                if ($_GET['nopolis']!="") {
                    $tambah.=" and msoc_nomor='".$_GET['nopolis']."'";
                }
            }

            if (isset($_GET['jns_bayar'])) {
                if ($_GET['jns_bayar']!="") {
                    $tambah.=" and msoc_jenis_bayar='".$_GET['jns_bayar']."'";
                }
            }

            if (isset($_GET['mekanisme'])) {
                if ($_GET['mekanisme']!="") {
                    $tambah.=" and msoc_mekanisme='".$_GET['mekanisme']."'";
                }
            }

            if (isset($_GET['jns_perusahaan'])) {
                if ($_GET['jns_perusahaan']!="") {
                    $tambah.=" and msoc_jns_perusahaan='".$_GET['jns_perusahaan']."'";
                }
            }

            if (isset($_GET['nasabah'])) {
                if ($_GET['nasabah']!="") {
                    $tambah.=" and msoc_mjns_kode='".$_GET['nasabah']."'";
                }
            }

            if (isset($_GET['mft'])) {
                if ($_GET['mft']!="") {
                    $tambah.=" and msoc_mft_kode='".$_GET['mft']."'";
                }
            }

            if (isset($_GET['mjm'])) {
                if ($_GET['mjm']!="") {
                    $tambah.=" and msoc_mjm_kode='".$_GET['mjm']."'";
                }
            }

            if (isset($_GET['mrkn_nama'])) {
                if ($_GET['mrkn_nama']!="" && $_GET['pmgpolis']=="") {
                    $tambah.=" and msoc_mrkn_nama='".$_GET['mrkn_nama']."'";
                }
            }

            if (isset($_GET['pras'])) {
                if ($_GET['pras']!="") {
                    $tambah.=" and msoc_mpras_kode='".$_GET['pras']."'";
                }
            }

            if (isset($_GET['mekanisme2'])) {
                if ($_GET['mekanisme2']!="") {
                    $tambah.=" and msoc_mekanisme2='".$_GET['mekanisme2']."'";
                }
            }

            $tambah=" and msoc_kode='".$_GET['kode']."'" ;
            $cmd = "
            SELECT
            msoc_nomor,
            msoc_referal,
            msoc_maintenance,
            msoc_pajakfee,
            msoc_handlingfee,
            msoc_handlingfee2,
            msoc_kode,
            msoc_mslr_kode,
            msoc_file_polis,
            msoc_mspaj_nomor,
            msoc_mrkn_kode,
            msoc_mpid_kode,
            msoc_mpojk_kode,
            msoc_mjm_kode,
            msoc_mft_kode,
            msoc_jenis_tarif,
            msoc_mujh_persen,
            msoc_mmfe_persen,
            msoc_mfee_persen,
            msoc_mkom_persen,
            msoc_mkomdisc_persen,
            msoc_overreding,
            msoc_endors,
            msoc_mkar_kode_pim,
            msoc_mkar_kode_mkr,
            msoc_mlok_kode,
            msoc_mth_nomor,
            msoc_mssp_nama msoc_mssp_kode,
            msoc_mjns_kode,
            msoc_ket_endors,
            msoc_mpuw_nomor,
            msoc_mujhrf_kode,
            msoc_mdr_kode,
            msoc_mpras_kode,
            msoc_status,
            IF('".$_GET['endos']."'='2','0',msoc_approve) msoc_approve,
            msoc_no_endors,
            IF(IFNULL(msoc_mrkn_nama,'')='',mrkn_nama,msoc_mrkn_nama)  msoc_mrkn_nama,
            mlok_nama e_cabalamin,
            pnc.skar_nama e_pinca,
            mkr.skar_nama e_marketing,
            trf.mth_ket e_tarif,
            uw.mpuw_nama e_uw,
            msoc_mssp_nama,
            spaj.mspaj_mrkn_nama msoc_mspaj_nama,
            jmn.mjm_kode e_manfaat
            FROM eopr.mst_soc
            LEFT JOIN emst.mst_polis_uwtable uw ON uw.mpuw_nomor=msoc_mpuw_nomor
            LEFT JOIN emst.mst_jaminan jmn ON jmn.mjm_kode=msoc_mjm_kode
            left JOIN emst.mst_rekanan rkn ON rkn.mrkn_kode=msoc_mrkn_kode
            LEFT JOIN emst.mst_lokasi lok  ON lok.mlok_kode=msoc_mlok_kode
            LEFT JOIN esdm.sdm_karyawan_new pnc ON pnc.skar_pk=msoc_mkar_kode_pim
            LEFT JOIN esdm.sdm_karyawan_new mkr ON mkr.skar_pk=msoc_mkar_kode_mkr
            LEFT JOIN emst.mst_tarif trf ON trf.mth_nomor=msoc_mth_nomor
            LEFT JOIN eopr.mst_spaj_polis spaj ON spaj.mspaj_nomor=msoc_mspaj_nomor
            WHERE 1=1 AND msoc_endos IN (0,1,2) ".$tambah."";
            $res = __dbRow($cmd);

            if (!empty($res)) {
                return __json($res);
            } else {
                $cmd = "
                SELECT
                ''  msoc_kode,
                '0' msoc_approve,
                ''  msoc_mslr_kode,
                '0' msoc_handlingfee,
                ''  msoc_file_polis,
                ''  msoc_mspaj_nomor,
                ''  msoc_mujh_persen,
                ''  msoc_mmfe_persen,
                ''  msoc_mfee_persen,
                ''  msoc_mkom_persen,
                ''  msoc_overreding,
                ''  msoc_endos,
                ''  msoc_mkar_kode_pim,
                ''  msoc_mkar_kode_mkr,
                ''  msoc_mlok_kode,
                ''  msoc_mth_nomor,
                ''  msoc_ket_endors,
                ''  msoc_mpuw_nomor,
                ''  msoc_mujhrf_kode,
                ''  msoc_mdr_kode,
                ''  e_cabalamin,
                ''  e_pinca,
                ''  e_marketing,
                ''  e_uw,
                ''  e_tarif,
                ''  msoc_mspaj_nama
                FROM eopr.mst_polis
                WHERE 1=1";
                $res = __dbRow($cmd);
                return __json($res);
            }
        }
    }

    public function lod_pmg_polis()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 1000;
        $offset = ($page - 1) * $rows;

        $tambah="";
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $tambah ="and cb.mrkn_kantor_pusat=1 and cb.mrkn_nama!=''";

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
        if ($menutipe=="REKAN") {
            $tambah .= "and (cb.mrkn_kode='".$rekan."'  or  cb.mrkn_mrkn_kode_induk='".$rekan."')";
            if (trim($rekan)=="") $tambah .= "and 1=0";
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

    public function lod_soc()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10000;
        $offset = ($page - 1) * $rows;

        $tambah="";
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="msoc_kode";
        $vfldname="mjns_Keterangan";

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
        $tambah="and msoc_mrkn_kode='".$_GET['pmgpolis']."' and msoc_approve='1' and msoc_endos!='3'";

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
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
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
        $rekan = __getGlbVal('mrkn_kode_induk');
        $nasabah = str_replace(",", "','", __getGlbVal('mjns_kode'));
        if (!empty($nasabah)) {
            $tambah = "and mpol_mjns_kode IN ('".$nasabah."')";
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
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mpid_kode";
        $vfldname="mpid_nama";

        $vfield = "mpid_kode, mpid_nama";

        $vtable = "emst.mst_produk_induk
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_mpid_nomor=mpid_kode";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        if (!empty($mjns)) {
            $tambah = "and mjns_mpid_nomor='".$mjns."'";
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

    public function get_nopolis()
    {
        extract($_GET);
        $tambah = "";
        $_GET['msoc']=$msoc;
        $cek = substr($_GET['msoc'],0,4);
        $cek2 = substr($_GET['msoc'],0,5);

        $resmsoc = "SELECT msoc_mjns_kode mjns FROM eopr.mst_soc WHERE msoc_kode='".$_GET['msoc']."'";
        $resjns = __dbRow($resmsoc);
        // return __json($resjns);

        if ($cek=='EDS.') {
            $msoc = substr($_GET['msoc'], 4, 2);
        }
        if ($cek2=='EDS1.' || $cek2=='EDS2.' || $cek2=='EDS3.') {
            $msoc = substr($_GET['msoc'], 5, 2);
        }
        if (isset($pmgpolis)) {
            if (!empty($pmgpolis)) {
                $tambah.="and mpli_mrkn_kode='".$pmgpolis."'";
            }
        }
        if (isset($nopolis)) {
            if (!empty($nopolis)) {
                $tambah.="and mpli_nomor='".$nopolis."'";
            }
        }
        if (isset($mekanisme)) {
            if (!empty($mekanisme)) {
                $tambah.="and mpol_mekanisme='".$mekanisme."'";
            }
        }
        if (isset($jns_bayar)) {
            if (!empty($jns_bayar)) {
                $tambah.="and mpol_jenis_bayar='".str_replace(".","",$jns_bayar)."'";
            }
        }
        if (isset($mrkn_nama)) {
            if (!empty($mrkn_nama) && empty($pmgpolis) ) {
                $tambah.="and mpli_mrkn_nama='".$mrkn_nama."' ";
            }
        }

        $cmd = "
        SELECT
        mpli_nomor mpol_nomor,
        mpli_nomor mpol_nomor_cetak,
        mpli_mrkn_kode,
        mpli_mrkn_nama,
        mpli_mpras_kode
        FROM eopr.mst_polis_induk
        LEFT JOIN eopr.mst_polis ON mpol_nomor=mpli_nomor
        LEFT JOIN emst.mst_rekanan rkn ON mrkn_kode=mpli_mrkn_kode
        WHERE 1=1 and mpli_mjns_kode='".$resjns['mjns']."' and mpli_status_endos in (0,1,2) ".$tambah." ";
        $res = __dbRow($cmd);

        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd=" select '' mpol_nomor, '' mpli_kode " ;
	        $res=__dbRow($cmd);
            return __json($res);
        }
    }

    public function get_ket_soc()
    {
        extract($_GET);
        $tambah = "";
        $judul = $_GET['msoc'];
        if (isset($_GET['pmgpolis'])) {
            if ($_GET['pmgpolis']!="") {
                $tambah.=" and msli_mrkn_kode='".$_GET['pmgpolis']."'";
            }
        }
        if ((trim($judul))=="3") {
            if ($_GET['msoc']!="") {
                $tambah.=" and msoc_kode='".str_replace("EDS.", "",$_GET['msoc'])."'";
            }
        } else {
            $tambah.=" and msoc_kode='".str_replace(".C.2", "",$_GET['msoc'])."'";
        }
        if (isset($_GET['nopolis'])) {
            if ($_GET['nopolis']!="") {
                $tambah.=" and msli_nomor='".$_GET['nopolis']."'";
            }
        }
        if (isset($_GET['nasabah'])) {
            if ($_GET['nasabah']!="") {
                $tambah.=" and msli_mjns_kode='".$_GET['nasabah']."'";
            }
        }
        if (isset($_GET['mrkn_nama'])) {
            if ($_GET['mrkn_nama']!="" && $_GET['pmgpolis']=="") {
                $tambah.=" and msli_mrkn_nama='".$_GET['mrkn_nama']."'";
            }
        }

        $cmd = "
        SELECT
        msoc_status mpol_status_polis,
        msoc_mekanisme2 mpol_mekanisme2,
        msli_mrkn_kode,
        msoc_mekanisme mpol_mekanisme,
        msoc_handlingfee mpol_handlingfee,
        msoc_handlingfee2 mpol_pajakfee_persen,
        msoc_jenis_bayar mpol_jenis_bayar,
        msoc_jns_perusahaan mpol_jns_perusahaan,
        msoc_mspaj_nomor mpol_mspaj_nomor,
        msoc_mslr_kode mpol_mslr_kode,
        msoc_mjns_mpid_kode mpol_mjns_mpid_kode,
        msoc_mpid_kode mpol_mpid_kode,
        mpid_nama e_jenisprod,
        msoc_mjm_kode mpol_mjm_kode,
        msoc_mft_kode mpol_mft_kode,
        msoc_mkar_kode_pim mpol_mkar_kode_pim,
        pnc.skar_nama e_pinca,
        mkr.skar_nama e_marketing,
        msoc_mkar_kode_mkr mpol_mkar_kode_mkr,
        msoc_mlok_kode mpol_mlok_kode,
        mlok_nama e_cabalamin,
        mssp_kode mpol_mssp_kode,
        mssp.mssp_nama mpol_mssp_nama,
        msoc_mjns_kode mpol_mjns_kode,
        mjns_Keterangan  e_nasabah,
        msoc_mpras_kode mpol_mpras_kode,
        spaj.mspaj_mrkn_nama mpol_mspaj_nama,
        pras.mpras_nama e_pras,
        jmn.mjm_nama e_manfaat,
        msoc_mfee_persen mpol_mfee_persen,
        msoc_mujh_persen mpol_mujh_persen,
        msoc_mkom_persen mpol_mkom_persen,
        msoc_mkomdisc_persen mpol_mkomdisc_persen,
        msoc_mmfe_persen mpol_mmfe_persen,
        msoc_overreding mpol_overreding,
        msoc_referal mpol_referal,
        msoc_maintenance mpol_maintenance,
        msoc_pajakfee mpol_pajakfee,
        msoc_mdr_kode mpol_mdr_kode
        FROM eopr.mst_soc_induk,eopr.mst_soc
        LEFT JOIN emst.mst_jaminan jmn ON jmn.mjm_kode=msoc_mjm_kode
        left join emst.mst_rekanan rkn ON rkn.mrkn_kode=msoc_mrkn_kode
        LEFT JOIN emst.mst_lokasi lok ON lok.mlok_kode=msoc_mlok_kode
        LEFT JOIN esdm.sdm_karyawan_new pnc ON pnc.skar_pk=msoc_mkar_kode_pim
        LEFT JOIN esdm.sdm_karyawan_new mkr ON mkr.skar_pk=msoc_mkar_kode_mkr
        LEFT JOIN emst.mst_tarif trf ON trf.mth_nomor=msoc_mth_nomor
        LEFT JOIN eopr.mst_spaj_polis spaj ON spaj.mspaj_nomor=msoc_mspaj_nomor
        LEFT JOIN emst.mst_program_asuransi pras ON pras.mpras_kode=msoc_mpras_kode
        LEFT JOIN emst.mst_jenis_nasabah ON mjns_kode=msoc_mjns_kode
        LEFT JOIN emst.mst_produk_induk ON mpid_kode=msoc_mpid_kode
        left join emst.mst_produk_segment mssp ON mssp.mssp_kode=msoc_mssp_nama
        WHERE 1=1
        and msoc_nomor=msli_nomor
        $tambah";

        $res = __dbRow($cmd);

        return __json($res);
    }

    public function get_kodepolis()
    {
        extract($_GET);
        if ($_GET['id']=="mpol_kode") {
            $tambah = "";
            $judul=$_GET['judul'];

            $cek=substr($_GET['kdsoc'],0,4);
            $cek2=substr($_GET['kdsoc'],0,5);
            $len="select LENGTH('".$_GET['kdsoc']."') len";

            $rlen=__dbrow($len);

            $msoc=substr($_GET['kdsoc'],0,25);

            if ($judul=='3') {
                if ($cek=='EDS.') {
                    $msoc=substr($_GET['kdsoc'],4,21);
                }
                if ($cek2=='EDS1.' || $cek2=='EDS2.' || $cek2=='EDS3.') {
                    if($rlen['len']!='23') {
                        $msoc=substr($_GET['kdsoc'],5,21) ;
                    } else {
                        $msoc=substr($_GET['kdsoc'],5,21) ;
                    }
                }
                if ($cek2=='EDS1.' || $cek2=='EDS2.' || $cek2=='EDS3.') {
                    $msoc2=str_replace('EDS1.',"EDS.", $_GET['kdsoc']);
                }

                if ($cek2=='EDS2.') {
                    $msoc2=str_replace('EDS2.',"EDS1.", $_GET['kdsoc']);
                }
                if ($cek2=='EDS3.') {
                    $msoc2=str_replace('EDS3.',"EDS2.", $_GET['kdsoc']);
                }
            }
            $msoc2=$msoc;
            $socxx="";
            $socx="";
            if($cek2=='EDS1.') {
                $socxx=str_replace('EDS1','EDS', $_GET['kdsoc']);
                $socx=str_replace('EDS1.','', $_GET['kdsoc']);
            } else if($cek2=='EDS2.') {
                $socx=str_replace('EDS2','EDS1', $_GET['kdsoc']);
            } else if($cek2=='EDS3.') {
                $socx=str_replace('EDS3','EDS2', $_GET['kdsoc']);
            } else if($cek2=='EDS4.') {
                $socx=str_replace('EDS4','EDS3', $_GET['kdsoc']);
            } else if($cek2=='EDS5.') {
                $socx=str_replace('EDS5','EDS4', $_GET['kdsoc']);
            } else if($cek2=='EDS6.') {
                $socx=str_replace('EDS6','EDS5', $_GET['kdsoc']);
            } else if($cek2=='EDS7.') {
                $socx=str_replace('EDS7','EDS6', $_GET['kdsoc']);
            } else if($cek2=='EDS8.') {
                $socx=str_replace('EDS8','EDS7', $_GET['kdsoc']);
            }

            $tambah.=" and (mpol_msoc_kode='".str_replace(".C.2", "",$socx)."' OR mpol_msoc_kode='".str_replace(".C.2", "",$socxx)."')";

            if (isset($_GET['pmgpolis'])) {
                if ($_GET['pmgpolis']!="") {
                    $tambah.=" and mpol_mrkn_kode='".$_GET['pmgpolis']."'";
                }
            }

            if (isset($_GET['mrkn_nama'])) {
                if ($_GET['mrkn_nama']!="" && $_GET['pmgpolis']=="" ) {
                    $tambah.=" and mpol_mrkn_nama='".$_GET['mrkn_nama']."'";
                }
            }

            $cmd = "
            (SELECT
                if(mpol_mkomdisc_persen='',0,mpol_mkomdisc_persen) mpol_mkomdisc_persen,
                mpol_ujroh_treaty,
                mpol_mpojk_kode,
                mpol_surplus,
                mpol_note,
                if(mpol_nomor_cetak!=mpol_nomor and mpol_nomor_cetak!='',mpol_nomor_cetak,mpol_nomor) mpol_nomor_cetak,
                mpol_va,
                ifnull(mpol_mja_kode,'') mpol_mja_kode,
                ifnull(mpol_mgpp_kode,'') mpol_mgpp_kode,
                mpol_cetak_lunas,
                mpol_produkbank,
                mpol_aktif,
                mpol_max_up,
                mpol_mgol_kode,
                mpol_mgp_kode,
                mpol_mgs_kode,
                mpol_mlu_kode,
                mpol_nomor,
                mpol_online,
                mpol_jns_tarif,
                mpol_jns_perusahaan,
                mpol_kode,
                mpol_penerima_manfaat,
                mpol_openpolis,
                mpol_penerima_manfaat,
                mpol_jl,
                mpol_jl_pst,
                mpol_jl_pasangan,
                mpol_file_polis,
                mpol_lapor_data,
                mpol_byr_premi,
                mpol_mspaj_nomor,
                mpol_aktif,
                mpol_usia_max,
                mpol_usia_min,
                mpol_tenor_max,
                mpol_jatuh_tempo,
                mpol_mmft_kode_gu,
                mpol_mmft_kode_wp_pns,
                mpol_mmft_kode_wp_swasta,
                mpol_mmft_kode_phk_swasta,
                mpol_mmft_kode_phk_pns,
                mpol_mmft_kode_tlo,
                mpol_mmft_kode_fire,
                mpol_mmft_kode_jiwa,
                mpol_mnfa_kode,
                mpol_endors,
                mpol_mth_nomor,
                date_format(mpol_tgl_terbit,'%d-%m-%Y')mpol_tgl_terbit,
                date_format(mpol_tgl_awal_polis,'%d-%m-%Y')mpol_tgl_awal_polis,
                date_format(mpol_tgl_ahir_polis,'%d-%m-%Y')mpol_tgl_ahir_polis,
                mpol_mrpm_nomor,
                mpol_mjns_kode,
                mjns.mjns_keterangan e_nasabah,
                mpol_ket_endors,
                mpol_msrf_kode,
                mpol_mpuw_nomor,
                mpol_mujhrf_kode,
                mpol_kadaluarsa_klaim,
                mpol_max_bayar_klaim,
                mpol_mpras_kode,
                mpol_aprove_fc,
                mpol_no_endors,
                mpol_jenis_cetak,
                if(ifnull(mpol_mrkn_nama,'')='',mrkn_nama,mpol_mrkn_nama)  mpol_mrkn_nama,
                mpol_mut_kode,
                mjm_bundling,
                mjm_jiwa,
                mjm_gu,
                mjm_phk,
                mjm_tlo,
                mjm_fire,
                mjm_wp,
                mjm_umut,
                uw.mpuw_nama e_uw,
                trf.mth_ket e_tarif,
                '' mpol_mspaj_nama,
                mpol_lapor_stnc,
                #mpol_mekanisme,
                mpol_klaim_doc,
                mpol_payonline,
                mpol_agent,
                mpol_playonline_via,
                mpol_agent_via,
                mpol_va_via,
                mpol_standar_perlindungan,
                mpol_standar_premi,
                mpol_acc_tek,
                mpol_jenis_login,
                mpol_note
            FROM eopr.mst_polis
            LEFT JOIN emst.mst_program_asuransi pras on pras.mpras_kode=mpol_mpras_kode
            LEFT JOIN emst.mst_polis_uwtable uw ON uw.mpuw_nomor=mpol_mpuw_nomor
            LEFT JOIN emst.mst_jaminan jmn ON jmn.mjm_kode=mpol_mjm_kode
            LEFT JOIN emst.mst_rekanan rkn ON rkn.mrkn_kode=mpol_mrkn_kode
            LEFT JOIN emst.mst_lokasi lok  ON lok.mlok_kode=mpol_mlok_kode
            LEFT JOIN esdm.sdm_karyawan_new pnc ON pnc.skar_pk=mpol_mkar_kode_pim
            LEFT JOIN esdm.sdm_karyawan_new mkr ON mkr.skar_pk=mpol_mkar_kode_mkr
            LEFT JOIN emst.mst_tarif trf ON trf.mth_nomor=mpol_mth_nomor
            LEFT JOIN eopr.mst_spaj_polis spaj ON spaj.mspaj_nomor=mpol_mspaj_nomor
            LEFT JOIN emst.mst_produk_induk mpid ON mpid.mpid_kode=mpol_mpid_kode
            LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=mpol_mjns_kode
            LEFT JOIN emst.mst_produk_segment mssp ON mssp.mssp_kode=mpol_mssp_nama
            WHERE 1=1 AND mpol_endos!='3' ".$tambah.")
            UNION ALL(
            SELECT
                if(mpol_mkomdisc_persen='',0,mpol_mkomdisc_persen) mpol_mkomdisc_persen,
                mpol_ujroh_treaty,
                mpol_mpojk_kode,
                mpol_surplus,
                mpol_note,
                if(mpol_nomor_cetak!=mpol_nomor and mpol_nomor_cetak!='',mpol_nomor_cetak,mpol_nomor) mpol_nomor_cetak,
                mpol_va,
                ifnull(mpol_mja_kode,'') mpol_mja_kode,
                ifnull(mpol_mgpp_kode,'') mpol_mgpp_kode,
                mpol_cetak_lunas,
                mpol_produkbank,
                mpol_aktif,
                mpol_max_up,
                mpol_mgol_kode,
                mpol_mgp_kode,
                mpol_mgs_kode,
                mpol_mlu_kode,
                mpol_nomor,
                mpol_online,
                mpol_jns_tarif,
                mpol_jns_perusahaan,
                mpol_kode,
                mpol_penerima_manfaat,
                mpol_openpolis,
                mpol_penerima_manfaat,
                mpol_jl,
                mpol_jl_pst,
                mpol_jl_pasangan,
                mpol_file_polis,
                mpol_lapor_data,
                mpol_byr_premi,
                mpol_mspaj_nomor,
                mpol_aktif,
                mpol_usia_max,
                mpol_usia_min,
                mpol_tenor_max,
                mpol_jatuh_tempo,
                mpol_mmft_kode_gu,
                mpol_mmft_kode_wp_pns,
                mpol_mmft_kode_wp_swasta,
                mpol_mmft_kode_phk_swasta,
                mpol_mmft_kode_phk_pns,
                mpol_mmft_kode_tlo,
                mpol_mmft_kode_fire,
                mpol_mmft_kode_jiwa,
                mpol_mnfa_kode,
                mpol_endors,
                mpol_mth_nomor,
                date_format(mpol_tgl_terbit,'%d-%m-%Y')mpol_tgl_terbit,
                date_format(mpol_tgl_awal_polis,'%d-%m-%Y')mpol_tgl_awal_polis,
                date_format(mpol_tgl_ahir_polis,'%d-%m-%Y')mpol_tgl_ahir_polis,
                mpol_mrpm_nomor,
                mpol_mjns_kode,
                mjns.mjns_keterangan e_nasabah,
                mpol_ket_endors,
                mpol_msrf_kode,
                mpol_mpuw_nomor,
                mpol_mujhrf_kode,
                mpol_kadaluarsa_klaim,
                mpol_max_bayar_klaim,
                mpol_mpras_kode,
                mpol_aprove_fc,
                mpol_no_endors,
                mpol_jenis_cetak,
                if(ifnull(mpol_mrkn_nama,'')='',mrkn_nama,mpol_mrkn_nama)  mpol_mrkn_nama,
                mpol_mut_kode,
                mjm_bundling,
                mjm_jiwa,
                mjm_gu,
                mjm_phk,
                mjm_tlo,
                mjm_fire,
                mjm_wp,
                mjm_umut,
                uw.mpuw_nama e_uw,
                trf.mth_ket e_tarif,
                '' mpol_mspaj_nama,
                mpol_lapor_stnc,
                #mpol_mekanisme,
                8 mpol_klaim_doc,
                mpol_payonline,
                mpol_agent,
                mpol_playonline_via,
                mpol_agent_via,
                mpol_va_via,
                mpol_standar_perlindungan,
                mpol_standar_premi,
                mpol_acc_tek,
                mpol_jenis_login,
                mpol_note
            FROM eopr.mst_polis
            LEFT JOIN emst.mst_program_asuransi pras on pras.mpras_kode=mpol_mpras_kode
            LEFT JOIN emst.mst_polis_uwtable uw ON uw.mpuw_nomor=mpol_mpuw_nomor
            LEFT JOIN emst.mst_jaminan jmn ON jmn.mjm_kode=mpol_mjm_kode
            LEFT JOIN emst.mst_rekanan rkn ON rkn.mrkn_kode=mpol_mrkn_kode
            LEFT JOIN emst.mst_lokasi lok  ON lok.mlok_kode=mpol_mlok_kode
            LEFT JOIN esdm.sdm_karyawan_new pnc ON pnc.skar_pk=mpol_mkar_kode_pim
            LEFT JOIN esdm.sdm_karyawan_new mkr ON mkr.skar_pk=mpol_mkar_kode_mkr
            LEFT JOIN emst.mst_tarif trf ON trf.mth_nomor=mpol_mth_nomor
            LEFT JOIN eopr.mst_spaj_polis spaj ON spaj.mspaj_nomor=mpol_mspaj_nomor
            LEFT JOIN emst.mst_produk_induk mpid ON mpid.mpid_kode=mpol_mpid_kode
            LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=mpol_mjns_kode
            LEFT JOIN emst.mst_produk_segment mssp ON mssp.mssp_kode=mpol_mssp_nama
            WHERE 1=1 and mpol_endos!='3' and mpol_msoc_kode='".$_GET['kdsoc']."' and mpol_mrkn_kode='".$_GET['pmgpolis']."')";
            $res = __dbRow($cmd);

            if (!empty($res)) {
                return __json($res);
            } else {
                $cmd = "
                SELECT
                ''   mpol_surplus,
                ''   mpol_nomor_cetak,
                '0'  mpol_handlingfee,
                ''   mpol_produkbank,
                0   mpol_va,
                ''  mpol_mja_kode,
                ''  mpol_mgpp_kode,
                0   mpol_cetak_lunas,
                0	  mpol_online,
                '0'  mpol_aktif,
                ''   mpol_max_up,
                ''  mpol_kode,
                ''   mpol_jenis_bayar,
                #''  mpol_mslr_kode,
                ''   mpol_mekanisme,
                ''	  mpol_max_bayar_klaim,
                ''   mpol_penerima_manfaat,
                ''  mpol_mpid_kode,
                ''  mpol_jl,
                ''  mpol_jl_pst,
                ''  mpol_jl_pasangan,
                '0' mpol_usia_max,
                '0' mpol_usia_min,
                '0' mpol_tenor_max,
                '0' mpol_jatuh_tempo,
                ''   mpol_mmft_kode_gu,
                '0'  mpol_mmft_kode_wp_pns,
                '0'  mpol_mmft_kode_wp_swasta,
                '0'  mpol_mmft_kode_phk_swasta,
                '0'  mpol_mmft_kode_phk_pns,
                ''   mpol_mmft_kode_tlo,
                ''   mpol_mmft_kode_fire,
                ''   mpol_mmft_kode_jiwa,
                ''  mpol_mnfa_kode,
                ''  mpol_endors,
                ''  mpol_mth_nomor,
                ''  mpol_mrpm_nomor,
                ''  mpol_ket_endors,
                ''  mpol_msrf_kode,
                ''  mpol_mpuw_nomor,
                ''  mpol_mujhrf_kode,
                '0' mpol_kadaluarsa_klaim,
                '0' mpol_lapor_data,
                '0' mpol_byr_premi,
                '0'  mpol_mut_kode,
                ''   e_tarif,
                ''   e_uw,
                '1' mpol_openpolis,
                #'' mpol_mssp_kode,
                #'' mpol_mlok_kode,
                #'' mpol_mkar_kode_mkr,
                #'' mpol_mprov_kode,
                '30'mpol_lapor_data,
                '30'mpol_byr_premi,
                date_format(curdate(),'%d-%m-%Y')  mpol_tgl_terbit,
                date_format(curdate(),'%d-%m-%Y')  mpol_tgl_awal_polis,
                date_format(curdate(),'%d-%m-%Y')  mpol_tgl_ahir_polis,
                '100'mpol_max_pst,
                #''   mpol_mkar_kode_pim,
                #''   mpol_mprov_tipe,
                #''    e_cabalamin,
                #''    e_pinca,
                #''    e_marketing,
                #''    mpol_mssp_nama,
                ''   mpol_file_polis
                FROM eopr.mst_polis
                LEFT JOIN emst.mst_polis_uwtable uw on uw.mpuw_nomor=mpol_mpuw_nomor
                LEFT JOIN emst.mst_jaminan jmn on jmn.mjm_kode=mpol_mjm_kode
                left join emst.mst_rekanan rkn on rkn.mrkn_kode=mpol_mrkn_kode
                LEFT JOIN emst.mst_lokasi lok  on lok.mlok_kode=mpol_mlok_kode
                LEFT JOIN esdm.sdm_karyawan_new pnc on pnc.skar_pk=mpol_mkar_kode_pim
                LEFT JOIN esdm.sdm_karyawan_new mkr on mkr.skar_pk=mpol_mkar_kode_mkr
                LEFT JOIN emst.mst_tarif trf on trf.mth_nomor=mpol_mth_nomor
                LEFT JOIN eopr.mst_spaj_polis spaj on spaj.mspaj_nomor=mpol_mspaj_nomor
                WHERE 1=1 AND mpol_endos IN (0,1,2)";
                $res = __dbRow($cmd);
                return __json($res);
            }
        }
    }

    public function lod_spaj()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        if ($id=="spaj") {
            $tambah = "";
            $vtable="";

            if (isset($_GET['q'])) {
                $e_value = $_GET['q'];
            }

            $vidxkey="mspaj_nomor";
            $vfldname="mspaj_keterangan";

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

        if ($id=="segmen") {
            $tambah = "";
            $vtable="";

            if (isset($_GET['q'])) {
                $e_value = $_GET['q'];
            }

            $vidxkey="mssp_kode";
            $vfldname="mssp_nama";

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
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mjm_kode";
        $vfldname="mjm_nama";

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
                $tambah.="and mptr_induk_nasabah='".$mjns."'";
            }
        }
        if (isset($mssp)) {
            if (!empty($mssp)) {
                $tambah.="and mptr_induk='".$mssp."'";
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
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mpras_kode";
        $vfldname="mpras_nama";

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
                $tambah.=" and mptr_induk='".$mjns."'";
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
        $tambah="";
        $vtable="";

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mpras_kode";
        $vfldname="mpras_nama";

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
        and msoc_mpid_kode='".$mpid."'
        and msoc_mekanisme='".$mkm."'
        and msoc_mekanisme2='".$mkm2."'
        and msoc_mft_kode='".$mft."'
        and msoc_mrkn_kode='".$mrkn."'
        and msoc_mssp_nama='".$mssp."'
        and msoc_mjm_kode='".$mjm."'
        and msoc_mjns_kode='".$mjns."'
        and msoc_jenis_bayar='".$byr."'
        and msoc_jns_perusahaan='".$perush."'
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
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mlok_kode";
        $vfldname="mlok_nama";

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
                $tambah.=" and mptr_induk='".$mjns."'";
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
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="skar_pk";
        $vfldname="skar_nama";

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
            $tambah.="and skar_mlok_kode='".$mlok."'";
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

    public function lod_tarif_polis()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mth_nomor";
        $vfldname="mth_ket";

        $vfield = "
        mth_nomor kode,
        trf.mth_ket nama";

        $vtable = "eopr.mst_soc
        LEFT JOIN emst.mst_tarif trf ON trf.mth_nomor=msoc_mth_nomor";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if($jnspro!=4) {
            $tambah ="and mth_ket!='' and msoc_kode='".$msoc."' and msoc_mrkn_kode='".$pmgpolis."' ";
        } else {
            $tambah ="and mth_ket!=''";
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

    public function lod_uw_polis()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mpuw_nomor";
        $vfldname="mpuw_nama";

        $vfield = "
        mpuw_nomor kode,
        mpuw.mpuw_nama nama";

        $vtable = "eopr.mst_soc
        LEFT JOIN emst.mst_polis_uwtable mpuw ON mpuw.mpuw_nomor=msoc_mpuw_nomor";

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }
        if($jnspro!=4) {
            $tambah =" and mpuw_nama!='' and msoc_kode='".$msoc."' and msoc_mrkn_kode='".$pmgpolis."' ";
        } else {
            $tambah ="and mpuw_nama!=''";
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
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mprov_kode";
        $vfldname="mprov_nama";

        $vfield = "
        mprov_kode,
        mprov_nama,
        IF(IFNULL(mpwl_mpol_kode,'')='','0','1') ck";

        $vtable = "emst.mst_provinsi LEFT JOIN eopr.mst_polis_provinsi ON mpwl_mpol_kode='".$polis."'
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

        return __json($res);
    }

    public function lod_paymod()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";
        $vtable="";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        $vidxkey="mpm_kode";
        $vfldname="mpm_nama";

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
            $tambah="and mpm_tipe='".$tipe."'";
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

    public function menuAll()
    {
        $cmd = "
        SELECT *
        FROM web_conf.web_menu
        LEFT JOIN web_conf.user_accounts ON wmn_tipe=menu_tipe
        LEFT JOIN web_conf.web_menu_jabatan ON wmn_kode=wmj_wmn_kode AND jabatan=wmj_sjab_kode
        WHERE 1=1
        AND wmn_key='MAIN'
        AND wmn_tipe='".__getGlbVal('menu_tipe')."'
        AND email='".__getGlbVal('email')."'
        AND wmj_sjab_kode='".__getJab()."'
        AND wmj_aktif=1
        ORDER BY wmn_urut ASC";
        $menulist = __dbAll($cmd);

        return __json($menulist);
    }
}
