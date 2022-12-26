<?php

// use App\Http\Controllers\Api\ApiController;

use App\Http\Controllers\Sekper\DokumenPerusahaanController;
use App\Http\Controllers\Sekper\SlidePresentasiController;
use App\Http\Controllers\Sekper\SuratKeluarController;
use App\Http\Controllers\Sekper\SuratMasukController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/sekper', 'as' => 'sekper.'], function () {

  Route::group(['prefix' => '/suratmasuk', 'as' => 'suratmasuk.'], function() {

    Route::get('surat_masuk', [SuratMasukController::class, 'surat_masuk']);

  });

  Route::group(['prefix' => '/suratkeluar', 'as' => 'suratkeluar.'], function() {

    Route::get('surat_keluar', [SuratKeluarController::class, 'surat_keluar']);
    Route::get('get_js', [SuratKeluarController::class, 'get_js']);
    Route::get('get_surat_dir', [SuratKeluarController::class, 'get_surat_dir']);
    Route::get('get_ref_surat', [SuratKeluarController::class, 'get_ref_surat']);
    Route::get('get_aju_surat', [SuratKeluarController::class, 'get_aju_surat']);
    Route::get('get_setuju_surat', [SuratKeluarController::class, 'get_setuju_surat']);
    Route::get('gettsjs-edit/{kode}', [SuratKeluarController::class, 'getTsinjs_edit']);
    Route::get('get_user_ttd', [SuratKeluarController::class, 'get_user_ttd']);
    
  });
  
  Route::group(['prefix' => '/slide_presentasi', 'as' => 'slide_presentasi.'], function() {
    Route::get('slide_presentasi', [SlidePresentasiController::class, 'getSlide']);

  });

  Route::group(['prefix' => '/dokumen_perusahaan', 'as' => 'dokumen_perusahaan.'], function () {
    
    Route::get('get_dok_perusahaan', [DokumenPerusahaanController::class, 'get_dok_perusahaan']);
  });


});
