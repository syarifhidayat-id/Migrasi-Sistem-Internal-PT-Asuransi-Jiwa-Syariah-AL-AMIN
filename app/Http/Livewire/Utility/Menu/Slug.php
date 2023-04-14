<?php

namespace App\Http\Livewire\Utility\Menu;

use App\Models\Utility\Menu;
use Livewire\Component;

class Slug extends Component
{
    public function render()
    {
        $menulist = Menu::select('*')
            ->leftJoin('user_accounts', 'wmn_tipe', '=', 'menu_tipe')
            ->leftJoin('web_menu_jabatan', 'wmn_kode', '=', 'wmj_wmn_kode')
            ->leftJoin('esdm.sdm_jabatan', 'jabatan', '=', 'sjab_kode')
            ->whereRaw("wmn_tipe='ALL' OR menu_tipe='" . __getGlbVal('menu_tipe') . "' AND wmn_key='MAIN' AND email='" . __getGlbVal('email') . "' AND wmj_sjab_kode='" . __getGlbVal('jabatan') . "' AND wmj_aktif=1")
            // ->where([
            //     ['wmn_key', '=', 'MAIN'],
            //     ['menu_tipe', '=', __getGlbVal('menu_tipe')],
            //     ['email', '=', __getGlbVal('email')],
            //     ['wmj_sjab_kode', '=', __getGlbVal('jabatan')],
            //     ['wmj_aktif', 1],
            // ])
            ->orderBy('wmn_urut', 'ASC')
            ->groupBy('wmn_kode')
            ->get();

        return view('livewire.utility.menu.slug')->with([
            'slug' => $menulist,
        ]);
    }
}
