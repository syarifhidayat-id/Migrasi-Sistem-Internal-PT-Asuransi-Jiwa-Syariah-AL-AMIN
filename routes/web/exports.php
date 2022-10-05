<?php

use Illuminate\Support\Facades\Route;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GolonganExport;
use App\Http\Controllers\Master\GolonganController;

Route::middleware('auth')->group(function() {
    Route::prefix('export')->group(function(){
        Route::get('template/underwriting', function () {
            $file = public_path('excel/template import underwriting.xlsx');
            $name = 'Template Import Underwriting.xlsx';
            return response()->download($file, $name);
        });
        Route::get('template/tarif', function () {
            $file = public_path('excel/template import tarif.xlsx');
            $name = 'Template Import Tarif.xlsx';
            return response()->download($file, $name);
        });

        Route::get('golongan', [GolonganController::class, 'exportGolongan'])->name('export.golongan');
        
    });
});