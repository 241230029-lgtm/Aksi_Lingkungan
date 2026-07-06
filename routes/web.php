<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\AksiController;
use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\PendaftaranVolunteerController;
use App\Http\Controllers\Sharing\SharingController;
use App\Http\Controllers\Information\InformationController;
use App\Http\Controllers\KatalogController;

use App\Http\Controllers\Admin\AdminKegiatanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| PUBLIC & PROFILE
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/{tipe}/{id}', [KatalogController::class, 'show'])->name('katalog.show');
Route::view('/tentang', 'about')->name('tentang');

// ROUTE BIKIN AKSI USER
Route::get('/buat-aksi', [AksiController::class, 'create'])->name('buat-aksi');
Route::post('/buat-aksi', [AksiController::class, 'store'])->name('user.aksi.store');

Route::view('/profil', 'profile')->name('profil');
Route::view('/profil/aktivitas', 'user.aktivitas')->name('aktivitas');
Route::view('/profil/relawan', 'user.relawan')->name('relawan');
Route::view('/profil/pengaturan', 'user.pengaturan')->name('pengaturan');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| FITUR HALAMAN DEPAN
|--------------------------------------------------------------------------
*/
Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');
Route::post('/volunteer/{id}/daftar', [PendaftaranVolunteerController::class, 'store'])->name('volunteer.daftar');

Route::get('/sharing', [SharingController::class, 'index'])->name('sharing.index');

Route::get('/information', [InformationController::class, 'index'])->name('information.index');
Route::get('/information/{id}', [InformationController::class, 'show'])->name('information.show');

/*
|--------------------------------------------------------------------------
| PANEL ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen User
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('users.store');
    Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Manajemen Kegiatan
    Route::get('/kegiatan', [AdminKegiatanController::class, 'index'])->name('kegiatan');
    Route::get('/kegiatan/{id}/edit', [AdminKegiatanController::class, 'editJson'])->name('kegiatan.editJson');
    Route::post('/kegiatan/store', [AdminKegiatanController::class, 'store'])->name('kegiatan.store');
    Route::put('/kegiatan/update/{id}', [AdminKegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [AdminKegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    // Manajemen Informasi
    Route::get('/information', [InformationController::class, 'adminIndex'])->name('information');
    Route::post('/information/store', [InformationController::class, 'store'])->name('information.store');
    Route::put('/information/update/{id}', [InformationController::class, 'update'])->name('information.update');
    Route::delete('/information/{id}', [InformationController::class, 'destroy'])->name('information.destroy');

    // Manajemen Sharing
    Route::get('/sharing', [SharingController::class, 'adminIndex'])->name('sharing');
    Route::post('/sharing/store', [SharingController::class, 'adminStore'])->name('sharing.store');
    Route::put('/sharing/update/{id}', [SharingController::class, 'adminUpdate'])->name('sharing.update');
    Route::delete('/sharing/{id}', [SharingController::class, 'adminDestroy'])->name('sharing.destroy');

    // Manajemen Volunteer
    Route::get('/volunteer', [VolunteerController::class, 'adminIndex'])->name('volunteer');
    Route::post('/volunteer/store', [VolunteerController::class, 'adminStore'])->name('volunteer.store');
    Route::put('/volunteer/update/{id}', [VolunteerController::class, 'adminUpdate'])->name('volunteer.update');
    Route::delete('/volunteer/{id}', [VolunteerController::class, 'adminDestroy'])->name('volunteer.destroy');

});
