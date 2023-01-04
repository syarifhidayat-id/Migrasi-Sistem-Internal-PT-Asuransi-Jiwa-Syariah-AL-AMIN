<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/reload-captcha', [LoginController::class, 'reloadCaptha']);

require __DIR__ . '/api/keuangan.php';
require __DIR__ . '/api/utility.php';
require __DIR__ . '/api/tehnik.php';
require __DIR__ . '/api/legal.php';
require __DIR__ . '/api/keuangan.php';
