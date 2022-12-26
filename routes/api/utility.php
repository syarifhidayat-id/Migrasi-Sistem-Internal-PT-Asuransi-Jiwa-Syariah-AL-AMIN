<?php

use App\Http\Controllers\Utility\DaftarUserController;
use App\Http\Controllers\Utility\MenuController;
use App\Http\Controllers\Utility\WewenangJabatanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/utility', 'as' => 'utility.'], function () {

    // Route::resource('/menu', MenuController::class);
    Route::group(['prefix' => '/menu', 'as' => 'menu.'], function() {
        Route::get('/select-tipemenu', [MenuController::class, 'selectTipeMenu']);
        Route::get('/select-menu', [MenuController::class, 'selectMenu']);
        Route::get('/lihat-menu', [MenuController::class, 'datamenu']);
        // Route::get('/edit/{id}', [MenuController::class, 'edit']);
        Route::get('/tipe-menu/{id}', [MenuController::class, 'tipeMenu']);
        Route::get('/key-menu/{id}', [MenuController::class, 'keyMenu']);
    });

    Route::group(['prefix' => '/daftar-user', 'as' => 'daftar-user.'], function() {
        Route::get('/lihat-user', [DaftarUserController::class, 'datauser']);
        // Route::get('/edit/{id}', [DaftarUserController::class, 'edit']);
        Route::get('/select-tipemenu', [DaftarUserController::class, 'selectTipeMenu']);
        Route::get('/tipe-menu/{id}', [DaftarUserController::class, 'tipeMenu']);
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


