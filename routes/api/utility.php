<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\MenuController;
use App\Http\Controllers\Utility\PermissionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/utility', 'as' => 'utility.'], function () {

    // Route::resource('/menu', MenuController::class);
    Route::group(['prefix' => '/menu', 'as' => 'menu.'], function() {
        Route::get('/getTipe/{id}', [MenuController::class, 'getTipemenu']);
        Route::get('/edit/{id}', [MenuController::class, 'edit']);
        Route::get('/keyMenu/{id}', [MenuController::class, 'keyMenu']);
    });
    // Route::resource('users', UserController::class);
    // Route::resource('permissions', PermissionController::class);
});


