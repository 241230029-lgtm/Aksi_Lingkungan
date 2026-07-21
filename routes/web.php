<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Impor Controller User & Fitur Umum
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\AksiController;
use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\PendaftaranVolunteerController;
use App\Http\Controllers\Sharing\SharingController;
use App\Http\Controllers\Information\InformationController;
use App\Http\Controllers\KatalogController;

// Impor Controller Admin
use App\Http\Controllers\Admin\AdminKegiatanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;

// Impor Controller Profil Baru
use App\Http\Controllers\User\ProfileController;

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

Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
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
    // ... (kode manajemen user lainnya)
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('users.store');
    Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Manajemen Kegiatan (Umum)
    Route::get('/kegiatan', [AdminKegiatanController::class, 'index'])->name('kegiatan');
    Route::get('/kegiatan/{id}/edit', [AdminKegiatanController::class, 'editJson'])->name('kegiatan.editJson');
    Route::post('/kegiatan/store', [AdminKegiatanController::class, 'store'])->name('kegiatan.store');
    Route::put('/kegiatan/update/{id}', [AdminKegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [AdminKegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    // Manajemen Informasi (Eco-Information)
    Route::get('/information', fn (Request $r) => app(AdminKegiatanController::class)->indexKategori($r, 'Eco-Information'))->name('information');
    Route::post('/information/store', [AdminKegiatanController::class, 'storeKategori'])->name('information.store');
    Route::put('/information/update/{id}', [AdminKegiatanController::class, 'updateKategori'])->name('information.update');
    Route::delete('/information/{id}', [AdminKegiatanController::class, 'destroy'])->name('information.destroy');

    // Manajemen Sharing (Eco-Sharing)
    Route::get('/sharing', fn (Request $r) => app(AdminKegiatanController::class)->indexKategori($r, 'Eco-Sharing'))->name('sharing');
    Route::post('/sharing/store', [AdminKegiatanController::class, 'storeKategori'])->name('sharing.store');
    Route::put('/sharing/update/{id}', [AdminKegiatanController::class, 'updateKategori'])->name('sharing.update');
    Route::delete('/sharing/{id}', [AdminKegiatanController::class, 'destroy'])->name('sharing.destroy');

    // Manajemen Volunteer (Eco-Volunteer)
    Route::get('/volunteer', fn (Request $r) => app(AdminKegiatanController::class)->indexKategori($r, 'Eco-Volunteer'))->name('volunteer');
    Route::post('/volunteer/store', [AdminKegiatanController::class, 'storeKategori'])->name('volunteer.store');
    Route::put('/volunteer/update/{id}', [AdminKegiatanController::class, 'updateKategori'])->name('volunteer.update');
    Route::delete('/volunteer/{id}', [AdminKegiatanController::class, 'destroy'])->name('volunteer.destroy');

});

/*
|--------------------------------------------------------------------------
| FITUR PROFIL DINAMIS
|--------------------------------------------------------------------------
*/
// Tanpa middleware ['auth'] agar serasi dengan login session buatan tim kamu
Route::get('/volunteer/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::patch('/volunteer/profile', [ProfileController::class, 'update'])->name('profile.update');
