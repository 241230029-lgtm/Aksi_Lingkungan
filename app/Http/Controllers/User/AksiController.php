<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AksiController extends Controller
{
    public function create()
    {
        return view('create-aksi');
    }

    public function store(Request $request)
    {
        $rules = [
            'judul'           => 'required|string|max:255',
            'kategori'        => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'          => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        if ($request->kategori == 'Eco-Volunteer') {
            $rules['tanggal_kejadian'] = 'nullable|date';
            $rules['kuota_relawan']   = 'nullable|integer|min:1';
        }

        if ($request->kategori == 'Eco-Sharing') {
            $rules['link_kontak'] = 'required|string|max:255';
        }

        $request->validate($rules);

        $data = $request->only([
            'judul', 'kategori', 'lokasi', 'tanggal_kejadian',
            'kuota_relawan', 'link_kontak', 'deskripsi'
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'Aktif';
        $data['jenis'] = match($request->kategori) {
            'Eco-Sharing'    => 'Barang',
            'Eco-Information' => 'Edukasi',
            'Eco-Volunteer'  => 'Relawan',
            default          => 'Lainnya',
        };

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('katalog')->with('success', 'Aksi lingkungan kamu berhasil dipublikasikan!');
    }
}
