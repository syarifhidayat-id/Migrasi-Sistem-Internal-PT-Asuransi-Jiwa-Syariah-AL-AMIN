<?php

use App\Http\Controllers\Tehnik\Polis\EndorsMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\EntryMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\LihatMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\BatalMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\EditMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\ApprovalPolisController;
use App\Http\Controllers\Tehnik\Soc\BatalSocKhususController;
use App\Http\Controllers\Tehnik\Soc\EntrySocKhususController;
use App\Http\Controllers\Tehnik\Polis\HelperPolisController;
use App\Http\Controllers\Master\PolisUnderWritingController;
use App\Http\Controllers\Tehnik\Soc\EditSocKhususController;
use App\Http\Controllers\Tehnik\Soc\ApprovalSocController;
use App\Http\Controllers\Tehnik\Soc\HelperSocController;
use App\Http\Controllers\Tehnik\Soc\EndorsSocController;
use App\Http\Controllers\Tehnik\Soc\LihatSocController;
use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\HelperTehnikController;
use App\Http\Controllers\Tehnik\Soc\BatalSocController;
// use App\Http\Controllers\Tehnik\Soc\BatalSocKhususController;
use App\Http\Controllers\Tehnik\Soc\EditSocController;
use App\Http\Controllers\Tehnik\Spaj\SpajController;
use App\Http\Controllers\Master\TarifController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {
      Route::resource('entry', EntryMasterPolisController::class);
      Route::resource('edit', EditMasterPolisController::class);
      Route::resource('endors', EndorsMasterPolisController::class);
      Route::resource('batal', BatalMasterPolisController::class);
      Route::resource('lihat', LihatMasterPolisController::class);
      Route::get('/showCetakPolis/{mpol_kode}', [LihatMasterPolisController::class, 'showCetakPolis'])->name('showCetakPolis');
      Route::get('/showPolis/{mpol_kode}', [LihatMasterPolisController::class, 'showPolis'])->name('showPolis');
      Route::resource('approval', ApprovalPolisController::class);
      Route::get('/approval/{id}/old', [ApprovalPolisController::class, 'showOld'])->name('approval.showOld');
      Route::post('getSoc', [HelperPolisController::class, 'getSoc'])->name('getSoc');
      Route::post('getPolis', [HelperPolisController::class, 'getPolis'])->name('getPolis');
      Route::post('getJaminan', [HelperPolisController::class, 'getJaminan'])->name('getJaminan');
      Route::get('getSocDetail', [HelperPolisController::class, 'getDetailSoc'])->name('getDetailSoc');
      Route::post('getDetilUnderWritingPolis/{underWritingId}', [HelperSocController::class, 'getDetilUnderWritingPolis'])->name('getDetilUnderWritingPolis');
      Route::resource('edit', EditMasterPolisController::class);
  });

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {

      Route::resource('edit', EditSocController::class);
      Route::resource('entry', EntrySocController::class);
      Route::resource('batal', BatalSocController::class);
      Route::resource('lihat', LihatSocController::class);

      Route::prefix('lihat')->group(function() {
        Route::get('/showSoc/{msoc_kode}', [LihatSocController::class, 'showSoc'])->name('lihat.showSoc');
        Route::get('/showSocKhusus/{msoc_kode}', [LihatSocController::class, 'showSocKhusus'])->name('lihat.showSocKhusus');
        Route::get('/showUw/{msoc_mpuw_nomor}', [LihatSocController::class, 'showUw'])->name('lihat.showUw');
        Route::get('/showCetak/{msoc_kode}', [LihatSocController::class, 'showCetak'])->name('lihat.showCetak');
      });

      Route::resource('endors', EndorsSocController::class);
      Route::resource('approval', ApprovalSocController::class);
      Route::get('/approval/{id}/old', [ApprovalSocController::class, 'showOld'])->name('approval.showOld');
      Route::post('getSoc', [HelperSocController::class, 'getSoc'])->name('getSoc');
      Route::post('getTarif', [HelperSocController::class, 'getTarif'])->name('getTarif');
      Route::post('getDetilTarif', [HelperSocController::class, 'getDetilTarif'])->name('getDetilTarif');
      Route::post('dropdownDynamic', [HelperSocController::class, 'dropdownDynamic'])->name('dropdownDynamic');
      Route::post('getUnderWriting', [HelperSocController::class, 'getUnderWriting'])->name('getUnderWriting');
      Route::post('getDetilUnderWriting', [HelperSocController::class, 'getDetilUnderWriting'])->name('getDetilUnderWriting');
      Route::post('getPemegangPolis', [HelperSocController::class, 'getPemegangPolis'])->name('getPemegangPolis');
      Route::get('loadProdukSegment/{jenisNasabahId}', [HelperSocController::class, 'loadProdukSegment'])->name('loadProdukSegment');
      Route::get('loadJaminan/{jenisNasabahId}/{produkSegmentId}', [HelperSocController::class, 'getJaminan'])->name('loadJaminan');

  });

  Route::group(['prefix' => '/sockhusus', 'as' => 'sockhusus.'], function() {

      Route::resource('entry', EntrySocKhususController::class);
      Route::resource('batal', BatalSocKhususController::class);
      Route::resource('edit', EditSocKhususController::class);
      Route::post('getSoc', [HelperTehnikController::class, 'getSoc'])->name('getSoc');
      Route::post('getSocKhusus', [HelperTehnikController::class, 'getSocKhusus'])->name('getSocKhusus');

  });

    Route::resource('import-underwriting', PolisUnderWritingController::class);
    Route::resource('underWriting', PolisUnderWritingController::class);
    Route::resource('import-tarif', TarifController::class);
    Route::resource('tarif', TarifController::class);
    Route::resource('spaj', SpajController::class);

});
