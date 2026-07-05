<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\PendaftaranVolunteerController;
use App\Http\Controllers\Sharing\SharingController;
use App\Http\Controllers\Information\InformationController;

// Impor Controller Admin (Kegiatan & Dashboard)
use App\Http\Controllers\Admin\AdminKegiatanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');
Route::view('/katalog', 'katalog')->name('katalog');
Route::view('/buat-aksi', 'create-aksi')->name('buat-aksi');
Route::view('/tentang', 'about')->name('tentang');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::view('/profil', 'profile')->name('profil');
Route::view('/profil/aktivitas', 'user.aktivitas')->name('aktivitas');
Route::view('/profil/relawan', 'user.relawan')->name('relawan');
Route::view('/profil/pengaturan', 'user.pengaturan')->name('pengaturan');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::view('/dashboard', 'user.dashboard')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| FITUR Eco-Volunteer (Relawan)
|--------------------------------------------------------------------------
*/

Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');
Route::get('/volunteer/{id}', [VolunteerController::class, 'show'])->name('volunteer.show');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');
Route::post('/volunteer/{id}/daftar', [PendaftaranVolunteerController::class, 'store'])
    ->name('volunteer.daftar');

/*
|--------------------------------------------------------------------------
| FITUR Eco-Sharing
|--------------------------------------------------------------------------
*/

Route::get('/sharing', [SharingController::class, 'index'])->name('sharing.index');
Route::get('/sharing/{id}', [SharingController::class, 'show'])->name('sharing.show');

/*
|--------------------------------------------------------------------------
| FITUR Eco-Information (Mading)
|--------------------------------------------------------------------------
*/

Route::get('/information', [InformationController::class, 'index'])->name('information.index');
Route::get('/information/{id}', [InformationController::class, 'show'])->name('information.show');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // FIX: Mengubah dari Route::view menjadi Route::get yang memanggil AdminDashboardController
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])
        ->name('users');

    Route::get('/kegiatan', [AdminKegiatanController::class, 'index'])
        ->name('kegiatan');

    Route::post('/kegiatan/store', [AdminKegiatanController::class, 'store'])
        ->name('kegiatan.store');

    Route::view('/information', 'admin.information-index')
        ->name('information');

    Route::view('/sharing', 'admin.sharing-index')
        ->name('sharing');

    Route::view('/volunteer', 'admin.volunteer-index')
        ->name('volunteer');
});
