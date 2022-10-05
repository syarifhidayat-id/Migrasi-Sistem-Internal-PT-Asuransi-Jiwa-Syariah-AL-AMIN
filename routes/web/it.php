<?php

use App\Http\Controllers\IT\AssetITController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/it', 'as' => 'it.', 'middleware' => 'auth'], function () {
  Route::resource('lhtasset', AssetITController::class);

});
  