<?php

use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {

    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function() {

        Route::group(['prefix' => '/approval-komisi-overriding', 'as' => 'approval-komisi-overriding.'], function() {
            Route::get('/list-komisi', [ApprovalKomisiController::class, 'listKomisi']);
        });
    });

});
