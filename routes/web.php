<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKegiatanController;
use App\Http\Controllers\Admin\AdminUserController;

// User / Auth
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;

// Volunteer
use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\PendaftaranVolunteerController;

// Sharing
use App\Http\Controllers\Sharing\SharingController;

// Information (Mading)
use App\Http\Controllers\Information\InformationController;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| RUTE AUTENTIKASI
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| RUTE FITUR Eco-Volunteer (Relawan)
|--------------------------------------------------------------------------
*/
Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');
Route::get('/volunteer/{id}', [VolunteerController::class, 'show'])->name('volunteer.show');

/*
|--------------------------------------------------------------------------
| RUTE FITUR Eco-Sharing
|--------------------------------------------------------------------------
*/
Route::get('/sharing', [SharingController::class, 'index'])->name('sharing.index');
Route::get('/sharing/{id}', [SharingController::class, 'show'])->name('sharing.show');

/*
|--------------------------------------------------------------------------
| RUTE FITUR Eco-Information (Mading)
|--------------------------------------------------------------------------
*/
Route::get('/information', [InformationController::class, 'index'])->name('information.index');
Route::get('/information/{id}', [InformationController::class, 'show'])->name('information.show');

/*
|--------------------------------------------------------------------------
| RUTE KHUSUS USER LOGIN (Masyarakat)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Membuat aksi/kegiatan volunteer baru
    Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');

    // Mendaftar sebagai relawan pada kegiatan tertentu
    Route::post('/volunteer/{id}/daftar', [PendaftaranVolunteerController::class, 'store'])
        ->name('volunteer.daftar');
});

/*
|--------------------------------------------------------------------------
| RUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('kegiatan', AdminKegiatanController::class);
    Route::resource('user', AdminUserController::class)->only(['index', 'destroy']);
});