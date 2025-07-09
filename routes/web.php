<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\CapaianController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UkmController;
use App\Models\Anggota;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    // Route UKM
    Route::get('/ukm', [UkmController::class, 'index'])->name('ukm.index');
    Route::get('/ukm/create', [UkmController::class, 'create'])->name('ukm.create');
    Route::post('/ukm', [UkmController::class, 'store'])->name('ukm.store');
    Route::get('/ukm/edit/{ukm}', [UkmController::class, 'edit'])->name('ukm.edit');
    Route::put('/ukm/{ukm}', [UkmController::class, 'update'])->name('ukm.update');
    Route::delete('ukm/{ukm}', [UkmController::class, 'delete'])->name('ukm.delete');

    //Route Anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/edit/{anggota}', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{anggota}', [AnggotaController::class, 'delete'])->name('anggota.delete');

    //Route Kegiatan
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
    // Untuk AJAX ambil anggota berdasarkan UKM
    Route::get('/get-anggota-by-ukm/{id}', function ($id) {
        return Anggota::where('ukm_id', $id)->get();
    });
    Route::post('/kegiatan', [KegiatanController::class,'store'], )->name('kegiatan.store');
    Route::get('/kegiatan/edit/{kegiatan}', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{kegiatan}', [KegiatanController::class, 'delete'])->name('kegiatan.delete');

     //Route Capaian
    Route::get('/capaian', [CapaianController::class, 'index'])->name('capaian.index');
    Route::get('/capaian/create', [CapaianController::class, 'create'])->name('capaian.create');
    // Untuk AJAX ambil anggota berdasarkan UKM
    Route::get('/get-anggota-by-ukm/{id}', function ($id) {
        return Anggota::where('ukm_id', $id)->get();
    });
    Route::post('/capaian', [CapaianController::class, 'store'])->name('capaian.store');
    Route::get('/capaian/edit/{capaian}', [CapaianController::class, 'edit'])->name('capaian.edit');
    Route::put('/capaian/{capaian}', [CapaianController::class, 'update'])->name('capaian.update');
    Route::delete('/capaian/{capaian}', [CapaianController::class, 'delete'])->name('capaian.delete');;
});
