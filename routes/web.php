<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\PendaftaranVolunteerController;
use App\Http\Controllers\Sharing\SharingController;
use App\Http\Controllers\Information\InformationController;
use App\Http\Controllers\KatalogController;

// Impor Controller Admin
use App\Http\Controllers\Admin\AdminKegiatanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| PUBLIC & PROFILE & AUTH
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::view('/buat-aksi', 'create-aksi')->name('buat-aksi');
Route::view('/tentang', 'about')->name('tentang');

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

Route::view('/dashboard', 'user.dashboard')->name('dashboard');

/*
|--------------------------------------------------------------------------
| FITUR-FITUR UTAMA (HALAMAN DEPAN)
|--------------------------------------------------------------------------
*/
Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');
Route::get('/volunteer/{id}', [VolunteerController::class, 'show'])->name('volunteer.show');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');
Route::post('/volunteer/{id}/daftar', [PendaftaranVolunteerController::class, 'store'])->name('volunteer.daftar');

/*
|--------------------------------------------------------------------------
| FITUR Eco-Sharing
|--------------------------------------------------------------------------
*/

Route::get('/sharing', [SharingController::class, 'index'])->name('sharing.index');
Route::get('/sharing/{id}', [SharingController::class, 'show'])->name('sharing.show');

Route::get('/information', [InformationController::class, 'index'])->name('information.index');
Route::get('/information/{id}', [InformationController::class, 'show'])->name('information.show');

/*
|--------------------------------------------------------------------------
| PANEL ADMIN (FIXED & FULLY SYNCHRONIZED)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Rute Side Manajemen User (Masyarakat)
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('users.store');
    Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->name('users.update');

    // Rute Side Manajemen Kegiatan
    Route::get('/kegiatan', [AdminKegiatanController::class, 'index'])->name('kegiatan');
    Route::post('/kegiatan/store', [AdminKegiatanController::class, 'store'])->name('kegiatan.store');
    Route::put('/kegiatan/update/{id}', [AdminKegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [AdminKegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    // Rute Side Manajemen Informasi (SUDAH DIBERSIHKAN DARI ROUTE::VIEW)
    Route::get('/information', [InformationController::class, 'index'])->name('information');
    Route::post('/information/store', [InformationController::class, 'store'])->name('information.store');
    Route::put('/information/update/{id}', [InformationController::class, 'update'])->name('information.update');
    Route::delete('/information/{id}', [InformationController::class, 'destroy'])->name('information.destroy');

// Ubah baris sharing menjadi seperti ini di dalam group admin Anda:
    Route::get('/sharing', [SharingController::class, 'adminIndex'])->name('sharing');
    Route::post('/sharing/store', [SharingController::class, 'adminStore'])->name('sharing.store');
    Route::put('/sharing/update/{id}', [SharingController::class, 'adminUpdate'])->name('sharing.update');
    Route::delete('/sharing/{id}', [SharingController::class, 'adminDestroy'])->name('sharing.destroy');




// Ganti baris volunteer lama di dalam Group Admin Anda menjadi seperti ini:
    Route::get('/volunteer', [VolunteerController::class, 'adminIndex'])->name('volunteer');
    Route::post('/volunteer/store', [VolunteerController::class, 'adminStore'])->name('volunteer.store');
    Route::put('/volunteer/update/{id}', [VolunteerController::class, 'adminUpdate'])->name('volunteer.update');
    Route::delete('/volunteer/{id}', [VolunteerController::class, 'adminDestroy'])->name('volunteer.destroy');


    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/users', 'admin.user-index')->name('users');
    Route::view('/kegiatan', 'admin.kegiatan-index')->name('kegiatan');
    Route::view('/information', 'admin.information-index')->name('information');
    Route::view('/sharing', 'admin.sharing-index')->name('sharing');
    Route::view('/volunteer', 'admin.volunteer-index')->name('volunteer');
});
