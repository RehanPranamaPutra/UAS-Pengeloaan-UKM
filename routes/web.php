<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\CapaianController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UkmController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::resource('/ukm',UkmController::class);
    Route::resource('/kegiatan',KegiatanController::class);
    Route::resource('/anggota',AnggotaController::class);
    Route::resource('/capaian',CapaianController::class);
});
