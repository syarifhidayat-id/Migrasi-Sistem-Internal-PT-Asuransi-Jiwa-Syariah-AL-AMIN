<?php

use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use App\Http\Controllers\Keuangan\KomisiOverreding\InputKomisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function () {
        Route::resource('/approval-komisi-overriding', ApprovalKomisiController::class);
        Route::resource('/input-komisi-overreding', InputKomisiController::class);
    });

    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::resource('master-kas', MasterKasController::class);
    });

});
