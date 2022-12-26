<?php

<<<<<<< HEAD
use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
=======
use App\Http\Controllers\Keuangan\KomisiOverreding\InputKomisiController;
>>>>>>> 49716982dbec0200cc7530313527b4abced78b1b
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {

<<<<<<< HEAD
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function () {

        Route::resource('/approval-komisi-overriding', ApprovalKomisiController::class);
=======
    Route::group(['prefix' => '/komisi-overreding', 'as' => 'komisi-overreding.'], function() {
      Route::resource('/input-komisi-overreding', InputKomisiController::class);
    });
    
    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::resource('master-kas', MasterKasController::class);
>>>>>>> 49716982dbec0200cc7530313527b4abced78b1b
    });

});
