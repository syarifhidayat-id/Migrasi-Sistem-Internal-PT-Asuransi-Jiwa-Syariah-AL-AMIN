<?php

use App\Http\Controllers\Legal\PeraturanPerusahaanController;
use App\Http\Controllers\Legal\uuAsuransiController;
use App\Http\Controllers\Legal\PojkSeojkController;
use App\Http\Controllers\Legal\LegalOjkController;
use App\Http\Controllers\Legal\PksController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/legal', 'as' => 'legal.'], function () {
    Route::resource('pks', PksController::class);
    Route::get('pks/{pk}', [PksController::class, 'viewPks'])->name('pks');
    // Route::resource('ojk', LegalOjkController::class);
    // Route::resource('peraturan', PeraturanPerusahaanController::class);
    // Route::resource('pojk', PojkSeojkController::class);
    // Route::resource('uua', UuAsuransiController::class);

    // Route::get('/upload_pks', [PksController::class, 'uploadDraftPks' ])
    // ->name('pks.upload');
    // Route::get('lihat_pks', [PksController::class, 'lihatDraftPks' ])
    // ->name('pks.lihat_pks');
    // Route::resource('peraturan', PeraturanPerusahaanController::class);
    // Route::resource('pojk', PojkSeojkController::class);
    // Route::resource('uua', UuAsuransiController::class);
    // Route::resource('ojk', LegalOjkController::class);
});
