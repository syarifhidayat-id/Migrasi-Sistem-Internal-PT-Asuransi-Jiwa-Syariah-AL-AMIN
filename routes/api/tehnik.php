<?php

use App\Http\Controllers\tehnik\polis\ApprovalMasterPolisController;
use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\Soc\EntrySocKhususController;
use App\Http\Controllers\Tehnik\Soc\SocTerbitPolisController;
use App\Http\Controllers\Tehnik\Soc\UploadTarifController;
use App\Http\Controllers\tehnik\Soc\UploadUwController;
use App\Http\Controllers\wwLoad\Get;
use App\Http\Controllers\wwLoad\Lod;
use App\Http\Controllers\wwRpt\Grd;
use App\Http\Controllers\wwRpt\Rpt;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

    Route::group(['prefix' => '/soc', 'as' => 'soc.'], function () {

        Route::group(['prefix' => '/entry-soc', 'as' => 'entry-soc.'], function () {
            // Route::get('/select-jnsnasabah', [EntrySocController::class, 'selectJnsNasabah']);
            // Route::post('/select-segmen', [EntrySocController::class, 'selectSegmen']);
            Route::get('/select-nospaj', [EntrySocController::class, 'selectNoSpaj']);

            Route::get('/get_nosoc', [Get::class, 'get_nosoc']);
            Route::get('/get_kodesoc', [Get::class, 'get_kodesoc']);

            Route::post('/select-meka1', [EntrySocController::class, 'selectMeka1']);
            Route::post('/select-meka2', [EntrySocController::class, 'selectMeka2']);
            Route::get('/select-manasu', [EntrySocController::class, 'selectManfaatAsu']);
            Route::post('/select-jnskerja', [EntrySocController::class, 'selectJnsKerja']);
            Route::get('/select-jamiasu', [EntrySocController::class, 'selectJamiAsu']);
            Route::get('/lod_prassoc', [Lod::class, 'lod_prassoc']);
            Route::post('/select-salurandistribusi', [EntrySocController::class, 'selectSalDistri']);
            Route::post('/select-prodojk', [EntrySocController::class, 'selectProdOjk']);
            Route::get('/select-cabalamin', [EntrySocController::class, 'selectCabAlamin']);
            Route::get('/select-marketing', [EntrySocController::class, 'selectMarketing']);

            Route::get('/select-feeppn', [EntrySocController::class, 'selectFeePPn']);
            Route::get('/select-feepph23', [EntrySocController::class, 'selectFeePPh23']);
            Route::get('/select-ujroh', [EntrySocController::class, 'selectUjroh']);
            Route::get('/select-mnfee', [EntrySocController::class, 'selectMnFee']);
            Route::get('/select-komtidakpot', [EntrySocController::class, 'selectKomtidakpot']);
            Route::get('/select-kompot', [EntrySocController::class, 'selectKompot']);
            Route::get('/select-referal', [EntrySocController::class, 'selectReferal']);
            Route::get('/select-maintenence', [EntrySocController::class, 'selectMaintenence']);
            Route::get('/select-feebtidakpotong', [EntrySocController::class, 'selectFeebtidakpotong']);
            Route::get('/select-feebpotong', [EntrySocController::class, 'selectFeebpotong']);
            Route::get('/select-tarifimport', [EntrySocController::class, 'selectTarifImport']);
            Route::get('/select-underwritingimport', [EntrySocController::class, 'selectUnderwritingImport']);

            Route::get('/rpt_lihattarif', [Rpt::class, 'rpt_lihattarif']);
            Route::get('/rpt_lihat_uw', [Rpt::class, 'rpt_lihat_uw']);
            Route::post('/upload-tarif', [UploadTarifController::class, 'store']);
            Route::post('/update-upload-tarif', [UploadTarifController::class, 'updateTarif'])->name('updatetarif');
            Route::post('/upload-uw', [UploadUwController::class, 'store']);
            Route::post('/update-upload-uw', [UploadUwController::class, 'updateUw'])->name('updateuw');
        });

        Route::group(['prefix' => '/soc-terbit-polis', 'as' => 'soc-terbit-polis.'], function () {
            Route::get('/grd_approv_soc', [Grd::class, 'grd_approv_soc']);
        });

        Route::group(['prefix' => '/entry-tarifuw-soc', 'as' => 'entry-tarifuw-soc.'], function () {
            Route::get('/rpt_lihattarif', [Rpt::class, 'rpt_lihattarif']);
            Route::post('/upload-tarifkhusus', [EntrySocKhususController::class, 'store']);
            Route::post('/update-tarifkhusus', [EntrySocKhususController::class, 'store']);
            Route::get('/rpt_lihat_uw', [Rpt::class, 'rpt_lihat_uw']);
            Route::post('/upload-uwkhusus', [EntrySocKhususController::class, 'store']);
            Route::post('/update-uwkhusus', [EntrySocKhususController::class, 'store']);
        });

        Route::group(['prefix' => '/lihat-edit-soc', 'as' => 'lihat-edit-soc.'], function () {
        });

        Route::group(['prefix' => '/entry-tarifuw-soc', 'as' => 'entry-tarifuw-soc.'], function () {
        });

        Route::group(['prefix' => '/lihat-soc-khusus', 'as' => 'lihat-soc-khusus.'], function () {
            // Route::post('/update-status-approval/{kode}/{val}', [LihatSocController::class, 'udapteStsApprov']);
        });

        // Route::resource('/lihat-soc-data', [LihatSocController::class]);
    });

    Route::group(['prefix' => '/polis', 'as' => 'polis.'], function () {
        Route::group(['prefix' => '/approval-master-polis', 'as' => 'approval-master-polis.'], function () {
            Route::get('/list', [ApprovalMasterPolisController::class, 'getApprovalMasterPolis']);
            Route::get('/get-kode-soc', [ApprovalMasterPolisController::class, 'getKodeSocApprove']);
        });
        Route::group(['prefix' => '/entry-master-polis', 'as' => 'entry-master-polis.'], function () {
            Route::get('/lod_soc', [Lod::class, 'lod_soc']);
            // Route::get('/lod_provinsi', [Load::class, 'lod_provinsi']);
            // Route::get('/lod_paymod', [Load::class, 'lod_paymod']);
        });
        Route::group(['prefix' => 'lihat-polis', 'as' => 'lihat-polis.'], function () {
            Route::resource('/', LihatPolisController::class);
        });
    });
});
