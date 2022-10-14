<?php

use App\Http\Controllers\Tehnik\LihatSocController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {

  });

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {
    Route::resource('/lihat', LihatSocController::class);
  });

});
