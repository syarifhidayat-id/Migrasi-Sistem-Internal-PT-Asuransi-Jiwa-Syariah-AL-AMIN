<?php

namespace App\Http\Livewire;

use App\Models\Utility\Menu;
use Livewire\Component;

class SparatorLiveWire extends Component
{
    public $loadData = false;

    public function init()
    {
        $this->loadData = true;
    }
    public function render()
    {
        $menulist = Menu::select('*')
        ->leftJoin('user_accounts', 'wmn_tipe', '=', 'menu_tipe')
        ->leftJoin('web_menu_jabatan', 'wmn_kode', '=', 'wmj_wmn_kode')
        ->leftJoin('esdm.sdm_jabatan', 'jabatan', '=', 'sjab_kode')
        ->where([
            ['wmn_key', '=', 'MAIN'],
            ['wmn_tipe', '=', __getGlbVal('menu_tipe')],
            ['email', '=', __getGlbVal('email')],
            ['wmj_sjab_kode', '=', __getGlbVal('jabatan')],
            ['wmj_aktif', 1],
        ])
        ->orderBy('wmn_urut', 'ASC')
        ->get();

        return view('livewire.sparator-live-wire')->with([
            // 'menulist' => $this->loadData ? $menulist : [],
            'menulist' => $menulist,
        ]);
    }
}
