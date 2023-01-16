<?php

use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;
use App\Http\Controllers\Keuangan\Kas\RincianTransaksiController;
use App\Http\Controllers\Keuangan\Kas\VoucherController;
use App\Http\Controllers\Keuangan\KomisiOverreding\InputKomisiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function() {

        Route::group(['prefix' => '/input-komisi-overriding', 'as' => 'input-komisi-overriding.'], function() {
            Route::get('/lod-input-komisioverriding', [InputKomisiController::class, 'lodInputKomisi']);
            Route::get('/cari-tax', [InputKomisiController::class, 'cariTax']);
            Route::get('/lod-user-tax', [InputKomisiController::class, 'userTax']);
            Route::get('/export-input', [InputKomisiController::class, 'exportInput']);
            Route::get('/select-cabalamin', [InputKomisiController::class, 'selectCabAlm']);
            Route::get('/post-pjkomisi', [InputKomisiController::class, 'postPjKomisi']);
        });

        Route::group(['prefix' => '/approval-komisi-overriding', 'as' => 'approval-komisi-overriding.'], function() {
            Route::get('/list-komisi', [ApprovalKomisiController::class, 'listKomisi']);
        });

    });

    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::resource('master-kas', MasterKasController::class);
        Route::resource('vcr', VoucherController::class);
        Route::get('tkav_nomor', [VoucherController::class, 'get_vcr_kode']);
        Route::get('vcr/get_tkad_akun/{id}', [VoucherController::class, 'get_tkad_akun']);
        
        Route::resource('dtl', RincianTransaksiController::class);
        Route::get('api_tb_dtl', [RincianTransaksiController::class, 'api_tb_dtl']);
        Route::get('e_akun', [RincianTransaksiController::class, 'e_akun']);
        Route::get('api_edit_dtl/{id}/edit', [RincianTransaksiController::class, 'api_edit_dtl']);
        Route::get('edit_akun/{id}', [RincianTransaksiController::class, 'edit_akun']);
        Route::delete('delete/{id}', [RincianTransaksiController::class, 'destroy']);
        
        Route::get('kantor-alamin', [MasterKasController::class, 'kantor_alamin']);
        Route::get('s_karyawan', [MasterKasController::class, 'm_karyawan']);
        Route::get('e_realisasi', [MasterKasController::class, 'e_realisasi']);
        Route::get('tdna_penerima', [MasterKasController::class, 'tdna_penerima']);

    });

});
