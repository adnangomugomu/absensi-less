<?php

use App\Http\Controllers\user\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware(['auth','cekRole:2'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
});
