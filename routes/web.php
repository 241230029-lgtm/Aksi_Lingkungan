<?php

use Illuminate\Support\Facades\Route;

// 1. IMPORT CONTROLLERS (Menghubungkan Rute ke Kamar Controller)
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\PendaftaranVolunteerController;
use App\Http\Controllers\Sharing\SharingController;
use App\Http\Controllers\Information\InformationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKegiatanController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| 2. RUTE GLOBAL & PUBLIC (Menghubungkan URL ke File Views Global)
|--------------------------------------------------------------------------
*/
// Mengarah ke resources/views/home.blade.php
Route::get('/', function () {
    return view('home');
})->name('home');

// Mengarah ke resources/views/about.blade.php
Route::get('/about', function () {
    return view('about');
})->name('about');


/*
|--------------------------------------------------------------------------
| 3. RUTE FITUR UTAMA (Mengarah ke Controller Fitur masing-masing)
|--------------------------------------------------------------------------
*/
// Fitur Eco-Volunteer (Relawan)
Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');
Route::get('/volunteer/{id}', [VolunteerController::class, 'show'])->name('volunteer.show');

// Fitur Eco-Sharing (Bagi Barang)
Route::get('/sharing', [SharingController::class, 'index'])->name('sharing.index');
Route::get('/sharing/{id}', [SharingController::class, 'show'])->name('sharing.show');

// Fitur Eco-Information (Mading/Artikel)
Route::get('/information', [InformationController::class, 'index'])->name('information.index');
Route::get('/information/{id}', [InformationController::class, 'show'])->name('information.show');


/*
|--------------------------------------------------------------------------
| 4. RUTE AUTENTIKASI (Login & Register)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 5. RUTE AKTOR MASYARAKAT & ADMIN (Proteksi Keamanan)
|--------------------------------------------------------------------------
*/
// Kelompok User Biasa / Masyarakat
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/buat-aksi', function () { return view('create-aksi'); })->name('aksi.create');
    Route::post('/buat-aksi', [VolunteerController::class, 'store'])->name('aksi.store');
    Route::post('/volunteer/{id}/daftar', [PendaftaranVolunteerController::class, 'store'])->name('volunteer.daftar');
});

// Kelompok Akses Admin (Prefix URL: website.com/admin/...)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/kegiatan', [AdminKegiatanController::class, 'index'])->name('kegiatan.index');
    Route::post('/kegiatan/{id}/verifikasi', [AdminKegiatanController::class, 'verify'])->name('kegiatan.verify');
    Route::delete('/kegiatan/{id}', [AdminKegiatanController::class, 'destroy'])->name('kegiatan.destroy');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});
