<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\Utility\MenuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.auth.login');
})->name('signin');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/maintenance', [DashboardController::class, 'maintenance'])->name('maintenance');

    // require __DIR__ . '/web/sdm.php';
    require __DIR__ . '/web/legal.php';
    // require __DIR__ . '/web/devit.php';
    // require __DIR__ . '/web/master.php';
    require __DIR__ . '/web/keuangan.php';
    require __DIR__ . '/web/tehnik.php';
    require __DIR__ . '/web/layanan.php';
    require __DIR__ . '/web/utility.php';
    // require __DIR__ . '/web/sekper.php';
    // require __DIR__ . '/web/exports.php';
    // require __DIR__ . '/web/ajax.php';
});
