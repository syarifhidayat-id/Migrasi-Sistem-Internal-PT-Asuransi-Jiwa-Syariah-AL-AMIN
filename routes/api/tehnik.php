<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Tehnik\PolisController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

    // Route::resource('/menu', MenuController::class);
    Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {
        Route::get('/getTipe/{id}', [PolisController::class, 'getTipepolis']);
        Route::get('/edit/{id}', [PolisController::class, 'edit']);
        Route::get('/keyPolis/{id}', [PolisController::class, 'keyPolis']);
    });
    // Route::resource('users', UserController::class);
    // Route::resource('permissions', PermissionController::class);
});


