<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        // SEKARANG AMAN: Memfilter hanya pengguna dengan role 'user' (Masyarakat)
        $users = User::where('role', 'user')->get();

        return view('admin.user-index', compact('users'));
    }
}
