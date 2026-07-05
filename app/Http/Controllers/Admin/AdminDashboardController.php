<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data riil jumlah kegiatan dan user dari database
        $totalKegiatan = Kegiatan::count();
        $totalUser     = User::count(); // Mengambil total user terdaftar

        // 2. Data metrik pembantu (jika model belum ada, diset angka default agar aman)
        $totalArtikel   = class_exists('App\Models\Artikel') ? \App\Models\Artikel::count() : 0;
        $totalSharing   = class_exists('App\Models\Sharing') ? \App\Models\Sharing::count() : 0;
        $totalVolunteer = Kegiatan::where('kategori', 'Eco-Volunteer')->count();

        // 3. Ambil 7 list aktivitas kegiatan terbaru untuk tabel dashboard
        $aktivitasTerbaru = Kegiatan::latest()->take(7)->get();

        // 4. Pastikan semua variabel ini masuk ke dalam compact()
        return view('admin.dashboard', compact(
            'totalKegiatan',
            'totalUser',
            'totalArtikel',
            'totalSharing',
            'totalVolunteer',
            'aktivitasTerbaru'
        ));
    }
}
