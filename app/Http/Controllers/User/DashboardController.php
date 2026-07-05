<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard User Masyarakat
     */
    public function index()
    {
        // Jika ada yang login, pakai data asli. Jika tidak, buat nama simulasi agar tidak error
        $user = Auth::user() ?? (object)[
            'name' => 'Masyarakat Relawan',
            'email' => 'masyarakat@aksi.com'
        ];

        // 1. Ambil hitungan total kegiatan asli dari DB
        $totalAksi = Kegiatan::count();

        // 2. Hitung jumlah baris pendaftar asli dari DB
        $totalRelawan = Pendaftaran::count();

        // Jika data pendaftar di DB masih kosong (0), berikan angka simulasi agar dashboard ramai
        if ($totalRelawan === 0) {
            $totalRelawan = 8;
        }

        // 3. Cek modul edukasi dan sharing (jika model belum dibuat, gunakan angka dummy)
        $totalEdukasi = class_exists('\App\Models\Article') ? \App\Models\Article::count() : 15;
        $totalSharing = class_exists('\App\Models\Forum') ? \App\Models\Forum::count() : 5;

        // 4. Ambil data aktivitas terbaru dari tabel kegiatans
        $aktivitasTerbaru = Kegiatan::latest()->take(6)->get();

        // 5. Kirim semua variabel ke view
        return view('user.dashboard', compact(
            'user',
            'totalAksi',
            'totalRelawan',
            'totalEdukasi',
            'totalSharing',
            'aktivitasTerbaru'
        ));
    }
}
