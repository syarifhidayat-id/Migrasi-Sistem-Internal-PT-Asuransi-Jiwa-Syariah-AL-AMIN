<?php

use App\Http\Controllers\Keuangan\Kas\ApprovController;
use App\Http\Controllers\Keuangan\Kas\ApprovKasAnggaranController;
use App\Http\Controllers\Keuangan\Kas\BukuBesarController;
use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;
use App\Http\Controllers\Keuangan\Kas\RincianTransaksiController;
use App\Http\Controllers\Keuangan\Kas\VoucherController;
use App\Http\Controllers\Keuangan\Komisi\InputBayarController;
use App\Http\Controllers\Keuangan\Komisi\InputPajakController;
use App\Http\Controllers\Keuangan\LampiranJurnalPembayaran\LampiranKlaimController;
use App\Http\Controllers\wwLoad\Lod;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function() {

        Route::group(['prefix' => '/input-pajak-overriding', 'as' => 'input-pajak-overriding.'], function() {
            Route::get('/lod-input-komisioverriding', [InputPajakController::class, 'lodInputKomisi']);
            Route::get('/cari-tax', [InputPajakController::class, 'cariTax']);
            Route::get('/lod-user-tax', [InputPajakController::class, 'userTax']);
            Route::get('/export-input', [InputPajakController::class, 'exportInput']);
            Route::get('/lod_cabalamin', [Lod::class, 'lod_cabalamin']);
            // Route::get('/post-pjkomisi', [InputPajakController::class, 'postPjKomisi']);
            // Route::get('/lod_pmg_polis', [Lod::class, 'lod_pmg_polis']);
        });

        Route::group(['prefix' => 'input-bayar-overriding', 'as' => 'input-bayar-overriding.'], function() {
            Route::resource('/', InputBayarController::class);
            Route::get('/lod-input-bayar', [InputBayarController::class, 'lodInputBayar']);
            Route::get('/lod_cabalamin', [Lod::class, 'lod_cabalamin']);
            // Route::get('/post-pjkomisi', [InputBayarController::class, 'postPjKomisi']);
            // Route::get('/lod_pmg_polis', [Lod::class, 'lod_pmg_polis']);
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

        Route::get('api_dtl_approv', [ApprovController::class, 'api_dtl_approv']);
        Route::get('selectCabangAlamin', [ApprovController::class, 'selectCabang']);
        Route::get('getCabangAlamin/{id}', [ApprovController::class, 'getCabang']);
        Route::get('api_approv/{id}', [ApprovController::class, 'api_approv']);
        Route::get('upload/{id}', [ApprovController::class, 'upload']);
        // Route::get('show-pdf', [MasterKasController::class, 'pdf_vcr']);

        Route::get('/lod-doc-approv', [ApprovController::class, 'lodDoc']);

        Route::group(['prefix' => '/buku-besar-kas', 'as' => 'buku-besar-kas.'], function () {
            Route::get('api-kantor-cabang', [BukuBesarController::class, 'kantor_cabang']);
            Route::get('lod_akunkascab', [BukuBesarController::class, 'lod_akunkascab']);
            Route::get('/lod_bukber', [BukuBesarController::class, 'lod_bukber']);
            Route::get('getjurnalkasfull', [BukuBesarController::class, 'getjurnalkasfull']);
            Route::get('i_jurkas', [BukuBesarController::class, 'i_jurkas']);
        });
        Route::group(['prefix' => '/approv-kas-anggaran', 'as' => 'approv-kas-anggaran.'], function () {
            Route::get('cabang_alamin', [ApprovKasAnggaranController::class, 'selectCabang']);
            Route::get('api_dtl_approv_kas', [ApprovKasAnggaranController::class, 'api_dtl_approv_kas']);
        });




    });

});
