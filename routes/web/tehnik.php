<?php

use App\Http\Controllers\wwLoad\Load;
use App\Http\Controllers\wwRpt\Rpt;
use App\Http\Controllers\tehnik\polis\ApprovalMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\EntryPolisController;
use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\Soc\EntryTarifOrUw;
use App\Http\Controllers\Tehnik\Soc\LihatSocController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {
    Route::group(['prefix' => '/entry-soc', 'as' => 'entry-soc.'], function() {
        Route::resource('/', EntrySocController::class);
        Route::get('/lod_pmg_polis', [Load::class, 'lod_pmg_polis']);
        Route::get('/lod_nasabah', [Load::class, 'lod_nasabah']);
        Route::get('/grd_segmen', [Load::class, 'grd_segmen']);
    });
    Route::group(['prefix' => '/entry-tarifuw-soc', 'as' => 'entry-tarifuw-soc.'], function() {
        Route::resource('/', EntryTarifOrUw::class);
        Route::get('/lod_pmg_polis', [Load::class, 'lod_pmg_polis']);
        Route::get('/lod_nasabah', [Load::class, 'lod_nasabah']);
        Route::get('/lod_manfaat', [Load::class, 'lod_manfaat']);
        Route::get('/grd_segmen', [Load::class, 'grd_segmen']);
        Route::get('/lod_cabalamin', [Load::class, 'lod_cabalamin']);
        Route::get('/lod_Cabang_polis', [Load::class, 'lod_Cabang_polis']);
        Route::get('/lod_perusahaansoc', [Load::class, 'lod_perusahaansoc']);
        Route::get('/lod_ocab', [Load::class, 'lod_ocab']);
        Route::get('/lod_perusahaan', [Load::class, 'lod_perusahaan']);
        Route::get('/lod_prassoc', [Load::class, 'lod_prassoc']);
        Route::get('/lod_tarif', [Load::class, 'lod_tarif']);

        Route::get('/get_kodesocdtluw', [Load::class, 'get_kodesocdtluw']);
    });
    Route::resource('/lihat-soc', LihatSocController::class);
  });

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {
    Route::group(['prefix' => 'entry-master-polis', 'as' => 'entry-master-polis.'], function() {
        Route::resource('/', EntryPolisController::class);
        Route::get('/lod_pmg_polis', [Load::class, 'lod_pmg_polis']);
        Route::get('/lod_oldpolis', [Load::class, 'lod_oldpolis']);
        Route::get('/lod_soc', [Load::class, 'lod_soc']);
        Route::get('/lod_nasabah', [Load::class, 'lod_nasabah']);
        Route::get('/lod_mpid', [Load::class, 'lod_mpid']);
        Route::get('/lod_spaj', [Load::class, 'lod_spaj']);
        Route::get('/lod_segmen', [Load::class, 'lod_segmen']);
        Route::get('/lod_manfaat', [Load::class, 'lod_manfaat']);
        Route::get('/lod_pras', [Load::class, 'lod_pras']);
        Route::get('/lod_cabalamin_komisi', [Load::class, 'lod_cabalamin_komisi']);
        Route::get('/lod_marketing', [Load::class, 'lod_marketing']);
        Route::get('/lod_tarif_polis', [Load::class, 'lod_tarif_polis']);
        Route::get('/lod_uw_polis', [Load::class, 'lod_uw_polis']);
        Route::get('/lod_provinsi', [Load::class, 'lod_provinsi']);
        Route::get('/lod_paymod', [Load::class, 'lod_paymod']);

        Route::get('/get_oldpolis', [Load::class, 'get_oldpolis']);
        Route::get('/get_nopolis', [Load::class, 'get_nopolis']);
        Route::get('/get_ket_soc', [Load::class, 'get_ket_soc']);
        Route::get('/get_kodepolis', [Load::class, 'get_kodepolis']);

        Route::get('/rpt_lihattarif', [Rpt::class, 'rpt_lihattarif']);
        Route::get('/rpt_lihat_uw', [Rpt::class, 'rpt_lihat_uw']);

        Route::get('/menuAll', [Load::class, 'menuAll']);
    });
    Route::group(['prefix' => 'lihat-polis', 'as' => 'lihat-polis.'], function() {
        Route::resource('/', PolisController::class);
    });
    Route::resource('/approval-master-polis', ApprovalMasterPolisController::class);
  });

});
