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

        $vidxkey = "value";
        $vfldname = "text";

        if (isset($_GET['q'])) {
            $e_value = $_GET['q'];
        }

        if (!empty($e_value)) {
            $tambah .= $tambah . "and ($vidxkey like '%$e_value%' or $vfldname like '%$e_value%')";
        }

        if (isset($_GET['mjns'])) {
            if ($_GET['mjns'] != "") {
                $tambah .= $tambah . "and mssp_kode In (SELECT mptr_kode FROM emst.mst_protree_2 WHERE mptr_induk='" . $_GET['mjns'] . "')";
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

        if (isset($_GET['c_kdsoc']) == "1") {
            if (!empty($_GET['e_kdsoc'])) {
                $tambah = $tambah . " and msoc_kode= '" . $_GET['e_kdsoc'] . "' ";
            }
        }

        if (isset($_GET['c_jaminan']) == "1") {
            if (!empty($_GET['e_jaminan'])) {
                $tambah = $tambah . " and msoc_mjm_kode= '" . $_GET['e_jaminan'] . "' ";
            }
        }

        if (isset($_GET['c_jnas']) == "1") {
            if (!empty($_GET['e_jnas'])) {
                $tambah = $tambah . " and msoc_mjns_kode= '" . $_GET['e_jnas'] . "' ";
            }
        }

        if (isset($_GET['c_pmgpolis']) == "1") {
            if (!empty($_GET['e_pmgpolis'])) {
                $tambah = $tambah . " and msoc_mrkn_kode= '" . $_GET['e_pmgpolis'] . "' ";
            }
        }

        $cmd = "
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
            " . $tambah . "
            GROUP BY msoc_kode
            ORDER BY UNIX_TIMESTAMP(msoc_ins_date)  desc
            LIMIT " . $_GET['e_baris'] . "
        ";
        $res = __dbAll($cmd);
        return view('pages.tehnik.soc.lihat-editsoc.tables', [
            'res' => $res
        ]);
        // return __dtTables($res, "");
    }

    public function grd_approv_soc()
    {
        extract($_GET);

        $tambah = "";

        if (isset($_GET['c_status']) == "1") {
            if (isset($_GET['e_status'])) {
                $tambah = $tambah . " and ifnull(mpol_msoc_kode,'')='' and msoc_approve= '" . $_GET['e_status'] . "' ";
            }
        }

        if (isset($_GET['c_terbit']) == "1") {
            if (isset($_GET['e_terbit']) == 1) {
                $tambah = $tambah . " and IFNULL(mpol_kode,'')='' ";
            } else {
                $tambah = $tambah . " and IFNULL(mpol_kode,'')!='' ";
            }
        }

        $cmd = "
        SELECT
        msoc_mrkn_nama,
        msoc_nomor,
        msoc_kode,
        msoc_kode_ori,
        msoc_mth_nomor,
        mft.mft_nama msoc_mft_nama,
        mjm.mjm_nama msoc_mjm_nama,
        pras.mpras_nama msoc_mpras_nama,
        mjns.mjns_keterangan msoc_mjns_keterangan,
        mpid.mpid_nama msoc_mpid_nama,
        IF(msoc_approve=1,'Sudah','Belum') approv,
        IFNULL(L0.mpap_note,'') L0mpap_note, emst.f_getaprov(L0.mpap_status,'POLIS') L0sts, IFNULL(L1.mpap_note,'') L1mpap_note, emst.f_getaprov(L1.mpap_status,'POLIS') L1sts, IFNULL(L2.mpap_note,'') L2mpap_note, emst.f_getaprov(L2.mpap_status,'POLIS') L2sts, IFNULL(L3.mpap_note,'') L3mpap_note, emst.f_getaprov(L3.mpap_status,'POLIS') L3sts, IFNULL(L4.mpap_note,'') L4mpap_note, emst.f_getaprov(L4.mpap_status,'POLIS') L4sts, IFNULL(L5.mpap_note,'') L5mpap_note, emst.f_getaprov(L5.mpap_status,'POLIS') L5sts, IFNULL(L6.mpap_note,'') L6mpap_note, emst.f_getaprov(L6.mpap_status,'POLIS') L6sts, IFNULL(L7.mpap_note,'') L7mpap_note, emst.f_getaprov(L7.mpap_status,'POLIS') L7sts, IFNULL(L8.mpap_note,'') L8mpap_note, emst.f_getaprov(L8.mpap_status,'POLIS') L8sts
        FROM eopr.mst_soc
        LEFT JOIN eopr.mst_polis_aprov L0 ON L0.mpap_level=0 AND L0.mpap_mpol_kode=msoc_kode
        LEFT JOIN eopr.mst_polis_aprov L1 ON L1.mpap_level=1 AND L1.mpap_mpol_kode=msoc_kode
        LEFT JOIN eopr.mst_polis_aprov L2 ON L2.mpap_level=2 AND L2.mpap_mpol_kode=msoc_kode
        LEFT JOIN eopr.mst_polis_aprov L3 ON L3.mpap_level=3 AND L3.mpap_mpol_kode=msoc_kode
        LEFT JOIN eopr.mst_polis_aprov L4 ON L4.mpap_level=4 AND L4.mpap_mpol_kode=msoc_kode
        LEFT JOIN eopr.mst_polis_aprov L5 ON L5.mpap_level=5 AND L5.mpap_mpol_kode=msoc_kode
        LEFT JOIN eopr.mst_polis_aprov L6 ON L6.mpap_level=6 AND L6.mpap_mpol_kode=msoc_kode
        LEFT JOIN eopr.mst_polis_aprov L7 ON L7.mpap_level=7 AND L7.mpap_mpol_kode=msoc_kode
        LEFT JOIN eopr.mst_polis_aprov L8 ON L8.mpap_level=8 AND L8.mpap_mpol_kode=msoc_kode
        LEFT JOIN emst.mst_rekanan ps ON ps.mrkn_kode=msoc_mrkn_kode
        LEFT JOIN emst.mst_jaminan mjm ON mjm.mjm_kode=msoc_mjm_kode
        LEFT JOIN emst.mst_manfaat_plafond mft ON mft.mft_kode=msoc_mft_kode
        LEFT JOIN emst.mst_program_asuransi pras ON pras.mpras_kode=msoc_mpras_kode
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=msoc_mjns_kode
        LEFT JOIN emst.mst_produk_induk mpid ON mpid.mpid_kode=msoc_mpid_kode
        LEFT JOIN eopr.mst_polis ON mpol_msoc_kode=msoc_kode
        WHERE 1=1 AND msoc_endos!='3' " . $tambah . "";

        $res = __dbAll($cmd);
        return view('pages.tehnik.soc.lihat-socterbit-polis.tables', [
            'data' => $res
        ]);
    }

    public function grd_pjkomisi()
    {
        extract($_GET);
        set_time_limit(10000000);
        $tambah = "";

        $bln1 = $_GET['e_bln1'];
        $bln2 = $_GET['e_bln2'];
        $thn = $_GET['e_thn'];
        $cab = $_GET['e_cab'];

        $tambah = $tambah . "and tpprd_mlok_kode= '" . $cab . "'";
        $tambah = $tambah . "and month(date(tpprd_insert_fix)) between '" . $bln1 . "' and '" . $bln2 . "' and year(date(tpprd_insert_fix))='" . $thn . "'";

        if (isset($_GET['c_pmgpolis']) == "1") {
            if (isset($_GET['e_pmgpolis'])) {
                $tambah = $tambah . "and mpol_mrkn_kode='" . $_GET['e_pmgpolis'] . "'";
            }
        }

        if (isset($_GET['c_cbpmgpolis']) == "1") {
            if (isset($_GET['e_cbpmgpolis'])) {
                $tambah = $tambah . "and cb.mrkn_kode= '" . $_POST['e_cbpmgpolis'] . "' ";
            }
        }

        $cmd = "
        (SELECT
            mpol_kode kdpolis,
            mpol_mrkn_kode kode,
            mpol_mrkn_nama nama,
            COUNT(tpprd_pk) tpst,
            SUM(tpprd_up) tup,
            SUM(tpprd_premi_bayar) ttagih,
            SUM(tpprd_total_bayar_dtl) tbyr,
            SUM(epstfix.F_GET_RUMUSPRODUKSI(
            'KOMISI',
            tpprd_pk,
            tpprd_nomor_polish,
            tpprd_jatuhtempo,
            tpprd_umur,
            tpprd_umur2,
            tpprd_tanggal_lahir,
            tpprd_tanggal_lahir2,
            tpprd_tanggal_awal,
            tpprd_tanggal_akhir,
            tpprd_masa_tahun,
            tpprd_masa_bulan,
            tpprd_up,
            tpprd_tarif_persen,
            tpprd_tarif,
            tpprd_admin,
            tpprd_admin_persen,
            tpprd_disc,
            tpprd_disc_persen,
            tpprd_disc_ajukan,
            tpprd_discpolis,
            tpprd_discpolis_persen,
            tpprd_disc_lain_persen,
            tpprd_disc_lain,
            tpprd_biaya_medis,
            tpprd_extra,
            tpprd_extra_persen,
            tpprd_em_persen_reas,
            tpprd_premi_reas,
            tpprd_up_baru,
            tpprd_premi,
            tpprd_premi_co,
            tpprd_premi_bayar,
            tpprd_share,
            tpprd_up_persen,
            tpprd_ujroh_persen,
            tpprd_ujroh,
            tpprd_komisi_persen,
            tpprd_komisi,
            tpprd_status_usertax_persen,
            tpprd_status_usertax,
            tpprd_tax_persen,
            tpprd_tax,
            tpprd_komisi_bayar,
            tpprd_manajemenfee_persen,
            tpprd_manajemenfee,
            tpprd_overidding_persen,
            tpprd_overidding,
            tpprd_referal,
            tpprd_referal_persen,
            tpprd_maintenance,
            tpprd_maintenance_persen,
            tpprd_handlingfee_persen,
            tpprd_handlingfee,
            tpprd_disc_ujroh,
            tpprd_refund_premi,
            tpprd_tanggal_bayar,
            tpprd_total_bayar_dtl,
            tpprd_total_bayar,
            tpprd_status_bayar,
            tpprd_jenis_bayar,
            tpprd_tarif_nonlife,
            tpprd_premi_nonlife,
            tpprd_tarif_persen_nonlife,
            tpprd_umur_polis,
            tpprd_status_bayar_lain,
            tpprd_tanggal_bayar_lain,
            tpprd_total_bayar_lain,
            tpprd_total_bayar_disc,
            tpprd_tanggal_bayar_disc,
            tpprd_em_status,
            tpprd_em_tanggal,
            tpprd_reas_premilife,
            tpprd_reas_preminonlife,
            tpprd_reas_ujrohreas,
            tpprd_reas_tabbaru,
            tpprd_share_reindo,
            tpprd_share_nasre,
            tpprd_share_alamin,
            tpprd_tabaru_life,
            tpprd_uangkuliah_semester,
            tpprd_uangkuliah_tunggal,
            tpprd_tahun_kuliah,
            tpprd_masa_kuliah,
            tpprd_ajufee,
            tpprd_ajufee_persen,
            tpprd_total_refund,
            tpprd_selisih_premi,
            mjns_kode,
            mjm_kode,
            ''
            )) tkomisi,
            SUM((epstfix.F_GET_RUMUSPRODUKSI(
            'KOMISI',
            tpprd_pk,
            tpprd_nomor_polish,
            tpprd_jatuhtempo,
            tpprd_umur,
            tpprd_umur2,
            tpprd_tanggal_lahir,
            tpprd_tanggal_lahir2,
            tpprd_tanggal_awal,
            tpprd_tanggal_akhir,
            tpprd_masa_tahun,
            tpprd_masa_bulan,
            tpprd_up,
            tpprd_tarif_persen,
            tpprd_tarif,
            tpprd_admin,
            tpprd_admin_persen,
            tpprd_disc,
            tpprd_disc_persen,
            tpprd_disc_ajukan,
            tpprd_discpolis,
            tpprd_discpolis_persen,
            tpprd_disc_lain_persen,
            tpprd_disc_lain,
            tpprd_biaya_medis,
            tpprd_extra,
            tpprd_extra_persen,
            tpprd_em_persen_reas,
            tpprd_premi_reas,
            tpprd_up_baru,
            tpprd_premi,
            tpprd_premi_co,
            tpprd_premi_bayar,
            tpprd_share,
            tpprd_up_persen,
            tpprd_ujroh_persen,
            tpprd_ujroh,
            tpprd_komisi_persen,
            tpprd_komisi,
            tpprd_status_usertax_persen,
            tpprd_status_usertax,
            tpprd_tax_persen,
            tpprd_tax,
            tpprd_komisi_bayar,
            tpprd_manajemenfee_persen,
            tpprd_manajemenfee,
            tpprd_overidding_persen,
            tpprd_overidding,
            tpprd_referal,
            tpprd_referal_persen,
            tpprd_maintenance,
            tpprd_maintenance_persen,
            tpprd_handlingfee_persen,
            tpprd_handlingfee,
            tpprd_disc_ujroh,
            tpprd_refund_premi,
            tpprd_tanggal_bayar,
            tpprd_total_bayar_dtl,
            tpprd_total_bayar,
            tpprd_status_bayar,
            tpprd_jenis_bayar,
            tpprd_tarif_nonlife,
            tpprd_premi_nonlife,
            tpprd_tarif_persen_nonlife,
            tpprd_umur_polis,
            tpprd_status_bayar_lain,
            tpprd_tanggal_bayar_lain,
            tpprd_total_bayar_lain,
            tpprd_total_bayar_disc,
            tpprd_tanggal_bayar_disc,
            tpprd_em_status,
            tpprd_em_tanggal,
            tpprd_reas_premilife,
            tpprd_reas_preminonlife,
            tpprd_reas_ujrohreas,
            tpprd_reas_tabbaru,
            tpprd_share_reindo,
            tpprd_share_nasre,
            tpprd_share_alamin,
            tpprd_tabaru_life,
            tpprd_uangkuliah_semester,
            tpprd_uangkuliah_tunggal,
            tpprd_tahun_kuliah,
            tpprd_masa_kuliah,
            tpprd_ajufee,
            tpprd_ajufee_persen,
            tpprd_total_refund,
            tpprd_selisih_premi,
            mjns_kode,
            mjm_kode,
            ''
            )*tpprd_overidding_persen)/100) toverreding,
        mlok_nama cabang,
        '" . $bln1 . "' bln1,
        '" . $bln2 . "' bln2,
        '" . $thn . "' thn,
        '" . $cab . "' cab,
        CONCAT(mjns_keterangan,'/',mjm_nama,'/',mft_nama,'/',mpol_kode) ket
        FROM epstfix.peserta_all
        LEFT JOIN eopr.mst_polis ON mpol_kode=tpprd_nomor_polish
        LEFT JOIN emst.mst_jenis_nasabah ON mpol_mjns_kode=mjns_kode
        LEFT JOIN emst.mst_jaminan ON mjm_kode=mpol_mjm_kode
        LEFT JOIN emst.mst_manfaat_plafond ON mft_kode=mpol_mft_kode
        LEFT JOIN emst.mst_lokasi ON tpprd_mlok_kode=mlok_kode,
        emst.mst_rekanan cb
        LEFT JOIN emst.mst_rekanan ps ON  IF(IFNULL(cb.mrkn_mrkn_kode_induk,'')='' OR cb.mrkn_mrkn_kode_induk='-' ,cb.mrkn_kode,cb.mrkn_mrkn_kode_induk) =ps.mrkn_kode
        WHERE tpprd_mrkn_kode=cb.mrkn_kode
        #AND tpprd_total_bayar_dtl>=tpprd_premi_bayar
        AND (tpprd_total_bayar_dtl-tpprd_premi_bayar)>-0.1
        AND IFNULL(tpprd_komisi_persen,0)>0 AND IFNULL(tpprd_tax_persen,0)<1
        AND tpprd_status_klaim!=1 AND tpprd_status_refund!=1
        AND tpprd_status_batal!=1 AND tpprd_status_bayar=1
        AND tpprd_status='1'
        " . $tambah . "
        GROUP BY mpol_kode
        ORDER BY mpol_mrkn_nama,mlok_nama ASC
        LIMIT 10000)";

        $res = __dbAll($cmd);

        return view('pages.keuangan.komisi-overreding.input-pajak.tables', [
            'data' => $res
        ]);
    }

    public function grd_lihat_polis()
    {
        extract($_GET);
        $tambah = "";
        $cab = __getLokasi();
        $menutipe = __getGlbVal("menu_tipe");

        if (isset($_GET['c_jaminan'])) {
            $tambah = $tambah . "and mpol_mjm_kode='" . $_GET['e_jaminan'] . "'";
        }
        if (isset($_GET['c_pmgpolis'])) {
            $tambah = $tambah . "and mpol_mrkn_kode='" . $_GET['e_pmgpolis'] . "'";
        }
        if (isset($_GET['c_nasabah'])) {
            $tambah = $tambah . "and mpol_mjns_kode='" . $_GET['e_nasabah'] . "'";
        }
        if (isset($_GET['c_progasu'])) {
            $tambah = $tambah . "and mpol_mpras_kode='" . $_GET['e_progasu'] . "'";
        }
        if (isset($_GET['c_kelreas'])) {
            if ($_GET['e_kelreas'] == "1") {
                $tambah = $tambah . " and mpol_kode in (
                SELECT
                mprd_mpol_kode
                FROM eopr.mst_polis_reas_hdr,eopr.mst_polis_reas_dtl
                WHERE mprh_pk=mprd_mprh_pk) ";
            }
            if ($_GET['e_kelreas'] == "0") {
                $tambah = $tambah . " and mpol_kode not in (
                SELECT
                mprd_mpol_kode
                FROM eopr.mst_polis_reas_hdr,eopr.mst_polis_reas_dtl
                WHERE mprh_pk=mprd_mprh_pk) ";
            }
        }
        if (isset($_GET['c_nopolis'])) {
            $tambah = $tambah . "and mpol_kode='" . $_GET['e_nopolis'] . "'";
        }
        if (isset($_GET['c_stspolis'])) {
            if ($_GET['e_stspolis'] == "0") {
                $tambah = $tambah . "and mpol_status_polis IN ('0','2') ";
            } else {
                $tambah = $tambah . "and mpol_status_polis IN ('1','3') ";
            }
        }
        if (isset($_GET['c_nosoc'])) {
            $tambah = $tambah . "and mpol_msoc_kode='" . $_GET['e_nosoc'] . "'";
        }
        if (isset($_GET['c_stsaktif'])) {
            $tambah = $tambah . "and mpol_aktif='" . $_GET['e_stsaktif'] . "'";
        }
        if (isset($_GET['c_tglterbit'])) {
            $tambah = $tambah . "and mpol_tgl_terbit between'" . __str2($_GET['e_tglterbit1'], 'D') . "' and '" . __str2($_GET['e_tglterbit2'], 'D') . "' ";
        }
        if ($menutipe == "CABANG") {
            $tambah = $tambah . "and mpol_mlok_kode='" . $cab . "'";
        }

        $cmd = "
        SELECT
            mpol_nomor,
            IFNULL(mpol_file_polis,'') sfile,
            CASE mpol_endos
            WHEN '0' THEN 'Baru'
            WHEN '1' THEN 'Edit'
            WHEN '2' THEN 'Endos'
            END status,
            mpli_nomor,
            mpol_kode,
            if(mpol_aktif=1,'aktif',IF(mpol_aktif=2,'mati','suspend')) aktif,
            if(mpol_online=1,'aktif',IF(mpol_online=2,'mati','mati')) online,
            mjm_nama,
            mpol_mpuw_nomor,
            left(mssp_nama,12) mssp_nama,
            mpol_mrkn_nama,
            mjns.mjns_Keterangan mjns_nama,
            mpras.mpras_nama mpol_mpras_nama,
            replace(mlok.mlok_nama,'CAB.','') cabang ,
            mft_nama,
            mkm_nama,
            mpol_convert_img,
            mpras_nama,
            if(mpol_jenis_bayar=2,'PER BULAN',if(mpol_jenis_bayar=1,'PER TAHUN','SEKALIGUS')) bayar,
            mker_nama,
            mpol_msoc_kode,
            mpol_ins_date,
            mpol_ins_user,
            if(mpol_approve=1,'sudah','belum') msoc_approve,
            mkm_ket2,
            mpid_nama,
            mpojk_nama mpid_nama_ojk,
            DATEDIFF(curdate(),date(mpol_ins_date)) umur,
            mpol_mfee_persen,mpol_mdr_kode,
            mpol_mujh_persen,mpol_mmfe_persen,mpol_overreding,
            if(ifnull(mpol_openpolis,'0')='1','',DATE_FORMAT(DATE(mpol_tgl_ahir_polis),'%d %M %Y')) mpol_tgl_ahir_polis
        FROM eopr.mst_polis
        LEFT JOIN emst.mst_produk_ojk ON mpojk_kode=mpol_mpojk_kode
        LEFT JOIN emst.mst_produk_induk ON mpid_kode=mpol_mpid_kode
        LEFT JOIN emst.mst_lokasi mlok ON mlok.mlok_kode=mpol_mlok_kode
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=mpol_mjns_kode
        LEFT JOIN emst.mst_produk_segment mssp ON mssp.mssp_kode=mpol_mssp_kode
        LEFT JOIN emst.mst_program_asuransi mpras ON mpras.mpras_kode=mpol_mpras_kode
        LEFT JOIN emst.mst_jaminan mjm ON mjm.mjm_kode=mpol_mjm_kode
        LEFT JOIN emst.mst_manfaat_plafond  ON mft_kode=mpol_mft_kode
        LEFT JOIN emst.mst_mekanisme ON mkm_kode=mpol_mekanisme
        LEFT JOIN emst.mst_pekerjaan ON mker_kode=mpol_jns_perusahaan
        LEFT JOIN emst.mst_mekanisme2 ON mkm_kode2=mpol_mekanisme2
        LEFT JOIN eopr.mst_polis_induk ON mpli_nomor=mpol_nomor
        WHERE 1=1 and mpol_endos!='3'
        " . $tambah . "
        ORDER BY cabang,mpol_mrkn_nama ASC
        LIMIT " . $_GET['e_baris'] . "
        ";

        $res = __dbAll($cmd);

        // return __json($res);
        return view('pages.tehnik.polis.lihat-polis.tables', [
            'res' => $res
        ]);
    }
}
