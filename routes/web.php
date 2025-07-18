<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CapaianController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\UserController;
use App\Models\Anggota;
use Illuminate\Support\Facades\Route;

Route::get('/',[LandingController::class,'index'])->name('landing.index');
Route::get('/ukm/{slug}',[LandingController::class,'show'])->name('landing.ukm.detail');

//route admin
Route::prefix('admin')->middleware('auth')->group(function () {
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
    Route::post('/kegiatan', [KegiatanController::class,'store'], )->name('kegiatan.store');
    Route::get('/kegiatan/edit/{kegiatan}', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{kegiatan}', [KegiatanController::class, 'delete'])->name('kegiatan.delete');

     //Route Capaian
    Route::get('/capaian', [CapaianController::class, 'index'])->name('capaian.index');
    Route::get('/capaian/create', [CapaianController::class, 'create'])->name('capaian.create');
    Route::post('/capaian', [CapaianController::class, 'store'])->name('capaian.store');
    Route::get('/capaian/edit/{capaian}', [CapaianController::class, 'edit'])->name('capaian.edit');
    Route::put('/capaian/{capaian}', [CapaianController::class, 'update'])->name('capaian.update');
    Route::delete('/capaian/{capaian}', [CapaianController::class, 'delete'])->name('capaian.delete');

    // Route User
    Route::get('/user',[UserController::class,'index'])->name('user.index');
    Route::get('/user/create',[UserController::class,'create'])->name('user.create');
    Route::post('/user',[UserController::class,'store'])->name('user.store');
    Route::get('/user/edit/{user}',[UserController::class,'edit'])->name('user.edit');
    Route::put('/user/{user}',[UserController::class,'update'])->name('user.update');
    Route::delete('/user/{user}',[UserController::class,'delete'])->name('user.delete');
});

Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.submit');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


