<?php

namespace App\Http\Controllers\Keuangan\LampiranJurnalPembayaran;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class LampiranKlaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keuangan.lampiran-jurnal-pembayaran.lampiran-klaim.index');
    }

    public function lodLampiranKlaim(Request $request)
    {
        $cmd = DB::select("SELECT pst.tpprd_pk,
            klm.tpprd_klm_pk ,
            klm.tpprd_klm_pk tpprd_klm_pk_b,
            klm.tpprd_klm_pk tpprd_klm_pk_c,
            pst.tpprd_nomor_peserta ,
            pst.tpprd_nama ,
            pst.tpprd_medical,
            pst.tpprd_medical1,
            pst.tpprd_medical2,
            pst.tpprd_mlok_kode,
            pst.tpprd_mjm_kode,
            pst.tpprd_mjns_kode,
            pst.tpprd_mslr_kode,
            pst.tpprd_mssp_kode,
            pst.tpprd_mpras_kode,
            pst.tpprd_mjm_kode,
            pst.tpprd_mft_kode,
            pst.tpprd_mpid_kode,
            pst.tpprd_mpli_urut,
            pst.tpprd_polis_tahun ,
            pst.tpprd_polis_bulan ,
            pst.tpprd_mprov_kode,
            pst.tpprd_mrkn_kode,
            FORMAT(pst.tpprd_up,2) tpprd_up,
            FORMAT(pst.tpprd_premi,2) tpprd_premi,
            FORMAT(pst.tpprd_premi_bayar,2) tpprd_premi_bayar,
            FORMAT( ((pst.tpprd_ujroh_persen/100) * pst.tpprd_premi),2) tpprd_ujroh,
            FORMAT( (((100-pst.tpprd_ujroh_persen)/100) * pst.tpprd_premi),2) premi_tabbaru,
            FORMAT(pst.tpprd_total_bayar,2) tpprd_total_bayar,
            pst.tpprd_admin tpprd_admin,
            pst.tpprd_masa_bulan ,
            pst.tpprd_nomor_polish ,
            DATE_FORMAT(pst.tpprd_tanggal_awal,'%d-%m-%Y') tpprd_tanggal_awal,
            DATE_FORMAT(pst.tpprd_tanggal_akhir,'%d-%m-%Y') tpprd_tanggal_akhir,
            DATE_FORMAT(pst.tpprd_date_input,'%d-%m-%Y')  tpprd_date_input,
            DATE_FORMAT(pst.tpprd_tanggal_bayar,'%d-%m-%Y')  tpprd_tanggal_bayar,
            pst.tpprd_status_bayar,
            0  tpprd_total_refund,
            pst.tpprd_status_bayar,
            DATEDIFF('2016-08-30' ,'2016-07-31' ) tmp_exp_premi,
            IF(pst.tpprd_status_bayar='0','Kontrib Kosong', IF(DATEDIFF('2016-08-30' ,'2016-07-31')>30,'Expired','Liable')) sts_exp_prm,
            pst.tpprd_status_refund,
            pst.tpprd_status_klaim,
            pst.tpprd_status_batal,
            pst.tpprd_status_laps,
            mpol_kadaluarsa_klaim,
            klm.tpprd_jenis_klaim,
            mklr_nama e_resikoklm,
            klm.tpprd_tgl_terjadi,
            klm.tpprd_tgl_terima_dok,
            tpprd_sts_file,
            IF(klm.tpprd_sts_file='1','LENGKAP','TIDAK LENGKAP')  xtpprd_sts_file,
            '' tpprd_life_spk_file,
            klm.tpprd_life_spk_sts,
            '' tpprd_life_form_file,
            klm.tpprd_life_form_sts,
            '' tpprd_life_ktp_file,
            klm.tpprd_life_ktp_sts,
            '' tpprd_life_ktpwaris_file,
            klm.tpprd_life_ktpwaris_sts,
            '' tpprd_life_kk_file,
            klm.tpprd_life_kk_sts,
            '' tpprd_life_rekbiaya_file,
            klm.tpprd_life_rekbiaya_sts,
            '' tpprd_life_smati_file,
            klm.tpprd_life_smati_sts,
            '' tpprd_life_sketwaris_file,
            klm.tpprd_life_sketwaris_sts,
            '' tpprd_life_sketpolis_file,
            klm.tpprd_life_sketpolis_sts,
            '' tpprd_life_shukum_file,
            klm.tpprd_life_shukum_sts,
            '' tpprd_life_dubes_file,
            klm.tpprd_life_dubes_sts,
            '' tpprd_life_buktiobat_file,
            klm.tpprd_life_buktiobat_sts,
            '' tpprd_life_ketdokter_file,
            klm.tpprd_life_ketdokter_sts,
            '' tpprd_phk_skpeg_file,
            klm.tpprd_phk_skpeg_sts,
            '' tpprd_phk_skphk_file,
            klm.tpprd_phk_skphk_sts,
            '' tpprd_phk_sp_file,
            klm.tpprd_phk_sp_sts,
            '' tpprd_phk_kemen_file,
            klm.tpprd_phk_kemen_sts,
            klm.tpprd_phk_kuasagaji_file,
            klm.tpprd_phk_kuasagaji_sts,
            klm.tpprd_phk_perush,
            klm.tpprd_wp_kolektibke,
            klm.tpprd_wp_kolektibitas,
            klm.tpprd_wp_akadpemb_file,
            klm.tpprd_wp_akadpemb_sts,
            klm.tpprd_wp_dokbank_file,
            klm.tpprd_wp_dokbank_sts,
            klm.tpprd_wp_bicheck_file,
            klm.tpprd_wp_bicheck_sts,
            klm.tpprd_wp_spbank_file,
            klm.tpprd_wp_spbank_sts,
            klm.tpprd_wp_tgl_sp1,
            klm.tpprd_wp_tgl_sp2,
            klm.tpprd_wp_kuasagaji_file,
            klm.tpprd_wp_kuasagaji_sts,
            klm.tpprd_wp_subrogasi,
            klm.tpprd_wp_subrogasi_rp,
            klm.tpprd_wp_jenis_usaha,
            klm.tpprd_wp_umur_usaha,
            klm.tpprd_gu_beritaacara_file,
            klm.tpprd_gu_beritaacara_sts,
            klm.tpprd_gu_ketpolisi_file,
            klm.tpprd_gu_ketpolisi_sts,
            klm.tpprd_gu_fotorusak_file,
            klm.tpprd_gu_fotorusak_sts,
            klm.tpprd_gu_okupasi,
            klm.tpprd_gu_sekitas,
            klm.tpprd_gu_rp_angsuran,
            klm.tpprd_gu_jenis_usaha,
            klm.tpprd_gu_penyebab,
            klm.tpprd_fire_imb_file,
            klm.tpprd_fire_imb_sts,
            klm.tpprd_fire_imb_rp,
            klm.tpprd_fire_doklain_file,
            klm.tpprd_fire_doklain_sts,
            klm.tpprd_kronologi,
            klm.tpprd_sts_pt,
            klm.tpprd_sts_reas,
            klm.tpprd_pengajuan_rp,
            klm.tpprd_sisa_pinjaman,
            klm.tpprd_tunggakan_margin,
            klm.tpprd_denda,
            klm.tpprd_kewajiban_bea,
            klm.tpprd_cair_jiwa,
            IFNULL(klm.tpprd_cair_join_persen,0) tpprd_cair_join_persen,
            klm.tpprd_cair_join_rp,
            IFNULL(klm.tpprd_cair_obat_persen,0) tpprd_cair_obat_persen,
            klm.tpprd_cair_obat_rp,
            IFNULL(klm.tpprd_cair_cacat_persen,0)tpprd_cair_cacat_persen,
            klm.tpprd_cair_cacat_rp,
            klm.tpprd_cair_paa_rp,
            IFNULL(klm.tpprd_share_phk_persen,0) tpprd_share_phk_persen,
            klm.tpprd_share_phk_rp,
            IFNULL(klm.tpprd_share_wp_persen,0)  tpprd_share_wp_persen,
            klm.tpprd_share_wp_rp,
            klm.tpprd_klm_cair_gu_kelipatan,
            klm.tpprd_cair_gu_rp,
            klm.tpprd_cair_fire_rp,
            klm.tpprd_jenis_setuju,
            klm.tpprd_rek_bayar,
            klm.tpprd_rek_anama,
            mklr_nama e_resikoklm,
            DATE_FORMAT(klm.tpprd_tgl_terjadi,'%d-%m-%Y')  tpprd_tgl_terjadi,
            DATE_FORMAT(klm.tpprd_tgl_terima_dok,'%d-%m-%Y')  tpprd_tgl_terima_dok,
            DATE_FORMAT(klm.tpprd_wp_tgl_sp1,'%d-%m-%Y')  tpprd_wp_tgl_sp1,
            DATE_FORMAT(klm.tpprd_wp_tgl_sp2,'%d-%m-%Y')  tpprd_wp_tgl_sp2,
            cb.mrkn_nama e_cabrekanan,
            cb.mrkn_mrkn_kode_induk mpol_mrkn_kode,
            ps.mrkn_nama e_rekanan,
            mjm_nama e_manfaat,

            '' tprea_jiware1_share,
            '' tprea_jiware2_share,
            '' tprea_phk_shar,
            'PHK' e_phk,
            '' tprea_gu_shar,
            'GU' e_gu,
            '' tprea_wpphk_shar,
            'WP PHK' e_wpphk,
            '' tprea_wpgu_shar,
            'WP GU' e_wpgu,
            '' tprea_fire_shar,
            'FIRE' e_fire,
            '' tprea_tlo_shar,
            'TLO' e_tlo,
            '' tprea_nonlife,
            mpol_kadaluarsa_klaim,
            format(tpprd_klaim_netto,2) tpprd_klaim_netto,

            kpt.uset_value1 e_sts_klaimpt,
            kre.uset_value1 e_sts_klaimreas,
            kep01.uset_value1 klm_putusan01,
            kep02.uset_value1 klm_putusan02,
            kep1.uset_value1 klm_putusan1,
            kep2.uset_value1 klm_putusan2,
            kep3.uset_value1 klm_putusan3,
            klm.tpprd_approv01,
            klm.tpprd_approv02,
            klm.tpprd_approv1,
            klm.tpprd_approv2,
            klm.tpprd_approv3,
            mjns_Keterangan ,
            if(ps.mrkn_kode=cb.mrkn_kode,ps.mrkn_nama,concat(ps.mrkn_nama,' ',cb.mrkn_nama)) e_nmrekan

            FROM eklm.peserta_klaim klm
            LEFT JOIN eklm.peserta_all pst ON klm.tpprd_pk=pst.tpprd_pk
            LEFT JOIN emst.mst_jaminan ON pst.tpprd_mjm_kode=mjm_kode
            LEFT JOIN emst.mst_lokasi ON pst.tpprd_mlok_kode=mlok_kode
            LEFT JOIN emst.mst_provinsi ON pst.tpprd_mprov_kode=mprov_kode
            LEFT JOIN emst.mst_okupasi ON pst.tpprd_moku_kode=moku_kode
            LEFT JOIN emst.mst_rekanan cb ON pst.tpprd_mrkn_kode=cb.mrkn_kode
            LEFT JOIN emst.mst_rekanan ps ON cb.mrkn_mrkn_kode_induk=ps.mrkn_kode
            LEFT JOIN emst.mst_program_asuransi ON pst.tpprd_mpras_kode=mpras_kode
            LEFT JOIN emst.mst_jenis_nasabah ON pst.tpprd_mjns_kode=mjns_kode

            LEFT JOIN eopr.mst_polis ON pst.tpprd_nomor_polish=mpol_kode
            LEFT JOIN emst.mst_klaim_resiko ON klm.tpprd_jenis_klaim = mklr_kode
            LEFT JOIN emst.uti_setting kpt ON tpprd_sts_pt = kpt.uset_kode AND kpt.uset_modul='KLMPT'
            LEFT JOIN emst.uti_setting kre ON tpprd_sts_reas = kre.uset_kode AND kre.uset_modul='KLMREAS'
            LEFT JOIN emst.uti_setting kep01 ON tpprd_approv01 = kep01.uset_kode AND kep01.uset_modul='KLMKEPT'
            LEFT JOIN emst.uti_setting kep02 ON tpprd_approv02 = kep02.uset_kode AND kep02.uset_modul='KLMKEPT'
            LEFT JOIN emst.uti_setting kep1 ON tpprd_approv1 = kep1.uset_kode AND kep1.uset_modul='KLMKEPT'
            LEFT JOIN emst.uti_setting kep2 ON tpprd_approv2 = kep2.uset_kode AND kep2.uset_modul='KLMKEPT'
            LEFT JOIN emst.uti_setting kep3 ON tpprd_approv3 = kep3.uset_kode AND kep3.uset_modul='KLMKEPT'
            WHERE (klm.tpprd_mlam_nomor IS NULL OR klm.tpprd_mlam_nomor='') AND 1=1
            LIMIT ".$request['e_baris']." ");

        $res = Lib::__dbAll($cmd);

        return DataTables::of($res)
        ->addIndexColumn()
        ->filter (function ($instance) use ($request) {
            // if (!empty($request->get('search'))) {
            //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //         if (Str::contains(Str::lower($row['nama']), Str::lower($request->get('search')))){
            //             return true;
            //         }else if (Str::contains(Str::lower($row['cabang']), Str::lower($request->get('search')))) {
            //             return true;
            //         }

            //         return false;
            //     });
            // }
        })
        ->make(true);
    }
}
