<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kegiatan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUser      = User::where('role', 'user')->count();
        $totalKegiatan  = Kegiatan::count();

        $totalArtikel   = class_exists('App\Models\Artikel') ? \App\Models\Artikel::count() : 0;
        $totalSharing   = class_exists('App\Models\Sharing') ? \App\Models\Sharing::count() : 0;

        $kegiatanTerbaru = Kegiatan::orderBy('created_at', 'desc')->take(4)->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalKegiatan',
            'totalArtikel',
            'totalSharing',
            'kegiatanTerbaru'
        ));
    }
}
