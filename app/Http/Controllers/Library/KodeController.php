<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Support\Str;
use stdClass;

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

    public static function __getpx($vtable, $long)
    {
        $tahunNow = date('y');
        $getNum = $vtable;
        $noUrut = substr($getNum, 2, $long);
        $noUrut++;
        $noUrutFormated = sprintf('%0'.$long.'s', $noUrut);

        $kodePK = $tahunNow . $noUrutFormated;
        return $kodePK;
    }

    public static function __getNo($kode, $vtable, $long)
    {
        $kdAwal = $kode;
        $getNum = $vtable;
        $noUrut = substr($getNum, strlen($kode), $long);
        $noUrut++;
        $noUrutFormated = sprintf('%0'.$long.'s', $noUrut);

        $kodePK = $kdAwal . '.' . $noUrutFormated;
        return $kodePK;
    }

    public static function __getKey($num)
    {
        // $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $tahunNow = date('ymd');
        $char = '0123456789';
        $charLength = strlen($char);
        $key = '';
        for ($i = 0; $i < $length = $num; $i++) {
            $key .= $char[rand(0, $charLength - 1)];
        }
        return $tahunNow.$key;
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

    public static function array_to_obj($array, $obj)
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value)) {
                $obj->$key = new stdClass();
                KodeController::array_to_obj($value, $obj->$key);
            } else {
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    public static function arrayToObject($array)
    {
        $object= new stdClass();
        return KodeController::array_to_obj($array,$object);
    }

    public static function arrToObj($array) {
        $objects = new stdClass();
        foreach ($array as $keys => $value) {
            if (is_array($value)) {
                $value = KodeController::arrToObj($value);
            }
            $objects->$keys = $value;
        }
        return $objects;
    }
}
