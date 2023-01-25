<?php

use App\Http\Controllers\Keuangan\Kas\ApprovController;
use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use App\Http\Controllers\Keuangan\Komisi\InputPajakController;
use App\Http\Controllers\Keuangan\Komisi\InputBayarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;
use App\Http\Controllers\Keuangan\Kas\RincianTransaksiController;
use App\Http\Controllers\Keuangan\LampiranJurnalPembayaran\LampiranKlaimController;
use App\Http\Controllers\Library\LodController;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function () {

        Route::group(['prefix' => 'input-pajak-overriding', 'as' => 'input-pajak-overriding.'], function() {
            Route::resource('/', InputPajakController::class);
            Route::get('/post-pjkomisi', [InputPajakController::class, 'postPjKomisi']);
            Route::get('/lod_pmg_polis', [LodController::class, 'lod_pmg_polis']);
        });
        Route::group(['prefix' => 'input-bayar-overriding', 'as' => 'input-bayar-overriding.'], function() {
            Route::resource('/', InputBayarController::class);
            // Route::get('/post-pjkomisi', [InputBayarController::class, 'postPjKomisi']);
            // Route::get('/lod_pmg_polis', [LodController::class, 'lod_pmg_polis']);
        });
        Route::resource('/approval-komisi-overriding', ApprovalKomisiController::class);
        Route::get('export/{pk}/{mpol}', [ApprovalKomisiController::class, 'export']);
    });

    Route::group(['prefix' => '/lampiran-jurnal-pembayaran', 'as' => 'lampiran-jurnal-pembayaran.'], function() {
        Route::group(['prefix' => '/lampiran-klaim', 'as' => 'lampiran-klaim.'], function() {
            Route::resource('/', LampiranKlaimController::class);
        });
    });

    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::resource('master-kas', MasterKasController::class);
        Route::resource('rincian-transaksi', RincianTransaksiController::class);

        Route::resource('approv-transaksi-kas', ApprovController::class);
        Route::post('approv', [ApprovController::class, 'approv']);
        
    });

});
