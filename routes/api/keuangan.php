<?php

use App\Http\Controllers\Keuangan\Kas\MasterKasController;
use App\Http\Controllers\Keuangan\KomisiOverreding\InputKomisiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {

    Route::group(['prefix' => '/komisi-overreding', 'as' => 'komisi-overreding.'], function() {

        Route::group(['prefix' => '/input-komisi-overreding', 'as' => 'input-komisi-overreding.'], function() {
            Route::get('/list-soc', [InputKomisiController::class, 'inputKomisi']);
        });

    });
    
    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::get('kantor-alamin', [MasterKasController::class, 'kantor_alamin']);
        Route::get('s_karyawan', [MasterKasController::class, 'm_karyawan']);
    });

});
