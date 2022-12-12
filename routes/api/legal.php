<?php

// use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\MenuController;
use App\Http\Controllers\legal\PksController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Legal\DraftController;
use App\Http\Controllers\Legal\LaporanBerkalaContoller;
use App\Http\Controllers\Legal\UndangUndangController;
use Illuminate\Support\Facades\Route;
// use Facade\FlareClient\Http\Response;
// use Illuminate\Support\Facades\DB;


Route::group(['prefix' => '/legal', 'as' => 'legal.'], function () {

    Route::get('api_pks', [PksController::class, 'api_pks']);

    // Route::resource('/menu', MenuController::class);
    Route::get('get_select_pks', [PksController::class, 'select_pk_pks'])->name('get_select_pks');
    Route::get('get_mojk_jenis', [ApiController::class, 'get_mojk_jenis'])->name('get_mojk_jenis');
    Route::get('jns-doc/{kode}', [ApiController::class, 'getJnsDoc']);
    Route::get('pojk_seojk', [ApiController::class, 'pojk_seojk']);
    Route::get('peraturan_perusahaan', [ApiController::class, 'Peraturan_perusahaan']);
    Route::get('m_laporan_berkala', [ApiController::class, 'm_laporan_berkala']);
    Route::get('laporan_berkala', [ApiController::class, 'laporan_berkala']);
    Route::get('unit_laporan_berkala', [ApiController::class, 'unit_laporan_berkala']);
    Route::get('get_edit_select_lap/{pk}', [LaporanBerkalaContoller::class, 'get_edit_lap_ber']);
    Route::get('ojk', [ApiController::class, 'ojk']);
    Route::get('viewPdf/{file}', [ApiController::class, 'viewPdf']);
    
    Route::group(['prefix' => '/uu_asuransi', 'as' => 'uu_asuransi.'], function () {
        Route::get('uu_asuransi', [UndangUndangController::class, 'uu_asuransi']);
        Route::get('get_uu_asuransi', [ApiController::class, 'get_uu']);

    });

    Route::group(['prefix' => '/pks', 'as' => 'pks.'], function () {
        Route::get('get_all_pks/{id}', [PksController::class, 'get_all_pks']);
        Route::get('polis', [ApiController::class, 'polis'])->name('polis');
        Route::get('mssp', [DraftController::class, 'select_mssp']);
        Route::get('get_edit_polis/{id}', [PksController::class, 'get_edit_polis']);
        Route::get('mssp_kode/{id}', [DraftController::class, 'mssp_kode']);
        Route::get('draft_pks', [DraftController::class, 'api_draft']);

        Route::prefix('/lihat')->name('lihat.')->controller(PksController::class)->group(function () {
            Route::get('/pks/{pk}', 'viewPks');
        });
    });
});


