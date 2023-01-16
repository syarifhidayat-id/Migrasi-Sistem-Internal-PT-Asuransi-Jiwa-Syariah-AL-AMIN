<?php

namespace App\Models\Sdm;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pegawai extends Model
{
    use HasFactory;

    public
        $primaryKey = 'skar_pk', // setup primaryKey
        // $primaryKey = 'mpol_kode',
        $incrementing = false, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        $connection = 'esdm',
        $table = 'sdm_karyawan_new',
        $fillable = [
            'skar_pk',
            'skar_anggota_kopkar',
            'skar_nip',
            'skar_nip_lama',
            'skar_pin',
            'skar_maga_id',
            'skar_nama',
            'skar_warganegara',
            'skar_kelamin',
            'skar_nama_alias',
            'skar_gelar',
            'skar_sdiv_pk',
            'skar_sbag_pk',
            'skar_sdir_kode',
            'skar_mlok_kode',
            'skar_mlok_kode_dinas',
            'skar_tanggal_lahir',
            'skar_tmp_lahir',
            'skar_tanggal_masuk',
            'skar_periode_tahun',
            'skar_periode_bulan',
            'skar_tglawal_kontrak1',
            'skar_tglakhir_kontrak1',
            'skar_tglawal_kontrak2',
            'skar_tglakhir_kontrak2',
            'skar_slv_kode',
            'skar_sjab_kode',
            'skar_alamat1',
            'skar_alamat2',
            'skar_no_kontak',
            'skar_no_wa',
            'skar_facebook',
            'skar_spaj_kode',
            'skar_bpjs_kerja',
            'skar_bpjs_sehat',
            'skar_ibu_kandung',
            'skar_npwp',
            'skar_npwp_tanggal',
            'skar_no_identitas',
            'skar_status_kawin',
            'skar_noserti_agen',
            'skar_penerbit',
            'skar_ket',
            'skar_spen_kode',
            'skar_lembaga_pendidikan',
            'skar_status_kary',
            'skar_end_kerja',
            'skar_end_kontrak',
            'skar_rek_nomor',
            'skar_rek_nama',
            'skar_rek_bank',
            'skar_rek_bank_cab',
            'skar_sk_nomor',
            'skar_jamsostek_nomor',
            'skar_referensi_tipe',
            'skar_referensi_nama',
            'skar_gaji_pokok',
            'skar_gaji_pokok_e',
            'skar_tunj_pondok',
            'skar_tunj_pondok_e',
            'skar_tunj_komunikasi',
            'skar_tunj_komunikasi_e',
            'skar_tunj_jabatan',
            'skar_tunj_jabatan_e',
            'skar_tunj_ahli',
            'skar_tunj_ahli_e',
            'skar_tunj_jamsosrum',
            'skar_tunj_jamsosrum_e',
            'skar_tunj_lainmahal',
            'skar_tunj_lainmahal_e',
            'skar_tunj_fungsi',
            'skar_tunj_fungsi_e',
            'skar_tunj_pajak',
            'skar_tunj_pajak_e',
            'skar_pensiunan',
            'skar_ktp',
            'skar_gam_ktp',
            'skar_kk',
            'skar_gam_kk',
            'skar_ijazah',
            'skar_gam_ijazah',
            'skar_biodata',
            'skar_gam_biodata',
            'skar_psikotes',
            'skar_gam_psikotes',
            'skar_sim',
            'skar_gam_sim',
            'skar_nikah',
            'skar_gam_nikah',
            'skar_foto',
            'skar_gam_foto',
            'skar_rekening',
            'skar_gam_rekening',
            'skar_npwpe',
            'skar_gam_npwp',
            'skar_ttd',
            'skar_gam_ttd',
            'skar_pot_lain',
            'skar_pot_transport',
            'skar_pot_zakat',
            'skar_pot_aamai',
            'skar_pot_pajak',
            'skar_pot_jht',
            'skar_pot_pensiun',
            'skar_pot_kesehatan',
            'skar_pot_kopkar',
            'skar_kop_wajib',
            'skar_kop_pokok',
            'skar_kop_sukarela',
            'skar_rp_pinjam',
            'skar_kop_masa',
            'skar_kop_mulai',
            'skar_kop_akhir',
            'skar_rp_nisbah',
            'skar_kop_status',
            'skar_rekomendasi',
            'skar_bonus_1',
            'skar_bonus_2',
            'skar_bonus_3',
            'skar_uang_pisah',
            'skar_indexfolder',
            'skar_user_input',
            'skar_user_update',
            'skar_date_input',
            'skar_date_update',
            'skar_hapus',
            'skar_email_login',
            'skar_hp_login',
            'skar_stc_pk_1',
            'skar_stc_pk_2',
            'skar_stc_jwb_1',
            'skar_stc_jwb_2',
            'skar_login',
            'skar_login_user',
            'skar_login_pass',
            'skar_login_aktif',
            'skar_nom_lembur',
            'skar_talangan',
            'skar_talangan_san',
            'skar_tampil'
        ],
        $keyType = 'string';

    // public function childs()
    // {
    //     if (auth()->check()) {
    //         // return $this->hasMany(Menu::class, 'wmn_key', 'wmn_kode')
    //                     // ->leftJoin('user_accounts', 'wmn_tipe', '=', 'menu_tipe')
    //                     // ->leftJoin('web_menu_jabatan', 'wmn_kode', '=', 'wmj_wmn_kode')
    //                     // ->where([
    //                     //     ['wmn_tipe', '=', Auth::user()->menu_tipe],
    //                     //     ['email', '=', Auth::user()->email],
    //                     //     ['wmj_sjab_kode', '=', Auth::user()->jabatan],
    //                     //     ['wmj_aktif', 1],
    //                     // ])
    //                     // ->orderBy('wmn_urut', 'ASC');

    //         return $this->hasMany(Menu::class, 'wmn_key', 'wmn_kode')->orderBy('wmn_urut', 'ASC');
    //     }
    // }
}
