<?php

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

require __DIR__ . '/api/utility.php';
<<<<<<< HEAD
require __DIR__ . '/api/tehnik.php';
=======
require __DIR__ . '/api/legal.php';
>>>>>>> e015ff30a0a5f1193a41430b4b221d40a27946f6
