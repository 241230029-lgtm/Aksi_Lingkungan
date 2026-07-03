<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalKegiatan = Kegiatan::count();
        $totalUser = User::where('role', 'user')->count();

        return view('admin.dashboard', compact('totalKegiatan', 'totalUser'));
    }
}