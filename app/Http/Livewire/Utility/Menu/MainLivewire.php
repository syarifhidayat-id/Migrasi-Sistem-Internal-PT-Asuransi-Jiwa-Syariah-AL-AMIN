<?php

namespace App\Http\Livewire\Utility\Menu;

use App\Models\Utility\Menu;
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

        // $cmd = "
        // SELECT *
        // FROM web_conf.web_menu
        // LEFT JOIN web_conf.user_accounts ON wmn_tipe=menu_tipe
        // LEFT JOIN web_conf.web_menu_jabatan ON wmn_kode=wmj_wmn_kode AND jabatan=wmj_sjab_kode
        // WHERE wmn_tipe='ALL' OR menu_tipe='" . __getGlbVal('menu_tipe') . "'
        // AND wmn_key='MAIN'
        // AND email='" . __getGlbVal('email') . "'
        // AND wmj_sjab_kode='" . __getJab() . "'
        // AND wmj_aktif=1
        // GROUP BY wmn_kode
        // ORDER BY wmn_urut ASC";
        // $menulist = __dbAll($cmd);

        // $cmd2 = "
        // SELECT *
        // FROM web_conf.web_menu
        // WHERE wmn_key=wmn_kode";
        // $child = __dbAll($cmd2);

        return view('livewire.utility.menu.main-livewire')->with([
            // 'menulist' => $this->loadData ? $menulist : [],
            'menulist' => $menulist,
        ]);
    }
}
