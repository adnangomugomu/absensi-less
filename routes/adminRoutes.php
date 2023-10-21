<?php

use App\Http\Controllers\admin\AbsensiController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PertemuanController;
use App\Http\Controllers\admin\RegistrasiController;
use App\Http\Controllers\admin\RekapController;
use App\Http\Controllers\admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth','cekRole:1'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('pertemuan')->group(function(){
        Route::get('/get-table', [PertemuanController::class, 'getDataTable'])->name('admin.pertemuan.getTable');
        Route::get('/', [PertemuanController::class, 'index'])->name('admin.pertemuan');
        Route::get('/create', [PertemuanController::class, 'create'])->name('admin.pertemuan.create');
        Route::get('/detail/{id}', [PertemuanController::class, 'show'])->name('admin.pertemuan.detail');
        Route::get('/edit/{id}', [PertemuanController::class, 'edit'])->name('admin.pertemuan.edit');
        Route::post('/', [PertemuanController::class, 'store'])->name('admin.pertemuan.store');
        Route::put('/{id}', [PertemuanController::class, 'update'])->name('admin.pertemuan.update');
        Route::delete('/{id}', [PertemuanController::class, 'destroy'])->name('admin.pertemuan.delete');
    });

    Route::prefix('absensi')->group(function(){
        Route::get('/get-table/{id}', [AbsensiController::class, 'getDataTable'])->name('admin.absensi.getTable');
        Route::get('/{id}', [AbsensiController::class, 'index'])->name('admin.absensi');
        Route::get('/create/{id}', [AbsensiController::class, 'create'])->name('admin.absensi.create');
        Route::get('/detail/{id}', [AbsensiController::class, 'show'])->name('admin.absensi.detail');
        Route::get('/edit/{id}', [AbsensiController::class, 'edit'])->name('admin.absensi.edit');
        Route::post('/{id}', [AbsensiController::class, 'store'])->name('admin.absensi.store');
        Route::put('/{id}/{idAbsensi}', [AbsensiController::class, 'update'])->name('admin.absensi.update');
        Route::delete('/{id}', [AbsensiController::class, 'destroy'])->name('admin.absensi.delete');
    });

    Route::prefix('rekap')->group(function(){
        Route::get('/get-table', [RekapController::class, 'getDataTable'])->name('admin.rekap.getTable');
        Route::get('/', [RekapController::class, 'index'])->name('admin.rekap');
        Route::get('/detail/{id}', [RekapController::class, 'show'])->name('admin.rekap.detail');
        Route::get('/cetak/{id}', [RekapController::class, 'cetakPdf'])->name('admin.rekap.cetak');
    });

    Route::prefix('role')->group(function(){
        Route::get('/get-table', [RoleController::class, 'getDataTable'])->name('admin.role.getTable');
        Route::get('/', [RoleController::class, 'index'])->name('admin.role');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::get('/detail/{id}', [RoleController::class, 'show'])->name('admin.role.detail');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('/', [RoleController::class, 'store'])->name('admin.role.store');
        Route::put('/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('admin.role.delete');
    });

    Route::prefix('registrasi')->group(function(){
        Route::get('/get-table', [RegistrasiController::class, 'getDataTable'])->name('admin.registrasi.getTable');
        Route::get('/reset-password/{id}', [RegistrasiController::class, 'resetPassword'])->name('admin.registrasi.resetPassword');
        Route::get('/', [RegistrasiController::class, 'index'])->name('admin.registrasi');
        Route::get('/create', [RegistrasiController::class, 'create'])->name('admin.registrasi.create');
        Route::get('/detail/{id}', [RegistrasiController::class, 'show'])->name('admin.registrasi.detail');
        Route::get('/edit/{id}', [RegistrasiController::class, 'edit'])->name('admin.registrasi.edit');
        Route::post('/', [RegistrasiController::class, 'store'])->name('admin.registrasi.store');
        Route::delete('/{id}', [RegistrasiController::class, 'destroy'])->name('admin.registrasi.delete');
    });
});
