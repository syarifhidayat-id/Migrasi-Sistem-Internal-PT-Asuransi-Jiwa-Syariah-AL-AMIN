<?php

namespace App\Http\Controllers\wwRpt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Rpt extends Controller
{
    public function rpt_lihattarif()
    {
        __rptTarif();
    }

    public function rpt_lihat_uw()
    {
        __rptUw();
    }
}
