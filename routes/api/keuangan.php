<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {

    Route::group(['prefix' => '/komisi-overreding', 'as' => 'komisi-overreding.'], function() {

        Route::group(['prefix' => '/input-komisi-overreding', 'as' => 'input-komisi-overreding.'], function() {
            Route::get('/list-soc', [LihatSocController::class, 'listSoc']);
        });

    });

});
