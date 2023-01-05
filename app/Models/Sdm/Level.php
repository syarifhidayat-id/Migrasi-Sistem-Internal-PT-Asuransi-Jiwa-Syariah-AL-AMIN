<?php

namespace App\Models\Sdm;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Level extends Model
{
    use HasFactory;

    public
        $primaryKey = 'slv_kode', // setup primaryKey
        // $primaryKey = 'mpol_kode',
        $incrementing = false, // setup autoincrement primarykey visibility
        $timestamps = false; // setup timestamps visibility

    protected
        $connection = 'esdm',
        $table = 'sdm_level',
        $fillable = [
            'slv_kode',
            'slv_keterangan',
            'slv_tunjangan',
            'slv_tun_inap',
            'slv_tun_makan',
            'slv_tun_saku_wd',
            'slv_tun_saku_we',
            'slv_tun_saku_lu',
            'slv_tun_angkot',
            'slv_lembur'
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
