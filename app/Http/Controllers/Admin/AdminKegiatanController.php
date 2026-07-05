<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminKegiatanController extends Controller
{
    /**
     * Menampilkan semua data kegiatan dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        // Fitur pencarian berdasarkan judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Menggunakan pagination 10 data per halaman
        $kegiatan = $query->latest()->paginate(10);

        return view('admin.kegiatan-index', compact('kegiatan'));
    }

    /**
     * Menyimpan data kegiatan baru ke MySQL.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'          => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'deskripsi'         => 'required|string',
            'lokasi'            => 'required|string|max:255',
            'tanggal_kejadian'  => 'nullable|date',
            'kuota_relawan'     => 'nullable|integer|min:1',
            'link_kontak'       => 'nullable|string|max:255',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'            => 'required|in:aktif,selesai',
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan')
            ->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    /**
     * Memperbarui data kegiatan (Update).
     */
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $data = $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'          => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'deskripsi'         => 'required|string',
            'lokasi'            => 'required|string|max:255',
            'tanggal_kejadian'  => 'nullable|date',
            'kuota_relawan'     => 'nullable|integer|min:1',
            'link_kontak'       => 'nullable|string|max:255',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'            => 'required|in:aktif,selesai',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan')
            ->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    /**
     * Menghapus data kegiatan secara permanen.
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')
            ->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
