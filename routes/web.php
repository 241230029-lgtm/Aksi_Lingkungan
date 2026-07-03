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

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::view('/profil', 'profile')->name('profil');
Route::view('/profil/aktivitas', 'user.aktivitas')->name('aktivitas');
Route::view('/profil/relawan', 'user.relawan')->name('relawan');
Route::view('/profil/pengaturan', 'user.pengaturan')->name('pengaturan');
Route::view('/logout', 'user.logout')->name('logout');

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
| ADMIN (Frontend/UI Only)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::view('/dashboard', 'admin.dashboard')
        ->name('dashboard');

    Route::view('/users', 'admin.user-index')
        ->name('users');

    Route::view('/kegiatan', 'admin.kegiatan-index')
        ->name('kegiatan');

    Route::view('/information', 'admin.information-index')
        ->name('information');

    Route::view('/sharing', 'admin.sharing-index')
        ->name('sharing');

    Route::view('/volunteer', 'admin.volunteer-index')
        ->name('volunteer');
});