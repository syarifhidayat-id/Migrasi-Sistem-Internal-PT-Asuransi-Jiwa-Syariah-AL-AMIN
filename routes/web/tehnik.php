<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\DaftarUserController;
use App\Http\Controllers\Tehnik\PolisController;
use App\Http\Controllers\Tehnik\EntryPolisController;
use App\Http\Controllers\Utility\PermissionController;
use App\Http\Controllers\Utility\WewenangJabatanController;
use App\Http\Controllers\tehnik\polis\ApprovalMasterPolisController;
use App\Http\Controllers\Tehnik\Soc\EntrySocController;
use App\Http\Controllers\Tehnik\Soc\LihatSocController;
use App\Http\Controllers\Tehnik\Soc\UploadTarifController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {
    Route::resource('/lihat-polis', PolisController::class);
    // Route::get('/entry-master-polis', [EntryPolisController::class, 'index'])->name('entry-master-polis.index');
    // Route::post('/entry-master-polis/store', [EntryPolisController::class, 'store'])->name('entry-master-polis.store');

//   Route::group(['prefix' => '/polis', 'as' => 'polis.'], function () {
//     Route::resource('/lihat-polis', PolisController::class);
//     Route::resource('/entry-master-polis', EntryPolisController::class);
//     // Route::prefix('/entry-master-polis')->name('entry-master-polis.')->controller(EntryPolisController::class)->group(function() {
//     //     Route::post('/store', 'store');
//     // });
//   });


  Route::group(['prefix' => '/polis', 'as' => 'polis.'], function() {
    Route::resource('/entry-master-polis', EntryPolisController::class);
    Route::resource('/approval-master-polis', ApprovalMasterPolisController::class);
  });

  Route::group(['prefix' => '/soc', 'as' => 'soc.'], function() {
    Route::resource('/entry-soc', EntrySocController::class);
    Route::resource('/lihat-soc', LihatSocController::class);
  });

});


// Route::group(['prefix' => '/tehnik', 'as' => 'tehnik.'], function () {

//     Route::resource('/lihat-polis', PolisController::class);
//     Route::resource('/entry-master-polis', EntryPolisController::class);
//     // Route::prefix('/menu')->name('menu.')->controller(MenuController::class)->group(function() {
//     //     Route::get('/getTipe/{id}', 'getTipemenu');
//     //     Route::get('/edit/{id}', 'edit');
//     //     Route::get('/keyMenu/{id}', 'keyMenu');
//     // });
//     // Route::resource('users', UserController::class);
//     // Route::resource('permissions', PermissionController::class);
// });

