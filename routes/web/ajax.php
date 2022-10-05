<?php

use App\Http\Controllers\Ajax\AjaxMenuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/ajax', 'as' => 'ajax.', 'middleware' => 'auth'], function () {
    Route::get('menu/{type}', [AjaxMenuController::class, 'getMainMenu'])->name('menu');
});