<?php

namespace App\Http\Livewire\Utility\Menu;

use App\Http\Controllers\Utility\MenuController;
use App\Models\Utility\Menu;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MainLivewire extends Component
{
    public $loadData = false;

    public function init()
    {
        $this->loadData = true;
    }

    public function render()
    {
        $menulist = Menu::select(
            '*'
            // 'wmn_kode', 'wmn_key', 'wmn_descp', 'wmn_icon', 'wmn_url', 'wmn_url_o', 'wmn_tipe', 'email', 'menu_tipe', 'wmj_wmn_kode', 'wmj_sjab_kode', 'wmj_aktif', 'wmn_urut', 'jabatan'
        )
        ->leftJoin('user_accounts', 'wmn_tipe', '=', 'menu_tipe')
        ->leftJoin('web_menu_jabatan', 'wmn_kode', '=', 'wmj_wmn_kode')
        ->where([
            ['wmn_key', '=', 'MAIN'],
            ['wmn_tipe', '=', Auth::user()->menu_tipe],
            ['email', '=', Auth::user()->email],
            ['wmj_sjab_kode', '=', Auth::user()->jabatan],
            ['wmj_aktif', 1],
        ])
        ->orderBy('wmn_urut', 'ASC')
        ->get();

        return view('livewire.utility.menu.main-livewire')->with([
            // 'menulist' => $this->loadData ? $menulist : [],
            'menulist' => $menulist,
        ]);
    }
}
