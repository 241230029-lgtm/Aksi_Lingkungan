<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sharing\SharingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKegiatanController;
use App\Http\Controllers\Admin\AdminUserController;

Route::get('/', function () {
    return view('home');
});

Route::get('/sharing', [SharingController::class, 'index'])->name('sharing.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('kegiatan', AdminKegiatanController::class);
    Route::resource('user', AdminUserController::class)->only(['index', 'destroy']);
});