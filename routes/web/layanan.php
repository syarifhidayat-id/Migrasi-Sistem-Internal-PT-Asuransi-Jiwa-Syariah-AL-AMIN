<?php

use App\Http\Controllers\Layanan\PesertaIndividu\ApprovalPesertaIndividuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/layanan', 'as' => 'layanan.'], function () {

    Route::group(['prefix' => '/peserta-individu', 'as' => 'peserta-individu.'], function () {

        Route::resource('/approval-peserta-individu', ApprovalPesertaIndividuController::class);
    });
    // Route::group(['prefix' => '/pesertaindividu', 'as' => 'pesertaindividu.'], function () {
    //     Route::resource('entry', EntryPesertaIndividuController::class);
    //     Route::post('/approval/filter', [ApprovalPesertaIndividuController::class, 'index'])->name('approval.indexFilter');
    //     Route::resource('approval', ApprovalPesertaIndividuController::class);
    //     Route::resource('cetak', CetakPesertaIndividuController::class);
    //     Route::resource('disc', ApprovalDiscController::class);
    //     Route::resource('pembatalan', PembatalanPesertaIndividuController::class);
    //     Route::resource('cabang', EntryPesertaIndividuCabangController::class);
    //     Route::resource('lihat', LihatPesertaFixTampunganController::class);
    // });
    // Route::group(['prefix' => '/refundpeserta', 'as' => 'refundpeserta.'], function () {
    //     Route::resource('entry', EntryRefundPesertaController::class);
    //     Route::resource('approval', ApprovalRefundPesertaController::class);
    //     Route::resource('cetak', CetakPengajuanRefundController::class);
    //     Route::resource('debet', EntryRefundDebetController::class);
    // });
});
