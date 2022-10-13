<?php

use App\Http\Controllers\Tehnik\Polis\EndorsMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\EntryMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\LihatMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\BatalMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\EditMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\ApprovalPolisController;
use App\Http\Controllers\Tehnik\Soc\BatalSocKhususController;
use App\Http\Controllers\Tehnik\Soc\EntrySocKhususController;
use App\Http\Controllers\Tehnik\Polis\HelperPolisController;
use App\Http\Controllers\Master\PolisUnderWritingController;
use App\Http\Controllers\Tehnik\Soc\EditSocKhususController;
use App\Http\Controllers\Tehnik\Soc\ApprovalSocController;
use App\Http\Controllers\Tehnik\Soc\HelperSocController;
use App\Http\Controllers\Tehnik\Soc\EndorsSocController;
use App\Http\Controllers\Tehnik\Soc\LihatSocController;
use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\HelperTehnikController;
use App\Http\Controllers\Tehnik\Soc\BatalSocController;
// use App\Http\Controllers\Tehnik\Soc\BatalSocKhususController;
use App\Http\Controllers\Tehnik\Soc\EditSocController;
use App\Http\Controllers\Tehnik\Spaj\SpajController;
use App\Http\Controllers\Master\TarifController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {

  });

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {


      Route::prefix('lihat')->group(function() {

      });

  });

});
