<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\MenuController;
use App\Http\Controllers\legal\PksController;
use App\Http\Controllers\Utility\PermissionController;
use App\Http\Controllers\Utility\WewenangJabatanController;
use Illuminate\Support\Facades\Route;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;


Route::group(['prefix' => '/legal', 'as' => 'legal.'], function () {

    // Route::resource('/menu', MenuController::class);
    Route::group(['prefix' => '/pks', 'as' => 'pks.'], function() {

        // Route::get('/keyMenu/{id}', [MenuController::class, 'keyMenu']);
        Route::get('/view-pks/{id}', [PksController::class, 'getPks']);
        // Route::get('view-pks', function($id){
        //     $data = DB::table('eopr.mst_pks AS pks')->where('pks.mpks_pk', $id)->first();
        //     return response()->json([
        //         'data' => $data
        //     ]);
        // });
        // Route::get('/getTipe/{id}', [MenuController::class, 'getTipemenu']);
        // Route::get('/edit/{id}', [MenuController::class, 'edit']);
        // Route::get('/keyMenu/{id}', [MenuController::class, 'keyMenu']);
    });
    // Route::group(['prefix' => '/wewenang-jabatan', 'as' => 'wewenang-jabatan.'], function() {
    //     Route::get('/wmj_wmn_kode', [WewenangJabatanController::class, 'wmj_wmn_kode']);
    // });
    // Route::resource('users', UserController::class);
    // Route::resource('permissions', PermissionController::class);
});


