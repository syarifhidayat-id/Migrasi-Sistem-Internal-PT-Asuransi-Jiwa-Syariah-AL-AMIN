<?php

use App\Http\Controllers\Api\ApiController;
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
// Route::middleware('auth:api')->get('/user', function (Request $request) {
// Route::group(['middleware' => ['auth:api']], function (Request $request) {
// Route::middleware(['auth:sanctum'])->group(function () {
    return $request->user();
});

// Route::middleware('auth:api')->group( function () {

// });

Route::get('/reload-captcha', [LoginController::class, 'reloadCaptha']);
Route::get('hari', [ApiController::class, 'hari']);
Route::get('bulan', [ApiController::class, 'bulan']);
Route::get('tahun', [ApiController::class, 'tahun']);
Route::get('kantor_cabang', [ApiController::class, 'kantor_cabang']);
Route::get('lod_akunkascab', [ApiController::class, 'lod_akunkascab']);
Route::get('lod_karyawan', [ApiController::class, 'lod_karyawan']);
Route::get('lod_ang_realisasi', [ApiController::class, 'lod_ang_realisasi']);

require __DIR__ . '/api/keuangan.php';
require __DIR__ . '/api/utility.php';
require __DIR__ . '/api/tehnik.php';
require __DIR__ . '/api/legal.php';
