<?php

use App\Http\Controllers\Sdm\DirektoratController;
use App\Http\Controllers\Sdm\JabatanController;
use App\Http\Controllers\Sdm\LevelJabatanController;
use App\Http\Controllers\Sdm\KeahlianKhususController;
use App\Http\Controllers\Sdm\MasPegawaiController;
use App\Http\Controllers\Sdm\DivisiController;
use App\Http\Controllers\Sdm\BagianController;
use App\Http\Controllers\Sdm\DaftarpegController;
use App\Http\Controllers\Sdm\CutiController;

use App\Http\Controllers\Sdm\DinasController;
use App\Http\Controllers\Sdm\KehadiranController;
use App\Http\Controllers\Sdm\FormTelatCepatController;

use App\Http\Controllers\Sdm\FormSakitController;
use App\Http\Controllers\Sdm\LihatSakitController;
use App\Http\Controllers\Sdm\PelatihanController;
use App\Http\Controllers\Sdm\LihatPelatihanController;
use App\Http\Controllers\Sdm\LemburController;

use App\Http\Controllers\Sdm\LihatTiketLayananController;
use App\Http\Controllers\Sdm\LihatKeahlianController;

use App\Http\Controllers\Sdm\LihatInventarisController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/sdm', 'as' => 'sdm.'], function () {




  Route::resource('maspeg', MasPegawaiController::class);


  Route::resource('dafpeg', DaftarpegController::class);

  Route::resource('appcuti', CutiController::class);

  Route::resource('lihatdinas', DinasController::class);
  Route::resource('hadir', KehadiranController::class);
  Route::resource('lhttelat', FormTelatCepatController::class);

  Route::resource('lhtsakit', LihatSakitController::class);
  Route::resource('pelatihan', PelatihanController::class);
  Route::resource('lhtpelatihan', LihatPelatihanController::class);
  Route::resource('lembur', LemburController::class);
  Route::resource('lhtlembur', LemburController::class);
  Route::resource('lhtdir', DirektoratController::class);
  Route::resource('lhttiket', LihatTiketLayananController::class);
  Route::resource('lhtjab', JabatanController::class);
  Route::resource('lhtlvljab', LihatLvlJabatanController::class);
  Route::resource('lhtahli', KeahlianKhususController::class);
  Route::resource('lhtdiv', DivisiController::class);
  Route::resource('lhtbag', BagianController::class);
  Route::resource('lhtinven', LihatInventarisController::class);

  Route::group(['prefix' => '/dirsdm', 'as' => 'dirsdm.', 'middleware' => 'auth'], function () {
    Route::resource('direktorat', DirektoratController::class);
    Route::get('ambilData', [DirektoratController::class, 'ambilData'])->name('ambilData');
  });

  Route::group(['prefix' => '/jabsdm', 'as' => 'jabsdm.', 'middleware' => 'auth'], function () {
    Route::resource('jabatan', JabatanController::class);

  });

  Route::group(['prefix' => '/lvlsdm', 'as' => 'lvlsdm.', 'middleware' => 'auth'], function () {
    Route::resource('lvljab', LevelJabatanController::class);

  });

  Route::group(['prefix' => '/ahlsdm', 'as' => 'ahlsdm.', 'middleware' => 'auth'], function () {
    Route::resource('ahlikus', KeahlianKhususController::class);

  });

  Route::group(['prefix' => '/divsdm', 'as' => 'divsdm.', 'middleware' => 'auth'], function () {
    Route::resource('divisi', DivisiController::class);

  });

  Route::group(['prefix' => '/bagsdm', 'as' => 'bagsdm.', 'middleware' => 'auth'], function () {
    Route::resource('bagian', BagianController::class);

  });

  Route::group(['prefix' => '/cutsdm', 'as' => 'cutsdm.', 'middleware' => 'auth'], function () {
    Route::resource('inpcuti', CutiController::class);

  });

  Route::group(['prefix' => '/dinsdm', 'as' => 'dinsdm.', 'middleware' => 'auth'], function () {
    Route::resource('inpdinas', DinasController::class);

  });

  Route::group(['prefix' => '/tltsdm', 'as' => 'tltsdm.', 'middleware' => 'auth'], function () {
    Route::resource('telat', FormTelatCepatController::class);

  });

  Route::group(['prefix' => '/sktsdm', 'as' => 'sktsdm.', 'middleware' => 'auth'], function () {
    Route::resource('sakit', FormSakitController::class);
  });
});

