<?php

use App\Http\Controllers\Legal\PksController;
use App\Http\Controllers\Legal\DraftController;
use App\Http\Controllers\Legal\LaporanBerkalaContoller;
use App\Http\Controllers\Legal\OjkController;
use App\Http\Controllers\Legal\PeraturanController;
use App\Http\Controllers\Legal\UndangUndangController;
use App\Http\Controllers\Legal\PojkSeojkController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/legal', 'as' => 'legal.'], function () {

    Route::resource('ojk', OjkController::class);
    Route::resource('uu_asuransi', UndangUndangController::class);
    Route::get('view-pdf/{pk}', [UndangUndangController::class, 'viewPdf']);
    Route::resource('pojk-seojk', PojkSeojkController::class);
    
    Route::resource('peraturan-perusahaan', PeraturanController::class);
    Route::resource('laporan-berkala', LaporanBerkalaContoller::class);
    Route::get('master-laporan', [LaporanBerkalaContoller::class, 'index_master'])->name('master-laporan.index');
    Route::post('master-laporan', [LaporanBerkalaContoller::class, 'store_master'])->name('master-laporan.store');
    Route::get('master-laporan/{laporan_berkala}/edit', [LaporanBerkalaContoller::class, 'edit_master'])->name('master-laporan.edit');
    Route::delete('master-laporan/{laporan_berkala}', [LaporanBerkalaContoller::class, 'destroy_master'])->name('master-laporan.destroy');
    




    //Group route here!
    Route::group(['prefix' => '/pks', 'as' => 'pks.'], function () {
        Route::resource('/lihat', PksController::class);
        Route::prefix('/lihat')->name('lihat.')->controller(PksController::class)->group(function() {
            Route::get('/pks/{pk}', 'viewPks');
        });
        // Route::get('lihat/pks/{pk}', [PksController::class, 'viewPks'])->name('lihat.pks');
        Route::resource('draft', DraftController::class);
    });
    
    
});
