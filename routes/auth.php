<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// Auth::routes();
Route::post('/signin', [LoginController::class, 'store'])->middleware('guest')->name('signin.store');
Route::post('/signout', [LoginController::class, 'logout'])->middleware('auth')->name('signout');
// Route::get('/reload-captcha', [LoginController::class, 'reloadCaptha'])->name('reload.captcha');
