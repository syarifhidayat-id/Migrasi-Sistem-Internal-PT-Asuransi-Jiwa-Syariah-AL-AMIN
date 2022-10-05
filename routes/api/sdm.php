<?php

use App\Http\Controllers\Sdm\DinasController;
use App\Http\Controllers\Sdm\FormTelatCepatController;
use App\Http\Controllers\Sdm\SuratController;
use App\Http\Controllers\Sdm\DirektoratController;
use App\Http\Controllers\Sdm\JabatanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/sdm', 'as' => 'sdm.'], function () {

    Route::group(['prefix' => '/dinas', 'as' => 'dinas.'], function () {
        Route::get('/getjab/{id}', [DinasController::class, 'getJab']);

    }); 

    // Route::group(['prefix' => '/telat', 'as' => 'telat.'], function () {
    //     Route::get('/getjabatan/{id}', [FormTelatCepatController::class, 'getjabatan']);

    // });

    Route::group(['prefix' => '/', 'as' => 'sakit.'], function () {
        Route::get('/getjab/{id}', [FormSakitController::class, 'getJab']);

    });

    Route::group(['prefix' => '/dirsdm', 'as' => 'dirsdm.'], function () {
        // Route::get('/getsurat/{id}', [DirektoratController::class, 'getSurat']);
        Route::get('ambilData', [DirektoratController::class, 'ambilData']);
        Route::get('pilihData/{id}', [DirektoratController::class, 'pilihData']);
    });

    Route::group(['prefix' => '/jabatan', 'as' => 'jabatan.'], function () {
        Route::get('/getdir/{id}', [JabatanController::class, 'getDir']);

    });
    
});
 