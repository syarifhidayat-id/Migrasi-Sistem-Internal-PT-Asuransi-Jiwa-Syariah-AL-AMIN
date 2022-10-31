<?php

use App\Http\Controllers\Legal\PksController;
use App\Http\Controllers\Legal\DraftController;
use App\Http\Controllers\Legal\UndangUndangController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/legal', 'as' => 'legal.'], function () {
    Route::group(['prefix' => '/pks', 'as' => 'pks.'], function () {
        Route::resource('/lihat', PksController::class);
        Route::prefix('/lihat')->name('lihat.')->controller(PksController::class)->group(function() {
            Route::get('/pks/{pk}', 'viewPks');
        });
        // Route::get('lihat/pks/{pk}', [PksController::class, 'viewPks'])->name('lihat.pks');
        Route::resource('draft', DraftController::class);
    });
    
    Route::resource('uu_asuransi', UndangUndangController::class);
    Route::get('view-pdf/{pk}', [UndangUndangController::class, 'viewPdf']);
});
