<?php

use App\Http\Controllers\wwLoad\Load;
use App\Http\Controllers\tehnik\polis\ApprovalMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\EntryPolisController;
use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\Soc\LihatSocController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {
    Route::resource('/entry-soc', EntrySocController::class);
    Route::resource('/lihat-soc', LihatSocController::class);
  });

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {
    Route::group(['prefix' => 'entry-master-polis', 'as' => 'entry-master-polis.'], function() {
        Route::resource('/', EntryPolisController::class);
        Route::get('/lod_pmg_polis', [Load::class, 'lod_pmg_polis']);
        Route::get('/lod_nasabah', [Load::class, 'lod_nasabah']);
        Route::get('/lod_mpid', [Load::class, 'lod_mpid']);
        Route::get('/get_nopolis', [Load::class, 'get_nopolis']);
    });
    Route::group(['prefix' => 'lihat-polis', 'as' => 'lihat-polis.'], function() {
        Route::resource('/', PolisController::class);
    });
    Route::resource('/approval-master-polis', ApprovalMasterPolisController::class);
  });

});
