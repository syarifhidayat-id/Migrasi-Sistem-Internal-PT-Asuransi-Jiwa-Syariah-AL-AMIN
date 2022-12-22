<?php

use App\Http\Controllers\Keuangan\KomisiOverreding\InputKomisiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/keuangan', 'as' => 'keuangan.'], function () {

    Route::group(['prefix' => '/komisi-overreding', 'as' => 'komisi-overreding.'], function() {
      Route::resource('/input-komisi-overreding', InputKomisiController::class);
    });

});
