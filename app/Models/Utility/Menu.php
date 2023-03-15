<?php

namespace App\Models\Utility;

use App\Models\Master\MenuJabatan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    use HasFactory;

    public
        $primaryKey = 'wmn_kode', // setup primaryKey
        $incrementing = false, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        // $connection = 'web_conf',
        $table = 'web_menu',
        $fillable = [
            'wmn_kode',
            'wmn_descp',
            'wmn_urut',
            'wmn_tipe',
            'wmn_key',
            'wmn_url',
            'wmn_url_n',
            'wmn_urlkode',
            'wmn_slide',
            'wmn_timer',
            'wmn_info',
            'wmn_mrkn_kode',
            'wmn_mpol_kode',
            'wmn_open_w',
            'wmn_url_o',
            'wmn_url_o_n',
            'wmn_url_o_aktif',
            'wmn_url_o_aktif_n',
            'wmn_bot',
            'wmn_url_bot',
            'wmn_icon',

        ],
        $keyType = 'string';

    public function childs()
    {
        if (auth()->check()) {
            // return $this->hasMany(Menu::class, 'wmn_key', 'wmn_kode')
            // ->leftJoin('user_accounts', 'wmn_tipe', '=', 'menu_tipe')
            // ->leftJoin('web_menu_jabatan', 'wmn_kode', '=', 'wmj_wmn_kode')
            // ->where([
            //     ['wmn_tipe', '=', Auth::user()->menu_tipe],
            //     ['email', '=', Auth::user()->email],
            //     ['wmj_sjab_kode', '=', Auth::user()->jabatan],
            //     ['wmj_aktif', 1],
            // ])
            // ->orderBy('wmn_urut', 'ASC');

            return $this->hasMany(Menu::class, 'wmn_key', 'wmn_kode')->orderBy('wmn_urut', 'ASC');
        }
    }
}