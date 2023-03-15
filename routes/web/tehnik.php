<?php

use App\Http\Controllers\wwLoad\Lod;
use App\Http\Controllers\wwRpt\Grd;
use App\Http\Controllers\wwRpt\Rpt;
use App\Http\Controllers\tehnik\polis\ApprovalMasterPolisController;
use App\Http\Controllers\Tehnik\Polis\EntryPolisController;
use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\Soc\EntrySocKhususController;
use App\Http\Controllers\Tehnik\Soc\LihatEditSocController;
use App\Http\Controllers\Tehnik\Soc\LihatSocKhususController;
use App\Http\Controllers\wwLoad\Get;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {
    Route::group(['prefix' => '/entry-soc', 'as' => 'entry-soc.'], function() {
        Route::resource('/', EntrySocController::class);
        Route::get('/lod_pmg_polis', [Lod::class, 'lod_pmg_polis']);
        Route::get('/lod_nasabah', [Lod::class, 'lod_nasabah']);
        Route::get('/grd_segmen', [Grd::class, 'grd_segmen']);
    });
    Route::group(['prefix' => '/entry-tarifuw-soc', 'as' => 'entry-tarifuw-soc.'], function() {
        Route::resource('/', EntrySocKhususController::class);
        Route::post('simpan-sockhusus', [EntrySocKhususController::class, 'store']);
        Route::get('/lod_pmg_polis', [Lod::class, 'lod_pmg_polis']);
        Route::get('/lod_nasabah', [Lod::class, 'lod_nasabah']);
        Route::get('/lod_manfaat', [Lod::class, 'lod_manfaat']);
        Route::get('/lod_marketing', [Lod::class, 'lod_marketing']);
        Route::get('/lod_cabalamin', [Lod::class, 'lod_cabalamin']);
        Route::get('/lod_Cabang_polis', [Lod::class, 'lod_Cabang_polis']);
        Route::get('/lod_perusahaansoc', [Lod::class, 'lod_perusahaansoc']);
        Route::get('/lod_jnskerja', [Lod::class, 'lod_jnskerja']);
        Route::get('/lod_ocab', [Lod::class, 'lod_ocab']);
        Route::get('/lod_perusahaan', [Lod::class, 'lod_perusahaan']);
        Route::get('/lod_prassoc', [Lod::class, 'lod_prassoc']);
        Route::get('/lod_tarif', [Lod::class, 'lod_tarif']);
        Route::get('/lod_uw', [Lod::class, 'lod_uw']);

        Route::get('/grd_segmen', [Grd::class, 'grd_segmen']);

        Route::get('/get_nosoc', [Get::class, 'get_nosoc']);
        Route::get('/get_kodesocdtluw', [Get::class, 'get_kodesocdtluw']);
        Route::get('/get_kodesoc', [Get::class, 'get_kodesoc']);
    });
    Route::group(['prefix' => '/lihat-soc-khusus', 'as' => 'lihat-soc-khusus.'], function() {
        Route::resource('/', LihatSocKhususController::class);
        Route::get('/grd_lihat_soc_khu', [Grd::class, 'grd_lihat_soc_khu']);
    });
    Route::group(['prefix' => '/lihat-edit-soc', 'as' => 'lihat-edit-soc.'], function() {
        Route::resource('/', LihatEditSocController::class);
        Route::get('/lod_pmg_polis', [Lod::class, 'lod_pmg_polis']);
        Route::get('/lod_manfaat', [Lod::class, 'lod_manfaat']);
        Route::get('/lod_cabalamin_komisi', [Lod::class, 'lod_cabalamin_komisi']);
        Route::get('/lod_marketing', [Lod::class, 'lod_marketing']);
        Route::get('/lod_tarif', [Lod::class, 'lod_tarif']);
        Route::get('/lod_uw', [Lod::class, 'lod_uw']);

        Route::get('/rpt_lihattarif', [Rpt::class, 'rpt_lihattarif']);
        Route::get('/rpt_lihat_uw', [Rpt::class, 'rpt_lihat_uw']);

        Route::get('/grd_lihat_soc_khu', [Grd::class, 'grd_lihat_soc_khu']);

        Route::get('/get_kodesockode', [Get::class, 'get_kodesockode']);
        Route::get('/get_kodesockodeapprov', [Get::class, 'get_kodesockodeapprov']);

        Route::get('/get_pk', [Lod::class, 'coba']);
    });
  });

  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {
    Route::group(['prefix' => 'entry-master-polis', 'as' => 'entry-master-polis.'], function() {
        Route::resource('/', EntryPolisController::class);
        Route::get('/lod_pmg_polis', [Lod::class, 'lod_pmg_polis']);
        Route::get('/lod_oldpolis', [Lod::class, 'lod_oldpolis']);
        Route::get('/lod_soc', [Lod::class, 'lod_soc']);
        Route::get('/lod_nasabah', [Lod::class, 'lod_nasabah']);
        Route::get('/lod_mpid', [Lod::class, 'lod_mpid']);
        Route::get('/lod_spaj', [Lod::class, 'lod_spaj']);
        Route::get('/lod_segmen', [Lod::class, 'lod_segmen']);
        Route::get('/lod_manfaat', [Lod::class, 'lod_manfaat']);
        Route::get('/lod_pras', [Lod::class, 'lod_pras']);
        Route::get('/lod_cabalamin_komisi', [Lod::class, 'lod_cabalamin_komisi']);
        Route::get('/lod_marketing', [Lod::class, 'lod_marketing']);
        Route::get('/lod_tarif_polis', [Lod::class, 'lod_tarif_polis']);
        Route::get('/lod_uw_polis', [Lod::class, 'lod_uw_polis']);
        Route::get('/lod_provinsi', [Lod::class, 'lod_provinsi']);
        Route::get('/lod_paymod', [Lod::class, 'lod_paymod']);

        Route::get('/get_oldpolis', [Get::class, 'get_oldpolis']);
        Route::get('/get_nopolis', [Get::class, 'get_nopolis']);
        Route::get('/get_ket_soc', [Get::class, 'get_ket_soc']);
        Route::get('/get_kodepolis', [Get::class, 'get_kodepolis']);

        Route::get('/rpt_lihattarif', [Rpt::class, 'rpt_lihattarif']);
        Route::get('/rpt_lihat_uw', [Rpt::class, 'rpt_lihat_uw']);
    });
    Route::group(['prefix' => 'lihat-polis', 'as' => 'lihat-polis.'], function() {
        Route::resource('/', PolisController::class);
    });
    Route::resource('/approval-master-polis', ApprovalMasterPolisController::class);
  });

});
