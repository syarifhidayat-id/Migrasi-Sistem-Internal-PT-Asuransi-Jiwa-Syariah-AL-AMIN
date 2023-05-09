<?php

namespace App\Http\Controllers\wwLoad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Get extends Controller
{
    public function get_editmenu()
    {
        extract($_GET);
        $tambah = "";

        $cmd = "
        SELECT *
        FROM web_conf.web_menu
        WHERE wmn_kode= '" . $_GET['kode'] . "' ";
        $res = __dbRow($cmd);

        return __json($res);
    }

    public function get_nosoc()
    {
        extract($_GET);
        $tambah = "";

        if (isset($_GET['pmgpolis'])) {
            if ($_GET['pmgpolis'] != "") {
                $tambah = $tambah .= " and msli_mrkn_kode='" . $_GET['pmgpolis'] . "'";
            }
        }

        if (isset($_GET['nopolis'])) {
            if ($_GET['nopolis'] != "") {
                $tambah = $tambah .= " and msli_nomor='" . $_GET['nopolis'] . "'";
            }
        }

        if (isset($_GET['nasabah'])) {
            if ($_GET['nasabah'] != "") {
                $tambah = $tambah .= " and msli_mjns_kode='" . $_GET['nasabah'] . "'";
            }
        }

        if (isset($_GET['mft'])) {
            if ($_GET['mft'] != "") {
                $tambah = $tambah .= " and msoc_mft_kode='" . $_GET['mft'] . "'";
            }
        }

        if (isset($_GET['mekanisme'])) {
            if ($_GET['mekanisme'] != "") {
                $tambah = $tambah .= " and msoc_mekanisme='" . $_GET['mekanisme'] . "'";
            }
        }

        if (isset($_GET['mekanisme2'])) {
            if ($_GET['mekanisme2'] != "") {
                $tambah = $tambah .= " and msoc_mekanisme2='" . $_GET['mekanisme2'] . "'";
            }
        }

        if (isset($_GET['perus'])) {
            if ($_GET['perus'] != "") {
                $tambah = $tambah .= " and msoc_jns_perusahaan='" . $_GET['perus'] . "'";
            }
        }

        if (isset($_GET['jns_bayar'])) {
            if ($_GET['jns_bayar'] != "") {
                $tambah = $tambah .= " and msoc_jenis_bayar='" . $_GET['jns_bayar'] . "'";
            }
        }

        if (isset($_GET['mrkn_nama'])) {
            if ($_GET['mrkn_nama'] != "" && $_GET['pmgpolis'] == "") {
                $tambah = $tambah .= " and msli_mrkn_nama='" . $_GET['mrkn_nama'] . "'";
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
        WHERE 1=1 and msli_status_endos in (0,1,2) " . $tambah . "";
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

        if ($_GET['id'] == "msoc_kode") {
            if (isset($_GET['pmgpolis'])) {
                if ($_GET['pmgpolis'] != "") {
                    $tambah .= " and msoc_mrkn_kode='" . $_GET['pmgpolis'] . "'";
                }
            }

            if (isset($_GET['nopolis'])) {
                if ($_GET['nopolis'] != "") {
                    $tambah .= " and msoc_nomor='" . $_GET['nopolis'] . "'";
                }
            }

            if (isset($_GET['jns_bayar'])) {
                if ($_GET['jns_bayar'] != "") {
                    $tambah .= " and msoc_jenis_bayar='" . $_GET['jns_bayar'] . "'";
                }
            }

            if (isset($_GET['mekanisme'])) {
                if ($_GET['mekanisme'] != "") {
                    $tambah .= " and msoc_mekanisme='" . $_GET['mekanisme'] . "'";
                }
            }

            if (isset($_GET['jns_perusahaan'])) {
                if ($_GET['jns_perusahaan'] != "") {
                    $tambah .= " and msoc_jns_perusahaan='" . $_GET['jns_perusahaan'] . "'";
                }
            }

            if (isset($_GET['nasabah'])) {
                if ($_GET['nasabah'] != "") {
                    $tambah .= " and msoc_mjns_kode='" . $_GET['nasabah'] . "'";
                }
            }

            if (isset($_GET['mft'])) {
                if ($_GET['mft'] != "") {
                    $tambah .= " and msoc_mft_kode='" . $_GET['mft'] . "'";
                }
            }

            if (isset($_GET['mjm'])) {
                if ($_GET['mjm'] != "") {
                    $tambah .= " and msoc_mjm_kode='" . $_GET['mjm'] . "'";
                }
            }

            if (isset($_GET['mrkn_nama'])) {
                if ($_GET['mrkn_nama'] != "" && $_GET['pmgpolis'] == "") {
                    $tambah .= " and msoc_mrkn_nama='" . $_GET['mrkn_nama'] . "'";
                }
            }

            if (isset($_GET['pras'])) {
                if ($_GET['pras'] != "") {
                    $tambah .= " and msoc_mpras_kode='" . $_GET['pras'] . "'";
                }
            }

            if (isset($_GET['mekanisme2'])) {
                if ($_GET['mekanisme2'] != "") {
                    $tambah .= " and msoc_mekanisme2='" . $_GET['mekanisme2'] . "'";
                }
            }

            $tambah = " and msoc_kode='" . $_GET['kode'] . "'";
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
            IF('" . $_GET['endos'] . "'='2','0',msoc_approve) msoc_approve,
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
            WHERE 1=1 AND msoc_endos IN (0,1,2) " . $tambah . "";
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

    public function get_oldpolis()
    {
        extract($_GET);
        $tambah = "";

        $msoc2 = $msoc;
        if (isset($_GET['pmgpolis'])) {
            if ($_GET['pmgpolis'] != "") {
                $tambah .= " and mpol_mrkn_kode='" . $_GET['pmgpolis'] . "'";
            }
        }

        if (isset($_GET['mrkn_nama'])) {
            if ($_GET['mrkn_nama'] != "" && $_GET['pmgpolis'] == "") {
                $tambah .= " and mpol_mrkn_nama='" . $_GET['mrkn_nama'] . "'";
            }
        }
        $tambah .= " and mpol_msoc_kode='" . $msoc . "' ";

        $cmd = "
        SELECT
            mpol_kode,
            mpol_nomor,
            mpol_lapor_stnc,
            mpol_handlingfee,
            mpol_va,
            mpol_cetak_lunas,
            mpol_produkbank,
            mpol_aktif,
            mpol_max_up,
            mpol_online,
            mpol_jns_perusahaan,
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
            date_format(mpol_tgl_terbit,'%d-%m-%Y')mpol_tgl_terbit,
            date_format(mpol_tgl_awal_polis,'%d-%m-%Y')mpol_tgl_awal_polis,
            date_format(mpol_tgl_ahir_polis,'%d-%m-%Y')mpol_tgl_ahir_polis,
            mpol_mrpm_nomor,
            mpol_mjns_kode,
            mjns.mjns_keterangan e_nasabah,
            mpol_ket_endors,
            mpol_msrf_kode,
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
            mpol_mjm_kode,
            mpol_mekanisme
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
        WHERE 1=1 AND mpol_endos!='3' and mpol_kode='" . $nomor . "'";
        $res = __dbRow($cmd);

        return __json($res);
    }

    public function get_nopolis()
    {
        extract($_GET);
        $tambah = "";
        $_GET['msoc'] = $msoc;
        $cek = substr($_GET['msoc'], 0, 4);
        $cek2 = substr($_GET['msoc'], 0, 5);

        $resmsoc = "SELECT msoc_mjns_kode mjns FROM eopr.mst_soc WHERE msoc_kode='" . $_GET['msoc'] . "'";
        $resjns = __dbRow($resmsoc);
        // return __json($resjns);

        if ($cek == 'EDS.') {
            $msoc = substr($_GET['msoc'], 4, 2);
        }
        if ($cek2 == 'EDS1.' || $cek2 == 'EDS2.' || $cek2 == 'EDS3.') {
            $msoc = substr($_GET['msoc'], 5, 2);
        }
        if (isset($pmgpolis)) {
            if (!empty($pmgpolis)) {
                $tambah .= "and mpli_mrkn_kode='" . $pmgpolis . "'";
            }
        }
        if (isset($nopolis)) {
            if (!empty($nopolis)) {
                $tambah .= "and mpli_nomor='" . $nopolis . "'";
            }
        }
        if (isset($mekanisme)) {
            if (!empty($mekanisme)) {
                $tambah .= "and mpol_mekanisme='" . $mekanisme . "'";
            }
        }
        if (isset($jns_bayar)) {
            if (!empty($jns_bayar)) {
                $tambah .= "and mpol_jenis_bayar='" . str_replace(".", "", $jns_bayar) . "'";
            }
        }
        if (isset($mrkn_nama)) {
            if (!empty($mrkn_nama) && empty($pmgpolis)) {
                $tambah .= "and mpli_mrkn_nama='" . $mrkn_nama . "' ";
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
        WHERE 1=1 and mpli_mjns_kode='" . $resjns['mjns'] . "' and mpli_status_endos in (0,1,2) " . $tambah . " ";
        $res = __dbRow($cmd);

        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd = " select '' mpol_nomor, '' mpli_kode ";
            $res = __dbRow($cmd);
            return __json($res);
        }
    }

    public function get_ket_soc()
    {
        extract($_GET);
        $tambah = "";
        $judul = $_GET['msoc'];
        if (isset($_GET['pmgpolis'])) {
            if ($_GET['pmgpolis'] != "") {
                $tambah .= " and msli_mrkn_kode='" . $_GET['pmgpolis'] . "'";
            }
        }
        if ((trim($judul)) == "3") {
            if ($_GET['msoc'] != "") {
                $tambah .= " and msoc_kode='" . str_replace("EDS.", "", $_GET['msoc']) . "'";
            }
        } else {
            $tambah .= " and msoc_kode='" . str_replace(".C.2", "", $_GET['msoc']) . "'";
        }
        if (isset($_GET['nopolis'])) {
            if ($_GET['nopolis'] != "") {
                $tambah .= " and msli_nomor='" . $_GET['nopolis'] . "'";
            }
        }
        if (isset($_GET['nasabah'])) {
            if ($_GET['nasabah'] != "") {
                $tambah .= " and msli_mjns_kode='" . $_GET['nasabah'] . "'";
            }
        }
        if (isset($_GET['mrkn_nama'])) {
            if ($_GET['mrkn_nama'] != "" && $_GET['pmgpolis'] == "") {
                $tambah .= " and msli_mrkn_nama='" . $_GET['mrkn_nama'] . "'";
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
        if ($_GET['id'] == "mpol_kode") {
            $tambah = "";
            $judul = $_GET['judul'];

            $cek = substr($_GET['kdsoc'], 0, 4);
            $cek2 = substr($_GET['kdsoc'], 0, 5);
            $len = "select LENGTH('" . $_GET['kdsoc'] . "') len";

            $rlen = __dbrow($len);

            $msoc = substr($_GET['kdsoc'], 0, 25);

            if ($judul == '3') {
                if ($cek == 'EDS.') {
                    $msoc = substr($_GET['kdsoc'], 4, 21);
                }
                if ($cek2 == 'EDS1.' || $cek2 == 'EDS2.' || $cek2 == 'EDS3.') {
                    if ($rlen['len'] != '23') {
                        $msoc = substr($_GET['kdsoc'], 5, 21);
                    } else {
                        $msoc = substr($_GET['kdsoc'], 5, 21);
                    }
                }
                if ($cek2 == 'EDS1.' || $cek2 == 'EDS2.' || $cek2 == 'EDS3.') {
                    $msoc2 = str_replace('EDS1.', "EDS.", $_GET['kdsoc']);
                }

                if ($cek2 == 'EDS2.') {
                    $msoc2 = str_replace('EDS2.', "EDS1.", $_GET['kdsoc']);
                }
                if ($cek2 == 'EDS3.') {
                    $msoc2 = str_replace('EDS3.', "EDS2.", $_GET['kdsoc']);
                }
            }
            $msoc2 = $msoc;
            $socxx = "";
            $socx = "";
            if ($cek2 == 'EDS1.') {
                $socxx = str_replace('EDS1', 'EDS', $_GET['kdsoc']);
                $socx = str_replace('EDS1.', '', $_GET['kdsoc']);
            } else if ($cek2 == 'EDS2.') {
                $socx = str_replace('EDS2', 'EDS1', $_GET['kdsoc']);
            } else if ($cek2 == 'EDS3.') {
                $socx = str_replace('EDS3', 'EDS2', $_GET['kdsoc']);
            } else if ($cek2 == 'EDS4.') {
                $socx = str_replace('EDS4', 'EDS3', $_GET['kdsoc']);
            } else if ($cek2 == 'EDS5.') {
                $socx = str_replace('EDS5', 'EDS4', $_GET['kdsoc']);
            } else if ($cek2 == 'EDS6.') {
                $socx = str_replace('EDS6', 'EDS5', $_GET['kdsoc']);
            } else if ($cek2 == 'EDS7.') {
                $socx = str_replace('EDS7', 'EDS6', $_GET['kdsoc']);
            } else if ($cek2 == 'EDS8.') {
                $socx = str_replace('EDS8', 'EDS7', $_GET['kdsoc']);
            }

            $tambah .= " and (mpol_msoc_kode='" . str_replace(".C.2", "", $socx) . "' OR mpol_msoc_kode='" . str_replace(".C.2", "", $socxx) . "')";

            if (isset($_GET['pmgpolis'])) {
                if ($_GET['pmgpolis'] != "") {
                    $tambah .= " and mpol_mrkn_kode='" . $_GET['pmgpolis'] . "'";
                }
            }

            if (isset($_GET['mrkn_nama'])) {
                if ($_GET['mrkn_nama'] != "" && $_GET['pmgpolis'] == "") {
                    $tambah .= " and mpol_mrkn_nama='" . $_GET['mrkn_nama'] . "'";
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
            WHERE 1=1 AND mpol_endos!='3' " . $tambah . ")
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
            WHERE 1=1 and mpol_endos!='3' and mpol_msoc_kode='" . $_GET['kdsoc'] . "' and mpol_mrkn_kode='" . $_GET['pmgpolis'] . "')";
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

    public function get_kodesocdtluw()
    {
        extract($_GET);
        $tambah = "";

        $cmd = "
        SELECT
            msotd_pk,
            mpuw_nama e_uw,
            msotd_mujh_persen,
            msotd_mdr_persen,
            msotd_mfee_persen,
            msotd_status,
            msotd_berlaku,
            date_format(msotd_tgl1,'%d-%m-%Y') msotd_tgl1,
            date_format(msotd_tgl2,'%d-%m-%Y') msotd_tgl2,
            msotd_ketentuan,
            mth_ket e_tarif,
            msotd_mth_nomor,
            msotd_mpuw_nomor,
            msotd_tipe,
            msotd_jenis_tarif,
            msotd_tipe_uw

        FROM eopr.mst_soc_tarifuw_dtl
        LEFT JOIN emst.mst_tarif on mth_nomor  = msotd_mth_nomor
        LEFT JOIN emst.mst_polis_uwtable ON mpuw_nomor=msotd_mpuw_nomor
        WHERE 1=1
        AND msotd_status='0'
        AND msotd_tipe='" . $tipe . "'
        AND msotd_msoc_kode='" . $msoc . "'
        AND msotd_mlok_kode='" . $mlok . "'
        " . $tambah . "";

        $res = __dbRow($cmd);

        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd = "
            SELECT '' msotd_pk, '' msotd_mth_nomor";
            $res = __dbRow($cmd);
            return __json($res);
        }
    }

    public function get_kodesockode()
    {
        extract($_GET);

        $tambah = "";

        $tambah .= " and msoc_kode='" . $_GET['kodepolis'] . "'";
        $cmd = "
        SELECT
            msoc_nomor,
            msoc_kode,
            msoc_kode kode_xsoc,
            msoc_mrkn_nama nm_polis,
            mjns.mjns_Keterangan e_nasabah,
            mssp.mssp_nama e_segmen,
            msoc_mspaj_nama,
            msoc_mspaj_nomor,
            mft.mft_nama msoc_mft_kode,
            jmn.mjm_nama e_manfaat,
            mpid.mpid_nama e_produk,
            pras.mpras_nama e_pras,
            mslr.mslr_ket msoc_mslr_kode,
            lok.mlok_nama e_cabalamin,
            mkr.skar_nama e_marketingsoc,
            mkr.skar_nama e_marketing,
            pnc.skar_nama e_pinca,
            msoc_mujh_persen,
            msoc_mmfe_persen,
            msoc_overreding,
            msoc_mfee_persen,
            msoc_mkom_persen,
            msoc_mdr_kode,
            msoc_referal,
            msoc_maintenance,
            msoc_no_endors,
            msoc_ket_endors,
            mth.mth_ket e_tarif,
            msoc_mth_nomor,
            msoc_tipe_uw,
            msoc_jns_perusahaan,
            msoc_mpuw_nomor,
            mpuw.mpuw_nama e_uw,
            msoc_mkar_kode_mkr,
            msoc_mkar_kode_pim,
            msoc_mjm_kode,
            msoc_mrkn_kode,
            msoc_mlok_kode,
            msoc_mpras_kode,
            msoc_mspaj_nomor,
            msoc_mjns_kode,
            msoc_mft_kode,
            msoc_mpid_kode,
            msoc_mslr_kode,
            msoc_mssp_kode,
            mssp_nama e_segmen,
            msoc_mekanisme,
            msoc_handlingfee,
            msoc_handlingfee2,
            msoc_pajakfee
        FROM eopr.mst_soc
        LEFT JOIN emst.mst_tarif mth ON mth.mth_nomor=msoc_mth_nomor
        LEFT JOIN emst.mst_polis_uwtable mpuw ON mpuw.mpuw_nomor=msoc_mpuw_nomor
        LEFT JOIN emst.mst_polis_uwtable uw ON uw.mpuw_nomor=msoc_mpuw_nomor
        LEFT JOIN emst.mst_jaminan jmn ON jmn.mjm_kode=msoc_mjm_kode
        LEFT JOIN emst.mst_rekanan rkn ON rkn.mrkn_kode=msoc_mrkn_kode
        LEFT JOIN emst.mst_lokasi lok  ON lok.mlok_kode=msoc_mlok_kode
        LEFT JOIN esdm.sdm_karyawan_new pnc ON pnc.skar_pk=msoc_mkar_kode_pim
        LEFT JOIN esdm.sdm_karyawan_new mkr ON mkr.skar_pk=msoc_mkar_kode_mkr
        LEFT JOIN emst.mst_tarif trf ON trf.mth_nomor=msoc_mth_nomor
        LEFT JOIN eopr.mst_spaj_polis spaj ON spaj.mspaj_nomor=msoc_mspaj_nomor
        LEFT JOIN emst.mst_program_asuransi pras ON pras.mpras_kode=msoc_mpras_kode
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=msoc_mjns_kode
        LEFT JOIN emst.mst_produk_segment mssp ON mssp.mssp_kode=msoc_mssp_kode
        LEFT JOIN emst.mst_manfaat_plafond mft ON mft.mft_kode=msoc_mft_kode
        LEFT JOIN emst.mst_produk_induk mpid ON mpid.mpid_kode=msoc_mpid_kode
        LEFT JOIN emst.mst_saluran_distribusi mslr ON mslr.mslr_kode=msoc_mslr_kode
        WHERE 1=1 AND msoc_endos IN (0,1,2)
        " . $tambah . "";
        $res = __dbRow($cmd);

        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd = "
            SELECT
            ''  nm_polis,
            ''  msoc_jns_perusahaan,
            ''  e_nasabah,
            ''  msoc_mssp_nama,
            ''  msoc_mspaj_nama,
            ''  msoc_mspaj_nomor,
            ''  msoc_mft_kode,
            ''  e_manfaat,
            ''  e_produk,
            ''  e_pras,
            ''  msoc_mslr_kode,
            ''  e_cabalamin,
            ''  e_marketingsoc,
            ''  e_pinca,
            ''  msoc_mujh_persen,
            ''  msoc_mmfe_persen,
            ''  msoc_overreding,
            ''  msoc_mfee_persen,
            ''  msoc_mkom_persen,
            ''  msoc_mdr_kode,
            ''  msoc_no_endors,
            ''  msoc_ket_endors
            ";
            $res = __dbRow($cmd);
            return __json($res);
        }
    }

    public function get_kodesockodeapprov()
    {
        extract($_GET);

        $tambah = "";

        $tambah .= "and msoc_nomor='" . $_GET['kodepolis'] . "'";
        $cmd = "
        SELECT
        msoc_nomor,
        msoc_kode
        FROM eopr.mst_soc
        LEFT JOIN eopr.mst_polis msoc ON msoc.mpol_msoc_kode=msoc_kode
        WHERE 1=1 " . $tambah . "";
        $res = __dbRow($cmd);
        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd = "
            SELECT
            '' msoc_nomor,
            '' msoc_kode
            FROM eopr.mst_soc
            LEFT JOIN eopr.mst_polis msoc ON msoc.mpol_msoc_kode=msoc_kode
            WHERE 1=1";
            $res = __dbRow($cmd);
            return __json($res);
        }
    }

    public function get_polisfull2()
    {
        extract($_GET);
        $group = __getgroup();
        $tambah = "";

        $tambah .= "and mpol_kode='" . $_GET['kode'] . "'";
        $cmd = "
        SELECT
            '' mpol_approv_ketusreas,
            mpol_status_polis,
            mpol_surplus,
            mpol_handlingfee,
            mpol_kode,
            mpol_penerima_manfaat,
            mpol_nomor,
            mpol_jl,
            mpol_jl_pst,
            mpol_jl_pasangan,
            mpol_lapor_data,
            mpol_byr_premi,
            mpol_no_endors,
            mpol_file_polis,
            mpol_mspaj_nomor,
            mpol_mrkn_kode,
            mpol_produkbank,
            mpol_mprov_kode,
            mpid.mpid_nama e_jenisprrod,
            jenprod.mpid_nama jenprod,
            mpol_mjm_kode,
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
            mpol_mft_kode,
            mpol_mnfa_kode,
            mpol_mujh_persen,
            mpol_mmfe_persen,
            mpol_mfee_persen,
            mpol_mkom_persen,
            mpol_overreding,
            mpol_tgl_terbit,
            mpol_tgl_awal_polis,
            mpol_tgl_ahir_polis,
            #date_format(mpol_tgl_terbit,'%d-%m-%Y') mpol_tgl_terbit,
            #date_format(mpol_tgl_awal_polis,'%d-%m-%Y') mpol_tgl_awal_polis,
            #date_format(mpol_tgl_ahir_polis,'%d-%m-%Y') mpol_tgl_ahir_polis,
            mpol_endors,
            mpol_mkar_kode_pim,
            mpol_mkar_kode_mkr,
            mpol_mlok_kode,
            mpol_mth_nomor,
            mpol_mssp_kode,
            mpol_mrpm_nomor,
            mjns.mjns_Keterangan e_nasabah2,
            mpol_ket_endors,
            mpol_msrf_kode,
            mpol_mpuw_nomor,
            mpol_mujhrf_kode,
            mpol_mdr_kode,
            mpol_max_pst,
            mpol_kadaluarsa_klaim,
            pras.mpras_nama e_pras2,
            if(ifnull(mpol_mrkn_nama,'')='',mrkn_nama,mpol_mrkn_nama)  mpol_mrkn_nama,
            mpol_mut_kode,
            mjm_bundling,
            mjm_jiwa,
            mpol_openpolis,
            mjm_gu,
            mjm_phk,
            mjm_tlo,
            mjm_fire,
            mjm_wp,
            mjm_umut,
            mpol_mmft_kode_phk_pensiun,
            mpol_mmft_kode_wp_pensiun,
            mpol_penerima_manfaat,
            mpol_aprove_fc,
            mpol_jenis_cetak,
            mlok_nama e_cabalamin2,
            pnc.skar_nama e_pinca,
            mkr.skar_nama e_marketing,
            uw.mpuw_nama e_uw,
            trf.mth_ket e_tarif,
            mpol_mssp_nama,
            mpol_msoc_kode,
            mpol_max_bayar_klaim,
            mpol_lapor_stnc,
            mpol_penerima_manfaat,
            spaj.mspaj_mrkn_nama mpol_mspaj_nama,
            pras.mpras_nama e_pras,
            jmn.mjm_nama e_manfaat2,
            '' mpol_jns_ketusreas1,
            '' mpol_jns_ketusreas2,
            '' mpol_mrea_kode1,
            '' mpol_mrea_kode2,
            '' mpol_tgl_ketusreas1,
            '' mpol_tgl_ketusreas2,
            mpol_jenis_login,
            ''  mpol_nilai_ketusreas1,
            ''  mpol_nilai_ketusreas2,
            ''  mpol_note_ketusreas
        FROM eopr.mst_polis
        LEFT JOIN emst.mst_produk_induk mpid ON mpid.mpid_kode=mpol_mpid_kode
        left join emst.mst_produk_induk jenprod ON jenprod.mpid_kode=mpol_mpid_kode
        LEFT JOIN emst.mst_jenis_nasabah mjns ON mjns.mjns_kode=mpol_mjns_kode
        LEFT JOIN emst.mst_polis_uwtable uw on uw.mpuw_nomor=mpol_mpuw_nomor
        LEFT JOIN emst.mst_jaminan jmn on jmn.mjm_kode=mpol_mjm_kode
        left join emst.mst_rekanan rkn on rkn.mrkn_kode=mpol_mrkn_kode
        LEFT JOIN emst.mst_lokasi lok  on lok.mlok_kode=mpol_mlok_kode
        LEFT JOIN esdm.sdm_karyawan pnc on pnc.skar_nip=mpol_mkar_kode_pim
        LEFT JOIN esdm.sdm_karyawan mkr on mkr.skar_nip=mpol_mkar_kode_mkr
        LEFT JOIN emst.mst_tarif trf on trf.mth_nomor=mpol_mth_nomor
        LEFT JOIN eopr.mst_spaj_polis spaj on spaj.mspaj_nomor=mpol_mspaj_nomor
        LEFT JOIN emst.mst_program_asuransi pras on pras.mpras_kode=mpol_mpras_kode
        WHERE 1=1 " . $tambah . "";
        $res = __dbRow($cmd);

        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd = "
            SELECT
            '' mpol_approv_ketusreas,
            ''  mpol_surplus,
            '0' mpol_handlingfee,
            ''  mpol_kode,
            ''  mpol_penerima_manfaat,
            ''  mpol_nomor,
            ''  mpol_jl,
            '' mpol_produkbank,
            ''  mpol_jl_pst,
            '' mpol_jl_pasangan,
            ''  jenprod,
            '-'  mpol_no_endors,
            '0'  mpol_lapor_data,
            '0'  mpol_byr_premi,
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
            '0' mpol_mujh_persen,
            '0' mpol_mmfe_persen,
            '0' mpol_mfee_persen,
            '0' mpol_mkom_persen,
            '0' mpol_overreding,
            ''  mpol_endors,
            ''  mpol_mth_nomor,
            ''  mpol_mrpm_nomor,
            ''  mpol_ket_endors,
            ''  mpol_msrf_kode,
            ''  mpol_mpuw_nomor,
            ''  mpol_mujhrf_kode,
            ''  mpol_mdr_kode,
            '0' mpol_kadaluarsa_klaim,
            '0'  mpol_mut_kode,
            ''   e_tarif,
            ''   e_uw,
            '1' mpol_openpolis,
            ''  mpol_mssp_kode,
            ''  mpol_mlok_kode,
            ''  mpol_mkar_kode_mkr,
            ''  mpol_mprov_kode,
            '30'mpol_lapor_data,
            '30'mpol_byr_premi,
            date_format(curdate(),'%d-%m-%Y')  mpol_tgl_terbit,
            date_format(curdate(),'%d-%m-%Y')  mpol_tgl_awal_polis,
            date_format(curdate(),'%d-%m-%Y')  mpol_tgl_ahir_polis,
            '100'mpol_max_pst,
            ''   mpol_mkar_kode_pim,
            ''   mpol_mprov_tipe,
            ''   e_cabalamin,
            ''   e_pinca,
            ''   e_marketing,
            ''   mpol_mssp_nama,
            ''   mpol_file_polis";
            $res = __dbRow($cmd);
            return __json($res);
        }
    }

    public function get_kodepoliskodeapprov()
    {
        extract($_GET);
        $group = __getgroup();
        $tambah = "";

        $tambah .= "and mpol_nomor='" . $_GET['kodepolis'] . "'";
        $cmd = "
        SELECT
            mpol_nomor,
            mpol_msoc_kode msoc_kode,
            msoc_nomor
            FROM eopr.mst_polis
        LEFT JOIN eopr.mst_soc ON msoc_kode=mpol_msoc_kode
        WHERE 1=1 " . $tambah . "";
        $res = __dbRow($cmd);
        if (!empty($res)) {
            return __json($res);
        } else {
            $cmd = "
            SELECT
            '' mpol_nomor,
            '' msoc_kode,
            '' msoc_nomor";
            $res = __dbRow($cmd);
            return __json($res);
        }
    }
}
