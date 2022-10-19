<?php

use App\Http\Controllers\Tehnik\EntrySocController;
use App\Http\Controllers\Tehnik\LihatSocController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {

  });

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {
    Route::resource('/entry-soc', EntrySocController::class);
    Route::resource('/lihat-soc', LihatSocController::class);
  });

});
