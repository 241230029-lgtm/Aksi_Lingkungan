<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Sharing;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AksiController extends Controller
{
    // Menampilkan halaman form
    public function create()
    {
        return view('create-aksi');
    }

    // Menyimpan data ke tabel yang sesuai dengan kategori yang dipilih
    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'           => 'required_if:kategori,Eco-Volunteer|nullable|string|max:255',
            'tanggal_kejadian' => 'nullable|date',
            'deskripsi'        => 'required|string',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $namaPengguna = auth()->user()->name ?? 'Masyarakat';

        switch ($request->kategori) {

            case 'Eco-Sharing':
                Sharing::create([
                    'judul'     => $request->judul,
                    'kategori'  => $request->kategori,
                    'deskripsi' => $request->deskripsi,
                    'pembuat'   => $namaPengguna,
                ]);
                break;

            case 'Eco-Information':
                $gambarPath = null;
                if ($request->hasFile('gambar')) {
                    $gambarPath = $request->file('gambar')->store('information', 'public');
                }

                Information::create([
                    'judul'    => $request->judul,
                    'kategori' => $request->kategori,
                    'konten'   => $request->deskripsi,
                    'penulis'  => $namaPengguna,
                    'gambar'   => $gambarPath,
                ]);
                break;

            default: // Eco-Volunteer
                $data = $request->only(['judul', 'kategori', 'lokasi', 'tanggal_kejadian', 'deskripsi']);
                $data['user_id'] = auth()->id();
                $data['status'] = 'aktif';

                if ($request->hasFile('gambar')) {
                    $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
                }

                Kegiatan::create($data);
                break;
        }

        return redirect()->route('katalog')->with('success', 'Aksi lingkungan kamu berhasil dipublikasikan!');
    }
}