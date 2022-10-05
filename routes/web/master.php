<?php

use App\Http\Controllers\Master\GolonganController;
use App\Http\Controllers\Master\RekananController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/master', 'as' => 'master.'], function () {
    Route::resource('rekanan', RekananController::class);
    Route::resource('golongan', GolonganController::class);
});
