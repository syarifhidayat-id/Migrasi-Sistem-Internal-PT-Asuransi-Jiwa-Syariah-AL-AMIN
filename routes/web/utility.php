<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\DaftarUserController;
use App\Http\Controllers\Utility\MenuController;
use App\Http\Controllers\Utility\PermissionController;
use App\Http\Controllers\Utility\WewenangJabatanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/utility', 'as' => 'utility.'], function () {

    Route::resource('/menu', MenuController::class);
    Route::resource('/daftar-user', DaftarUserController::class);

    // Route::prefix('/daftar-user')->name('daftar-user.')->controller(DaftarUserController::class)->group(function() {
    //     Route::post('/store', 'store')->name('store');
    // });

    Route::resource('/wewenang-jabatan', WewenangJabatanController::class);
    // Route::prefix('/menu')->name('menu.')->controller(MenuController::class)->group(function() {
    //     Route::get('/getTipe/{id}', 'getTipemenu');
    //     Route::get('/edit/{id}', 'edit');
    //     Route::get('/keyMenu/{id}', 'keyMenu');
    // });
    // Route::resource('users', UserController::class);
    // Route::resource('permissions', PermissionController::class);
});


