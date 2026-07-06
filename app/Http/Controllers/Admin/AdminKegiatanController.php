<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $kegiatan = Kegiatan::when($request->search, function ($query, $search) {
            $query->where('judul', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function editJson($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return response()->json($kegiatan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'kategori'        => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'          => 'required|string|max:255',
            'tanggal_kejadian'=> 'nullable|date',
            'kuota_relawan'   => 'nullable|integer|min:1',
            'link_kontak'     => 'nullable|url',
            'deskripsi'       => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'          => 'required|in:aktif,selesai',
        ]);

        $data = $request->only([
            'judul', 'kategori', 'lokasi', 'tanggal_kejadian',
            'kuota_relawan', 'link_kontak', 'deskripsi', 'status'
        ]);

        // TAMBAHKAN INI: Set user_id default karena admin login manual
            $data['user_id'] = auth()->id();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul'           => 'required|string|max:255',
            'kategori'        => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'          => 'required|string|max:255',
            'tanggal_kejadian'=> 'nullable|date',
            'kuota_relawan'   => 'nullable|integer|min:1',
            'link_kontak'     => 'nullable|url',
            'deskripsi'       => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'          => 'required|in:aktif,selesai',
        ]);

        $data = $request->only([
            'judul', 'kategori', 'lokasi', 'tanggal_kejadian',
            'kuota_relawan', 'link_kontak', 'deskripsi', 'status'
        ]);

        // PERTAHANKAN user_id LAMA
        $data['user_id'] = $kegiatan->user_id;

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
