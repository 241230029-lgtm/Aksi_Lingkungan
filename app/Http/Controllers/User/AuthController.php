<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function login(Request $request) {}
    public function showRegister() { return view('auth.register'); }
    public function register(Request $request) {}
    public function logout() {}
}
