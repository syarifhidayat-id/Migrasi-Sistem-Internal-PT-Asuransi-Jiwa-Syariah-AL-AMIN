<?php

use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;
use App\Http\Controllers\Keuangan\Kas\RincianTransaksiController;
use App\Http\Controllers\Keuangan\Kas\VoucherController;
use App\Http\Controllers\Keuangan\Komisi\InputBayarController;
use App\Http\Controllers\Keuangan\Komisi\InputPajakController;
use App\Http\Controllers\Keuangan\LampiranJurnalPembayaran\LampiranKlaimController;
use App\Http\Controllers\Library\LodController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function() {

        Route::group(['prefix' => '/input-pajak-overriding', 'as' => 'input-pajak-overriding.'], function() {
            Route::get('/lod-input-komisioverriding', [InputPajakController::class, 'lodInputKomisi']);
            Route::get('/cari-tax', [InputPajakController::class, 'cariTax']);
            Route::get('/lod-user-tax', [InputPajakController::class, 'userTax']);
            Route::get('/export-input', [InputPajakController::class, 'exportInput']);
            Route::get('/lod_cabalamin', [LodController::class, 'lod_cabalamin']);
            // Route::get('/post-pjkomisi', [InputPajakController::class, 'postPjKomisi']);
            // Route::get('/lod_pmg_polis', [LodController::class, 'lod_pmg_polis']);
        });

        Route::group(['prefix' => 'input-bayar-overriding', 'as' => 'input-bayar-overriding.'], function() {
            Route::resource('/', InputBayarController::class);
            Route::get('/lod-input-bayar', [InputBayarController::class, 'lodInputBayar']);
            Route::get('/lod_cabalamin', [LodController::class, 'lod_cabalamin']);
            // Route::get('/post-pjkomisi', [InputBayarController::class, 'postPjKomisi']);
            // Route::get('/lod_pmg_polis', [LodController::class, 'lod_pmg_polis']);
        });

        Route::group(['prefix' => '/approval-komisi-overriding', 'as' => 'approval-komisi-overriding.'], function() {
            Route::get('/list-komisi', [ApprovalKomisiController::class, 'listKomisi']);
        });

    });

    Route::group(['prefix' => '/lampiran-jurnal-pembayaran', 'as' => 'lampiran-jurnal-pembayaran.'], function() {
        Route::group(['prefix' => '/lampiran-klaim', 'as' => 'lampiran-klaim.'], function() {
            Route::get('/table-lampiran-klaim', [LampiranKlaimController::class, 'lodLampiranKlaim']);
        });
    });

    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::resource('vcr', VoucherController::class);
        Route::resource('dtl', RincianTransaksiController::class);
        Route::get('api_tb_dtl', [RincianTransaksiController::class, 'api_tb_dtl']);


        Route::get('kantor-alamin', [MasterKasController::class, 'kantor_alamin']);
        Route::get('s_karyawan', [MasterKasController::class, 'm_karyawan']);
        Route::get('e_realisasi', [MasterKasController::class, 'e_realisasi']);
        Route::get('e_akun', [RincianTransaksiController::class, 'e_akun']);
        Route::get('tkav_nomor', [VoucherController::class, 'get_vcr_kode']);
        Route::get('tdna_penerima', [MasterKasController::class, 'tdna_penerima']);

    });

});
