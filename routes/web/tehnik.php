<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\DaftarUserController;
use App\Http\Controllers\Tehnik\PolisController;
use App\Http\Controllers\Tehnik\EntryPolisController;
use App\Http\Controllers\Utility\PermissionController;
use App\Http\Controllers\Utility\WewenangJabatanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function () {
    Route::resource('/lihat-polis', PolisController::class);
    Route::resource('/entry-master-polis', EntryPolisController::class);
  });

    
    
});

