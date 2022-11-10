<?php

namespace App\Models\Sdm;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Jabatan extends Model
{
    use HasFactory;

    public
        $primaryKey = 'sjab_kode', // setup primaryKey
        // $primaryKey = 'mpol_kode',
        $incrementing = false, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        $connection = 'esdm',
        $table = 'sdm_jabatan',
        $fillable = [
            'sjab_kode',
            'sjab_ket',
            'sjab_ket2',
            'sjab_sdir_kode',
            'sjab_level',
            'sjab_transport',
            'sjab_chat',
            'sjab_lapproduksi',
            'sjab_pks',
            'sjab_master',
            'sjab_soc',
            'sjab_editsoc',
            'sjab_polis',
            'sjab_lihatpolis',
            'sjab_klaim',
            'sjab_peserta',
            'sjab_peserta_kump',
            'sjab_pesertaman',
            'sjab_konfirmpst',
            'sjab_reas',
            'sjab_em',
            'sjab_approv_em',
            'sjab_batalpst',
            'sjab_batalpstfix',
            'sjab_rekonpst',
            'sjab_giro',
            'sjab_komisi',
            'sjab_reguser',
            'sjab_refundpst',
            'sjab_aprovsoc',
            'sjab_aprovpolis',
            'sjab_cetakpstkump',
            'sjab_aprovrefund',
            'sjab_peserta_revisi',
            'sjab_aprovsuratin',
            'sjab_aprovsuratout',
            'sjab_aprovlembur',
            'sjab_aprovcuti',
            'sjab_aprovizin',
            'sjab_aprovpesertakump',
            'sjab_aprovpeserta',
            'sjab_aprovpesertacabang',
            'sjab_aprovpesertadisc',
            'sjab_aprovklaim',
            'sjab_aprovklaimtipe',
            'sjab_aprovreas',
            'sjab_aprovgiro',
            'sjab_aprovregkaryawan',
            'sjab_hapuspst',
            'sjab_hapus_agenda',
            'sjab_byrpst',
            'sjab_errpst',
            'sjab_editbayar',
            'sjab_aprovunlebih',
            'sjab_limit',
            'sjab_limit_nm',
            'sjab_acc_jurnal',
            'sjab_chat_tipe',
            'sjab_target',
            'sjab_hapusrekon',
            'sjab_btlpst_rekon',
            'sjab_revisikump',
            'sjab_spt',
            'sjab_tunjangan',
            'sjab_hrd_1',
            'sjab_vocer',
            'sjab_editakun',
            'sjab_del_trskeu',
            'sjab_approv_suratout',
            'sjab_approv_dknote',
            'sjab_cek_dknote',
            'sjab_approv_lembur',
            'sjab_lembur',
            'sjab_approvtc',
            'sjab_upd_tglrk',
            'sjab_jurmem',
            'sjab_aprov_acc',
            'sjab_approv_lembur_sdm',
            'sjab_dboard',
            'sjab_trt_kode',
            'sjab_klmre_kadiv',
            'sjab_kadiv_acc',
            'sjab_editrk',
            'sjab_hapustrs',
            'sjab_final_rpt',
            'sjab_aktif_batal',
            'sjab_updbyr_admdenda',
            'sjab_ins_bbnklm',
            'sjab_spj',
            'sjab_jam_absen',
            'sjab_kel_absen',
            'sjab_aprov2',
            'sjab_aprov_status_1',
            'sjab_aprov_status_2',
            'sjab_aprov_status_3',
            'sjab_aprov_status_4',
            'sjab_aprov_status_5',
            'sjab_aprov_status_6',
            'sjab_aprov_value_1',
            'sjab_aprov_value_2',
            'sjab_aprov_value_3',
            'sjab_aprov_value_4',
            'sjab_aprov_value_5',
            'sjab_aprov_value_6',
            'sjab_aprov_nilai_1',
            'sjab_aprov_nilai_2',
            'sjab_aprov_nilai_3',
            'sjab_aprov_nilai_4',
            'sjab_aprov_nilai_5',
            'sjab_aprov_nilai_6',
            'sjab_aprov_comen_r',
            'sjab_aprov_comen_c',
            'sjab_aprov_comen_d',
            'sjab_notifultah',
            'sjab_perush'
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
