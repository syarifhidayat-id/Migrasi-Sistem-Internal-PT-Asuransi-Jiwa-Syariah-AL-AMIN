<?php

use App\Http\Controllers\Sekper\DokumenKantorCabangController;
use App\Http\Controllers\Sekper\DokumenKantorPusatController;
use App\Http\Controllers\Sekper\DokumenPerusahaanLihatController;
use App\Http\Controllers\Sekper\RekananController;
use App\Http\Controllers\Sekper\SlidePresentasiController;
use App\Http\Controllers\Sekper\SuratMasukController;
use App\Http\Controllers\Sekper\UploadSuratKeluarController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/sekper', 'as' => 'sekper.'], function () {

  Route::group(['prefix' => '/suratmasuk', 'as' => 'suratmasuk.'], function() {

    Route::get('lov', [SuratMasukController::class, 'lov']);
    Route::get('edit/{id}', [SuratMasukController::class, 'edit']);

    // Route::get('/lovsm', function() {
    //   $sm = DB::table('trs_surat_masuk AS sm')
    //   ->select('sm.*')
    //   ->orderBy('sm.tsm_ins_date', 'DESC')
    //   ->get();
    //   return response()->json([
    //     'data' => $sm
    //   ]);
    // });

  });

  Route::group(['prefix' => '/suratkeluar', 'as' => 'suratkeluar.'], function() {

    Route::group(['prefix' => '/uploadsurat', 'as' => 'uploadsurat.'], function() {
        Route::get('lov', [UploadSuratKeluarController::class, 'lov']);
        Route::get('edit/{id}', [UploadSuratKeluarController::class, 'edit']);
    });

  });

  Route::group(['prefix' => '/slidepresentasi', 'as' => 'slidepresentasi.'], function() {

    Route::get('lov', [SlidePresentasiController::class, 'lov']);
    Route::get('lovcarippt', [SlidePresentasiController::class, 'lovPpt']);
    Route::get('edit/{id}', [SlidePresentasiController::class, 'edit']);
    Route::get('down/{id}', [SlidePresentasiController::class, 'down']);
    Route::get('storage/{filename}', [SlidePresentasiController::class, 'getFile']);

  });

  Route::group(['prefix' => '/dokumen-perusahaan', 'as' => 'dokumenperusahaan.'], function () {
    Route::get('kantorpusat/lov', [DokumenKantorPusatController::class, 'lov']);
    Route::get('kantorpusat/edit/{id}', [DokumenKantorPusatController::class, 'edit']);
    Route::get('kantorcabang/lov', [DokumenKantorCabangController::class, 'lov']);
    Route::get('kantorcabang/edit/{id}', [DokumenKantorCabangController::class, 'edit']);
    Route::get('lihat/{id}', [DokumenPerusahaanLihatController::class, 'edit']);
  });

    Route::get('/rekanan/lov', [RekananController::class, 'lov']);
    Route::get('/rekanan/edit/{id}', [RekananController::class, 'edit']);

});
