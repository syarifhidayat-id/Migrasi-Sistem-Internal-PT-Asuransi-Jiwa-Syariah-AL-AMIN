<?php

use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\Soc\LihatSocController;
use App\Http\Controllers\Tehnik\Soc\UploadTarifController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {

  });

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {
    Route::resource('/entry-soc', EntrySocController::class);

    Route::group(['prefix' => '/entry-soc', 'as' => 'entry-soc.'], function() {
        Route::resource('upload-tarif', UploadTarifController::class);
    });

    Route::resource('/lihat-soc', LihatSocController::class);
  });

});
