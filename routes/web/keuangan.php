<?php

use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use App\Http\Controllers\Keuangan\KomisiOverreding\InputKomisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Keuangan\Kas\MasterKasController;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {
    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function () {
        Route::resource('/input-komisi-overriding', InputKomisiController::class);
        Route::resource('/approval-komisi-overriding', ApprovalKomisiController::class);
        Route::get('export/{pk}/{mpol}', [ApprovalKomisiController::class, 'export']);
    });

    Route::group(['prefix' => '/kas', 'as' => 'kas.'], function () {
        Route::resource('master-kas', MasterKasController::class);
    });

});
