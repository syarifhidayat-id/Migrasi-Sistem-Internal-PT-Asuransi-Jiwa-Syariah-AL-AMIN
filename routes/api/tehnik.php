<?php

use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\Soc\UploadTarifController;
use App\Http\Controllers\tehnik\Soc\UploadUwController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

    Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {

        Route::group(['prefix' => '/entry-soc', 'as' => 'entry-soc.'], function() {
            // Route::resource('upload-tarif', UploadTarifController::class);
            Route::post('upload-tarif/{status}', [UploadTarifController::class, 'store']);
            Route::resource('upload-uw', UploadUwController::class);

            Route::get('/select-pmgpolis', [EntrySocController::class, 'selectPmgPolis']);
            Route::get('/select-jnsnasabah', [EntrySocController::class, 'selectJnsNasabah']);
            Route::get('/select-segmen/{kode}', [EntrySocController::class, 'selectSegmen']);
            Route::get('/select-nospaj', [EntrySocController::class, 'selectNoSpaj']);
            Route::get('/select-meka1', [EntrySocController::class, 'selectMeka1']);
            Route::get('/select-meka2', [EntrySocController::class, 'selectMeka2']);
            Route::get('/select-manasu/{kode}', [EntrySocController::class, 'selectManfaatAsu']);
            Route::get('/select-jnskerja', [EntrySocController::class, 'selectJnsKerja']);
            Route::get('/select-jamiasu/{kode1}/{kode2}', [EntrySocController::class, 'selectJamiAsu']);
            // Route::get('/pilih-program-asuransi/{mpid}/{mkm}/{mkm2}/{mft}/{mrkn}/{mssp}/{mjm}/{mjns}/{byr}/{perush}', [EntrySocController::class, 'pilihProgramAsuransi']);
            // Route::get('/pilih-program-asuransi/{mpid}', [EntrySocController::class, 'pilihProgramAsuransi']);
            Route::get('/pilih-program-asuransi', [EntrySocController::class, 'pilihProgramAsuransi']);
            Route::get('/select-salurandistribusi', [EntrySocController::class, 'selectSalDistri']);
            Route::get('/select-prodojk', [EntrySocController::class, 'selectProdOjk']);
            Route::get('/select-cabalamin', [EntrySocController::class, 'selectCabAlamin']);
            Route::get('/select-marketing/{kode}', [EntrySocController::class, 'selectMarketing']);
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
            Route::get('/lihat-tarif/{id}', [EntrySocController::class, 'lihatTarif']);
        });

        // Route::resource('/lihat-soc-data', [LihatSocController::class]);
    });

});
