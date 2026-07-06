<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AksiController extends Controller
{
    // Menampilkan halaman form
    public function create()
    {
        return view('create-aksi');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'kategori'        => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'          => 'required|string|max:255',
            'tanggal_kejadian'=> 'nullable|date',
            'deskripsi'       => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['judul', 'kategori', 'lokasi', 'tanggal_kejadian', 'deskripsi']);

        // Set user_id sesuai yang login, dan status otomatis aktif
        $data['user_id'] = auth()->id();
        $data['status'] = 'aktif';

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('katalog')->with('success', 'Aksi lingkungan kamu berhasil dipublikasikan!');
    }
}
