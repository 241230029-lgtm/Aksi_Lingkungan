<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman register.
     * (Sementara tidak digunakan pada mode demo)
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Register dinonaktifkan sementara.
     */
    public function register(Request $request)
    {
        return redirect()->back()->with(
            'error',
            'Registrasi dinonaktifkan pada mode demo.'
        );
    }

    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Login Demo.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = strtolower(trim($request->username));
        $password = $request->password;

        // ===========================
        // LOGIN ADMIN
        // ===========================

        if ($username === 'admin' && $password === 'admin123') {

            Session::put('login', true);
            Session::put('role', 'admin');
            Session::put('name', 'Administrator');

            return redirect()->route('admin.dashboard');
        }

        // ===========================
        // LOGIN MASYARAKAT
        // ===========================

        if ($username === 'masyarakat' && $password === 'masyarakat123') {

            Session::put('login', true);
            Session::put('role', 'user');
            Session::put('name', 'Masyarakat');

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login' => 'Pengguna atau password salah.',
        ]);
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Session::flush();

        return redirect()->route('home');
    }
}
