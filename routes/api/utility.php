<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\DaftarUserController;
use App\Http\Controllers\Utility\MenuController;
use App\Http\Controllers\Utility\PermissionController;
use App\Http\Controllers\Utility\WewenangJabatanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/utility', 'as' => 'utility.'], function () {

    // Route::resource('/menu', MenuController::class);
    Route::group(['prefix' => '/menu', 'as' => 'menu.'], function() {
        Route::get('/getTipe/{id}', [MenuController::class, 'getTipemenu']);
        Route::get('/edit/{id}', [MenuController::class, 'edit']);
        Route::get('/keyMenu/{id}', [MenuController::class, 'keyMenu']);
    });

    Route::group(['prefix' => '/daftar-user', 'as' => 'daftar-user.'], function() {
        Route::get('/lihat-data', [DaftarUserController::class, 'datauser'])->name('lihat-data');
    });

    Route::group(['prefix' => '/wewenang-jabatan', 'as' => 'wewenang-jabatan.'], function() {
        Route::get('/wmj_wmn_kode', [WewenangJabatanController::class, 'wmj_wmn_kode']);
    });
    // Route::group(['prefix' => '/daftar-user', 'as' => 'daftar-user.'], function() {
    //     Route::get('/lihat', [DaftarUserController::class, 'showTable']);
    // });
    // Route::resource('users', UserController::class);
    // Route::resource('permissions', PermissionController::class);
});


