<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard user.
     */
    public function index()
    {
        // Semua kegiatan yang masih aktif
        $kegiatans = Kegiatan::where('status', 'aktif')
            ->latest()
            ->get();

        // Data user yang sedang login
        $user = Auth::user();

        return view('user.dashboard', compact('kegiatans', 'user'));
    }
}