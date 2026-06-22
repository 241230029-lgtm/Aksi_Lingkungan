<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    // Menampilkan semua daftar lowongan relawan
    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('volunteer.index', compact('kegiatans'));
    }

    // Menampilkan detail salah satu lowongan relawan
    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('volunteer.detail', compact('kegiatan'));
    }

    // Menyimpan aksi/kegiatan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'lokasi'      => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'kuota'       => 'required|integer|min:1',
        ]);

        Kegiatan::create([
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'lokasi'      => $request->lokasi,
            'tanggal'     => $request->tanggal,
            'kuota'       => $request->kuota,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('volunteer.index')->with('success', 'Kegiatan berhasil dibuat.');
    }
}