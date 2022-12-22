<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;


Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    
    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::resource('master-kas', MasterKasController::class);
    });
});

