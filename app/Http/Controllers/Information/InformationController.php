<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    /**
     * PUBLIK: Menampilkan daftar artikel informasi untuk masyarakat
     */
    public function index(Request $request)
    {
        $query = Information::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $informations = $query->latest()->get();

        return view('information.index', compact('informations'));
    }

    /**
     * PUBLIK: Menampilkan detail satu artikel informasi
     */
    public function show($id)
    {
        $information = Information::findOrFail($id);

        return view('information.detail', compact('information'));
    }

    /**
     * ADMIN: Menampilkan daftar artikel informasi di panel admin
     */
    public function adminIndex(Request $request)
    {
        $query = Information::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $informations = $query->latest()->paginate(10);

        return view('admin.information-index', compact('informations'));
    }

    /**
     * Menyimpan artikel edukasi baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'konten'   => 'required|string',
            'penulis'  => 'required|string|max:100',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('information', 'public');
        }

        Information::create($data);

        return redirect()->route('admin.information')->with('success', 'Artikel informasi berhasil diterbitkan.');
    }

    /**
     * Memperbarui artikel edukasi
     */
    public function update(Request $request, $id)
    {
        $info = Information::findOrFail($id);

        $data = $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'konten'   => 'required|string',
            'penulis'  => 'required|string|max:100',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($info->gambar && Storage::disk('public')->exists($info->gambar)) {
                Storage::disk('public')->delete($info->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('information', 'public');
        }

        $info->update($data);

        return redirect()->route('admin.information')->with('success', 'Artikel informasi berhasil diperbarui.');
    }

    /**
     * Menghapus artikel secara permanen
     */
    public function destroy($id)
    {
        $info = Information::findOrFail($id);

        if ($info->gambar && Storage::disk('public')->exists($info->gambar)) {
            Storage::disk('public')->delete($info->gambar);
        }

        $info->delete();

        return redirect()->route('admin.information')->with('success', 'Artikel informasi berhasil dihapus.');
    }
}