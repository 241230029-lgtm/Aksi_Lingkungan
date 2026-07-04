<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sharing\SharingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKegiatanController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| SHARING (FORUM LOGIC)
|--------------------------------------------------------------------------
*/
Route::get('/sharing', [SharingController::class, 'index']);
Route::post('/sharing', [SharingController::class, 'store']);

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index']);
        Route::resource('kegiatan', AdminKegiatanController::class);
        Route::resource('user', AdminUserController::class)
            ->only(['index', 'destroy']);
    });