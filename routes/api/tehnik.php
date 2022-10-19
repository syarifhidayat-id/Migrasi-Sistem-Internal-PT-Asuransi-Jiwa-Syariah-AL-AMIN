<?php

use App\Http\Controllers\Tehnik\EntrySocController;
use App\Http\Controllers\Tehnik\LihatSocController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

    Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {

        Route::group(['prefix' => '/entry-soc', 'as' => 'entry-soc.'], function() {
            Route::get('/select-pmgpolis', [EntrySocController::class, 'selectPmgPolis']);
        });

        // Route::resource('/lihat-soc-data', [LihatSocController::class]);
    });

});
