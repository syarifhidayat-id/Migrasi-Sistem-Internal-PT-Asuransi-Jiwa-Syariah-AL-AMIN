<?php

use App\Http\Controllers\Keuangan\Komisi\ApprovalKomisiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {

    Route::group(['prefix' => '/komisi-overriding', 'as' => 'komisi-overriding.'], function () {

        Route::resource('/approval-komisi-overriding', ApprovalKomisiController::class);
    });

});
