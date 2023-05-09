<?php


use App\Http\Controllers\Sdm\EntryDirektoratController;
use App\Http\Controllers\Sdm\EntryJabatanController;
use App\Http\Controllers\Sdm\EntryLevelController;
use App\Http\Controllers\Sdm\EntryKeahlianController;
use App\Http\Controllers\sdm\kehadiran\MonitoringController;
use App\Http\Controllers\Sdm\PegawaiController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/sdm', 'as' => 'sdm.'], function () {
    Route::group(['prefix' => '/pegawai', 'as' => 'pegawai.'], function () {
        Route::resource('/master-direktorat', EntryDirektoratController::class);
        Route::get('/lihat-direktorat', [EntryDirektoratController::class, 'tampil'])->name('lihat-direktorat.index');

        Route::resource('/master-jabatan', EntryJabatanController::class);
        Route::get('/lihat-jabatan', [EntryJabatanController::class, 'tampil'])->name('lihat-jabatan.index');

        Route::resource('/master-level', EntryLevelController::class);
        Route::get('/lihat-level', [EntryLevelController::class, 'tampil'])->name('lihat-level.index');

        Route::resource('/master-keahlian', EntryKeahlianController::class);
        Route::get('/lihat-keahlian', [EntryKeahlianController::class, 'tampil'])->name('lihat-keahlian.index');

        Route::resource('/master-pegawai', PegawaiController::class);
    });


    Route::group(['prefix' => '/kehadiran', 'as' => 'kehadiran.'], function () {

        Route::group(['prefix' => '/monitoring-absen-harian', 'as' => 'monitoring-absen-harian.'], function () {

            Route::resource('/', MonitoringController::class);
            Route::get('/list', [MonitoringController::class, 'list']);
        });
        // Route::get('/monitoring-absen-harian', [MonitoringController::class, 'index']);
    });
});


// Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

//     Route::resource('/lihat-polis', PolisController::class);
//     Route::resource('/entry-master-polis', EntryPolisController::class);
//     // Route::prefix('/menu')->name('menu.')->controller(MenuController::class)->group(function() {
//     //     Route::get('/getTipe/{id}', 'getTipemenu');
//     //     Route::get('/edit/{id}', 'edit');
//     //     Route::get('/keyMenu/{id}', 'keyMenu');
//     // });
//     // Route::resource('users', UserController::class);
//     // Route::resource('permissions', PermissionController::class);
// });
