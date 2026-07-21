<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Kegiatan; // Di-import agar bisa konek ke menu Kegiatan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $informations = Kegiatan::where('kategori', 'Eco-Information')->where('status', 'Aktif')->latest()->get();
        return view('information.index', compact('informations'));
    }

    public function show($id)
    {
        $information = Kegiatan::where('kategori', 'Eco-Information')->where('id_kegiatan', $id)->firstOrFail();
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
        $kegiatans = Kegiatan::all(); // Ambil data kegiatan untuk dropdown di form admin

        return view('admin.information-index', compact('informations', 'kegiatans'));
    }

    /**
     * Menyimpan artikel edukasi baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'konten'      => 'required|string',
            'penulis'     => 'required|string|max:100',
            'tanggal'     => 'required|date',
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file'        => 'nullable|mimes:pdf,doc,docx,zip,xls,xlsx|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('information', 'public');
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('information/file', 'public');
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
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'konten'      => 'required|string',
            'penulis'     => 'required|string|max:100',
            'tanggal'     => 'required|date',
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file'        => 'nullable|mimes:pdf,doc,docx,zip,xls,xlsx|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($info->gambar && Storage::disk('public')->exists($info->gambar)) {
                Storage::disk('public')->delete($info->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('information', 'public');
        }

        if ($request->hasFile('file')) {
            if ($info->file && Storage::disk('public')->exists($info->file)) {
                Storage::disk('public')->delete($info->file);
            }
            $data['file'] = $request->file('file')->store('information/file', 'public');
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

        if ($info->file && Storage::disk('public')->exists($info->file)) {
            Storage::disk('public')->delete($info->file);
        }

        $info->delete();

        return redirect()->route('admin.information')->with('success', 'Artikel informasi berhasil dihapus.');
    }
}