<?php

use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use App\Http\Controllers\Keuangan\KomisiOverreding\InputKomisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;
use App\Http\Controllers\Keuangan\Kas\RincianTransaksiController;
use App\Http\Controllers\Library\LodController;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function () {
        Route::group(['prefix' => 'input-komisi-overriding', 'as' => 'input-komisi-overriding.'], function() {
            Route::resource('/', InputKomisiController::class);
            Route::get('/post-pjkomisi', [InputKomisiController::class, 'postPjKomisi']);
            Route::get('/lod_pmg_polis', [LodController::class, 'lod_pmg_polis']);
        });
        Route::resource('/approval-komisi-overriding', ApprovalKomisiController::class);
        Route::get('export/{pk}/{mpol}', [ApprovalKomisiController::class, 'export']);
    });

    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::resource('master-kas', MasterKasController::class);
        Route::resource('rincian-transaksi', RincianTransaksiController::class);

    });

});
