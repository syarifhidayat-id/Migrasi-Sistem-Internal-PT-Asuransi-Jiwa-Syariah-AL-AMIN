<?php

use App\Http\Controllers\DevIT\DevITTabelController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/devit', 'as' => 'devit.', 'middleware' => 'auth'], function () {
  Route::resource('devtabel', DevITTabelController::class);

});
