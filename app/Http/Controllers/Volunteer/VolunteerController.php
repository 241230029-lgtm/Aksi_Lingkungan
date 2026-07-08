<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::where('kategori', 'Eco-Volunteer')->where('status', 'Aktif')->latest()->get();
        return view('volunteer.index', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::withCount('pendaftarans')->findOrFail($id);
        $jumlahPendaftar = $kegiatan->pendaftarans_count;

        $sudahDaftar = false;
        if (Auth::check()) {
            $sudahDaftar = Pendaftaran::where('kegiatan_id', $kegiatan->id_kegiatan)
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('volunteer.detail', compact('kegiatan', 'jumlahPendaftar', 'sudahDaftar'));
    }
}