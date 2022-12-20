<?php

// use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\MenuController;
use App\Http\Controllers\legal\PksController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Legal\DraftController;
use App\Http\Controllers\Legal\LaporanBerkalaContoller;
use App\Http\Controllers\Legal\OjkController;
use App\Http\Controllers\Legal\PojkSeojkController;
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
    Route::get('peraturan_perusahaan', [ApiController::class, 'Peraturan_perusahaan']);
    Route::get('get_edit_select_lap/{pk}', [LaporanBerkalaContoller::class, 'get_edit_lap_ber']);

   //API OJK
    Route::get('ojk', [OjkController::class, 'ojk']);
    Route::get('ojk/show-doc', [OjkController::class, 'showDoc']);
    Route::get('viewPdf/{file}', [ApiController::class, 'viewPdf']);
    Route::group(['prefix' => '/ojk', 'as' => 'ojk.'], function () {
        Route::get('selectId', [OjkController::class, 'selectId']);
        Route::get('getId/{id}', [OjkController::class, 'selectId']);

    });

    //API FILTER LAPORAN BERKALA
    Route::get('m_laporan_berkala', [LaporanBerkalaContoller::class, 'm_laporan_berkala']);
    Route::get('laporan_berkala', [LaporanBerkalaContoller::class, 'laporan_berkala']);
    Route::get('unit_laporan_berkala', [LaporanBerkalaContoller::class, 'unit_laporan_berkala']);
    Route::get('selectIdLapBerkala', [LaporanBerkalaContoller::class, 'selectIdLapBerkala']);
    Route::get('getIdLapBerkala/{id}', [LaporanBerkalaContoller::class, 'getJenisDok']);
    Route::get('selectJenisDok', [LaporanBerkalaContoller::class, 'selectJenisDok']);
    Route::get('getJenisDok/{id}', [LaporanBerkalaContoller::class, 'getIdLapBerkala']);
    Route::get('selectTahun', [LaporanBerkalaContoller::class, 'selectTahun']);
    Route::get('getTahun/{id}', [LaporanBerkalaContoller::class, 'getTahun']);
    Route::get('selectJudul', [LaporanBerkalaContoller::class, 'selectJudul']);
    Route::get('getJudul/{id}', [LaporanBerkalaContoller::class, 'getJudul']);

    Route::group(['prefix' => '/uu_asuransi', 'as' => 'uu_asuransi.'], function () {
        Route::get('uu_asuransi', [UndangUndangController::class, 'uu_asuransi']);
        //API FILTER DATATABLES DRAFT PKS
        Route::get('selectNomor', [UndangUndangController::class, 'selectNomor']);
        Route::get('getNomor/{id}', [UndangUndangController::class, 'getNomor']);
        Route::get('selectTentang', [UndangUndangController::class, 'selectTentang']);
        Route::get('getTentang/{id}', [UndangUndangController::class, 'getTentang']);
        // Route::get('selectSegmen', [DraftController::class, 'selectSegmen']);
        // Route::get('getSegmen/{id}', [DraftController::class, 'getSegmen']);
    });

    Route::get('pojk_seojk', [PojkSeojkController::class, 'pojk_seojk']);
     //API FILTER DATATABLES DRAFT PKS
     Route::get('selectNomorPojk', [PojkSeojkController::class, 'selectNomorPojk']);
     Route::get('getNomorPojk/{id}', [PojkSeojkController::class, 'getNomorPojk']);
     Route::get('selectPerihalPojk', [PojkSeojkController::class, 'selectPerihalPojk']);
     Route::get('getPerihalPojk/{id}', [PojkSeojkController::class, 'getPerihalPojk']);
     Route::get('selectJenis', [PojkSeojkController::class, 'selectJenis']);
     Route::get('getJenis/{id}', [PojkSeojkController::class, 'getJenis']);

    Route::get('draft_pks', [DraftController::class, 'api_draft']);

    Route::group(['prefix' => '/pks', 'as' => 'pks.'], function () {
        Route::get('get_all_pks/{id}', [PksController::class, 'get_all_pks']);
        Route::get('polis', [ApiController::class, 'polis'])->name('polis');
        Route::get('mssp', [DraftController::class, 'select_mssp']);
        Route::get('get_edit_polis/{id}', [PksController::class, 'get_edit_polis']);
        Route::get('mssp_kode/{id}', [DraftController::class, 'mssp_kode']);

        //API FILTER DATATABLES DRAFT PKS
        Route::get('selectId', [DraftController::class, 'selectId']);
        Route::get('getId/{id}', [DraftController::class, 'getId']);
        Route::get('selectTentang', [DraftController::class, 'selectTentang']);
        Route::get('getTentang/{id}', [DraftController::class, 'getTentang']);
        Route::get('selectSegmen', [DraftController::class, 'selectSegmen']);
        Route::get('getSegmen/{id}', [DraftController::class, 'getSegmen']);


        //API FILTER DATATABLES PKS
        Route::get('select-instansi', [PksController::class, 'selectInstansi']);
        Route::get('getInstansi/{id}', [PksController::class, 'getInstansi']);
        Route::get('select-no-pks', [PksController::class, 'selectNoPks']);
        Route::get('getNoPks/{id}', [PksController::class, 'getNoPks']);
        Route::get('selectPic', [PksController::class, 'selectPic']);
        Route::get('getPic/{id}', [PksController::class, 'getPic']);
        Route::get('selectInsUser', [PksController::class, 'selectInsUser']);
        Route::get('getInsUser/{id}', [PksController::class, 'getInsUser']);

        Route::prefix('/lihat')->name('lihat.')->controller(PksController::class)->group(function () {
            Route::get('/pks/{pk}', 'viewPks');
        });
    });
});


