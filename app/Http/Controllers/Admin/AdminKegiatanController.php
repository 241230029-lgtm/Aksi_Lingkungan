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
     * Menampilkan semua data kegiatan.
     */
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        // Fitur pencarian berdasarkan judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $kegiatan = $query->latest()->paginate(10);

        return view('admin.kegiatan-index', compact('kegiatan'));
    }

    /**
     * Menampilkan form tambah kegiatan.
     */
    public function create()
    {
        return view('admin.kegiatan-create');
    }

    /**
     * Menyimpan data kegiatan.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'             => 'required|string|max:255',
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

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kegiatan.
     */
    public function show(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan-show', compact('kegiatan'));
    }

    /**
     * Menampilkan form edit kegiatan.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan-edit', compact('kegiatan'));
    }

    /**
     * Memperbarui data kegiatan.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $data = $request->validate([
            'judul'             => 'required|string|max:255',
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

            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    /**
     * Menghapus data kegiatan.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil dihapus.');
    }
}