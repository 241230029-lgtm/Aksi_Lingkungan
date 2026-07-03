<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');

Route::view('/katalog', 'katalog')->name('katalog');

Route::view('/buat-aksi', 'create-aksi')->name('buat-aksi');

Route::view('/tentang', 'about')->name('tentang');

Route::view('/profil', 'profile')->name('profil');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::view('/login', 'auth.login')->name('login');

Route::view('/register', 'auth.register')->name('register');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::view('/dashboard', 'user.dashboard')->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN (Frontend / UI Only)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'admin.dashboard')
        ->name('dashboard');

    // User
    Route::view('/users', 'admin.user-index')
        ->name('users');

    // Kegiatan
    Route::view('/kegiatan', 'admin.kegiatan-index')
        ->name('kegiatan');

    // Informasi
    Route::view('/information', 'admin.information-index')
        ->name('information');

    // Sharing
    Route::view('/sharing', 'admin.sharing-index')
        ->name('sharing');

    // Volunteer
    Route::view('/volunteer', 'admin.volunteer-index')
        ->name('volunteer');
});