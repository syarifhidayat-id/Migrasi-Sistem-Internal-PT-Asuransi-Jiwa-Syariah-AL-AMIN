<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KodeController extends Controller
{
    public static function __getPK($vtable, $long)
    {
        $tahunNow = date('ymd');
        $getNum = $vtable;
        $noUrut = substr($getNum, 6, $long);
        $noUrut++;
        $noUrutFormated = sprintf('%0'.$long.'s', $noUrut);

        $kodePK = $tahunNow . $noUrutFormated;
        return $kodePK;
    }

    public static function nullRequests($request)
    {
        // siapkan array kosong untuk menampung request yang null
        $nullRequest = [];
        // looping request
        foreach ($request as $key => $value) {
            // jika nilai request yang ke-n = null
            if ($value === null || $value === 'null') {
                // msukan data baru ke dalam array kosong di atas dengan key dari request tersebut
                array_push($nullRequest, $key);
            }
        }

        return $nullRequest;
    }
}
