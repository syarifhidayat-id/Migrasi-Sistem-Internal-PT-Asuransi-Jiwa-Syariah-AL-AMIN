<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('user_accounts')->insert([
            'email' => 'admin',
            'email_user' => 'admin@admin.com',
            'name' => 'Administrator',
            'password' => Hash::make('admin'),
            'password_reg' => '9',
            'lokasi' => null,
            'menu_tipe' => null,
            'groupuser' => 'alamin',
            'inbox' => null,
            'lastlogin' => '2022-02-08 21:18:35',
            'islive' => null,
            'bagian' => null,
            'ttdlevel' => null,
            'mrkn_kode_induk' => null,
            'mrkn_kode' => null,
            'rekan_tipe' => null,
            'ispst' => null,
            'isaprovrkn' => null,
            'isadmin' => null,
            'isregandro' => null,
            'tipemon' => null,
            'img_bukti' => null,
            'mjns_kode' => null,
            'dboard' => null,
            'chat_tipe' => null,
            'isautoemail' => null,
            'ischat' => null,
            'dirshare' => null,
            'pst_kumpulan' => null,
            'isdboard' => null,
            'pk_count' => null,
            'livevideo_hak' => null,
            'livevideo_ses' => null,
            'byr_cabang' => null,
            'tipe_login' => null,
            'mui_mntp_kode' => null,
            'mui_mht_kode' => null,
            'mui_mtt_kode' => null,
            'home_dash' => null,
            'home_menu' => null,
        ]);
    }
}
