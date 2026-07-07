<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|min:4|confirmed',
        ]);

        User::create([
            'name'     => trim($request->name),
            'email'    => trim($request->name) . '@aksilingkungan.com',
            'password' => Hash::make(trim($request->password)),
            'role'     => 'user',
        ]);

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // TRIM: Menghapus spasi di awal dan akhir teks
        $username = trim($request->input('name') ?? $request->input('username') ?? $request->input('email') ?? '');
        $password = trim($request->input('password') ?? '');

        if (!$username || !$password) {
            return redirect()->route('home')->withErrors(['login' => 'Nama pengguna dan password wajib diisi.']);
        }

        // METODE 1: Pakai Auth::attempt (Paling Tangguh)
        // Coba cek sebagai NAMA
        if (Auth::attempt(['name' => $username, 'password' => $password])) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard');
        }

        // Coba cek sebagai EMAIL (Sebagai Cadangan)
        if (Auth::attempt(['email' => $username, 'password' => $password])) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard');
        }

        // Jika semua gagal
        return redirect()->route('home')->withErrors(['login' => 'Nama pengguna atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
