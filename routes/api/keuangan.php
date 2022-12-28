<?php

use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;
use App\Http\Controllers\Keuangan\KomisiOverreding\InputKomisiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function() {

        Route::group(['prefix' => '/input-komisi-overriding', 'as' => 'input-komisi-overriding.'], function() {
            Route::get('/list-input-komisioverriding', [InputKomisiController::class, 'inputKomisi']);
        });

        Route::group(['prefix' => '/approval-komisi-overriding', 'as' => 'approval-komisi-overriding.'], function() {
            Route::get('/list-komisi', [ApprovalKomisiController::class, 'listKomisi']);
        });

    });

    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::get('kantor-alamin', [MasterKasController::class, 'kantor_alamin']);
        Route::get('s_karyawan', [MasterKasController::class, 'm_karyawan']);
    });

});
