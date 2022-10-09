<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarUser extends Model
{
    use HasFactory;

    public
        $primaryKey = 'id', // setup primaryKey
        $incrementing = false, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        $connection = 'mysql',
        $table = 'user_accounts',
        $fillable = [
            'id',
            'email',
            'no_hp',
            'email_user',
            'email_cc',
            'name',
            'password',
            'password_reg',
            'active',
            'groups',
            'activation_key',
            'extras',
            'temp',
            'lokasi',
            'korwil',
            'menu_tipe',
            'menu_tipe_rpt',
            'groupuser',
            'inbox',
            'iplocal',
            'lastlogin',
            'islive',
            'jabatan',
            'bagian',
            'ttdlevel',
            'mrkn_kode_induk',
            'mrkn_kode',
            'rekan_tipe',
            'ispst',
            'isaprovrkn',
            'isadmin',
            'isregandro',
            'tipemon',
            'img_bukti',
            'img_foto',
            'wmds_kode',
            'vtmp1',
            'vtmp2',
            'vtmp3',
            'info',
            'foto',
            'mjns_kode',
            'mkm_kode',
            'mkm_kode2',
            'mpol_kode',
            'dboard',
            'chat_tipe',
            'isautoemail',
            'ischat',
            'dirshare',
            'pst_kumpulan',
            'isdboard',
            'isnews',
            'pk_last',
            'pk_count',
            'pk_rpt',
            'livevideo_hak',
            'livevideo_ses',
            'byr_cabang',
            'tipe_login',
            'mui_mntp_kode',
            'mui_mht_kode',
            'mui_mtt_kode',
            'mui_keysec',
            'mui_keysec_expir',
            'no_agen',
            'cloud_id',
            'home_dash',
            'home_menu',
            'mgu_kode',
            'isdevmode',
        ],
        $keyType = 'string';
    }
