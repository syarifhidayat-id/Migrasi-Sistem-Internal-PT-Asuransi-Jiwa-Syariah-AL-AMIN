<?php

namespace App\Http\Controllers\wwRpt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Grd extends Controller
{

    public function grd_segmen()
    {
        extract($_GET);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 100;
        $offset = ($page - 1) * $rows;

        $tambah = "";

        $vidxkey="value";
        $vfldname="text";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        if (isset($_GET['mjns'])) {
            if ($_GET['mjns']!="") {
                $tambah .= $tambah."and mssp_kode In (SELECT mptr_kode FROM emst.mst_protree_2 WHERE mptr_induk='".$_GET['mjns']."')";
            }
        }

        $cmdx = "
        SELECT
            mssp_kode value,
            mssp_nama text,
            mssp_group groupx
        FROM emst.mst_produk_segment
        WHERE mssp_group<>'' AND 1=1 $tambah
        LIMIT $offset,$rows";
        $res1 = __dbAll($cmdx);

        $cmd = "
        SELECT
            mssp_kode value,
            mssp_nama text
        FROM emst.mst_produk_segment
        WHERE mssp_group='' AND 1=1 $tambah
        LIMIT $offset,$rows";
        $res2 = __dbAll($cmd);

        $res = array_merge($res2, $res1);
        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd = "
            '' kode, '' nama, '' result";
            $res = __dbAll($cmd);
            return __json($res);
        }
    }

    public function grd_lihat_soc_khu()
    {
        extract($_GET);

        $tambah = "";

        if ($_GET['c_kdsoc']==1) {
            if (!empty($_GET['e_kdsoc'])) {
                $tambah=$tambah." and msoc_kode= '".$_GET['e_kdsoc']."' ";
            }
        }

        if ($_GET['c_jaminan']==1) {
            if (!empty($_GET['e_jaminan'])) {
                $tambah=$tambah." and msoc_mjm_kode= '".$_GET['e_jaminan']."' ";
            }
        }

        if ($_GET['c_jnas']==1) {
            if (!empty($_GET['e_jnas'])) {
                $tambah=$tambah." and msoc_mjns_kode= '".$_GET['e_jnas']."' ";
            }
        }

        if ($_GET['c_pmgpolis']==1) {
            if (!empty($_GET['e_pmgpolis'])) {
                $tambah=$tambah." and msoc_mrkn_kode= '".$_GET['e_pmgpolis']."' ";
            }
        }

        $cmd="
        SELECT CASE msoc_mft_kode WHEN '01' THEN 'UM' WHEN '02' THEN 'UT' WHEN '03' THEN 'UM FLAT' WHEN '04' THEN 'UM EFEKTIF' WHEN '05' THEN 'UM SLIDING' END msoc_mft_kode,msoc_nomor msli_nomor, msoc_kode,msoc_mrkn_nama msli_mrkn_nama, mjns.mjns_Keterangan mjns_nama, mpras.mpras_nama mpli_mpras_nama,
            mft_nama,msoc_mpuw_nomor,
            mkm_nama,
            mpras_nama,
            mkm_ket2,
            mssp_nama,
            mker_nama,msoc_ins_date,msoc_ins_user,
            mjm_nama,
            if(msoc_jenis_bayar=2,'PER BULAN',if(msoc_jenis_bayar=1,'PER TAHUN','SEKALIGUS')) bayar ,
            if(msoc_approve=1,'sudah','belum') msoc_approve,
            DATEDIFF(curdate(),date(msoc_ins_date)) umur,
            ifnull(mpol_kode,' belum dibuat polis') mpol_kode,
            if(mpol_approve=1,'sudah','belum') mpol_approve,
            if(mpol_aktif=1,'aktif',IF(mpol_aktif=2,'mati','suspend')) aktif,
            if(mpol_online=1,'aktif',IF(mpol_online=2,'mati','mati')) online

            FROM eopr.mst_soc
            LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=msoc_mjns_kode
            LEFT JOIN emst.mst_produk_segment mssp ON mssp.mssp_kode=msoc_mssp_kode
            LEFT JOIN emst.mst_program_asuransi mpras ON mpras.mpras_kode=msoc_mpras_kode
            LEFT JOIN emst.mst_jaminan mjm ON mjm.mjm_kode=msoc_mjm_kode
            LEFT JOIN emst.mst_manfaat_plafond  ON mft_kode=msoc_mft_kode
            LEFT JOIN emst.mst_mekanisme  ON mkm_kode=msoc_mekanisme
            LEFT JOIN emst.mst_pekerjaan  ON mker_kode=msoc_jns_perusahaan
            LEFT JOIN emst.mst_mekanisme2 ON mkm_kode2=msoc_mekanisme2
            LEFT JOIN eopr.mst_polis on msoc_kode=mpol_msoc_kode

            WHERE 1=1 AND msoc_endos!='3'
            ".$tambah."
            GROUP BY msoc_kode
            ORDER BY UNIX_TIMESTAMP(msoc_ins_date)  desc
            LIMIT ".$_GET['e_baris']."
        ";
        $res = __dbAll($cmd);

        return __dtTables($res, "");
    }
}
