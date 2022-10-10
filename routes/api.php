<?php

use App\Http\Controllers\Utility\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

// Route::get('/loadmenu', [MenuController::class, 'menuDashboard']);

// View::composer('*', function($view) {
//     $view->with([
//         'menulist' => MenuController::menuDashboard()
//     ]);
//     // return response()->json([
//     //     'menulist' => MenuController::menuDashboard()
//     // ]);
// });

require __DIR__ . '/api/utility.php';
require __DIR__ . '/api/legal.php';
