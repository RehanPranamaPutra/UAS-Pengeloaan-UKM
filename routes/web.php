<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\CapaianController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UkmController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    // Route UKM
    Route::get('/ukm',[UkmController::class,'index'])->name('ukm.index');
    Route::get('/ukm/create',[UkmController::class,'create'])->name('ukm.create');
    Route::post('/ukm',[UkmController::class,'store'])->name('ukm.store');
    Route::get('/ukm/edit/{ukm}',[UkmController::class,'edit'])->name('ukm.edit');
    Route::put('/ukm/{ukm}',[UkmController::class,'update'])->name('ukm.update');
    Route::delete('ukm/{ukm}',[UkmController::class,'delete'])->name('ukm.delete');

    //Route Anggota
    Route::get('/anggota',[AnggotaController::class,'index'])->name('anggota.index');
    Route::get('/anggota/create',[AnggotaController::class,'create'])->name('anggota.create');
    Route::post('/anggota',[AnggotaController::class],'store')->name('anggota.store');
    Route::get('/anggota/edit/{anggota}',[AnggotaController::class,'edit'])->name('anggota.edit');
    Route::put('/anggota/{anggota}', [AnggotaController::class,'update'])->name('anggota.update');
    Route::delete('/anggota/{anggota}', [AnggotaController::class,'delete'])->name('anggota.delete');


    Route::resource('/kegiatan',KegiatanController::class);
    Route::resource('/capaian',CapaianController::class);
});
