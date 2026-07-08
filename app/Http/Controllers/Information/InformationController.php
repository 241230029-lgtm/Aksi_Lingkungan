<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Kegiatan; // 1. Di-import agar bisa konek ke menu Kegiatan
use Illuminate\Http\Request;

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
        $kegiatans = Kegiatan::all(); // 2. Ambil data kegiatan untuk dropdown di form admin

        // 3. Oper $kegiatans ke view admin Anda
        return view('admin.information-index', compact('informations', 'kegiatans'));
    }

    /**
     * Menyimpan artikel edukasi baru
     */
    public function store(Request $request)
    {
        // 4. Tambahkan validasi tanggal, kegiatan_id, dan file dokumen
        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'konten'      => 'required|string',
            'penulis'     => 'required|string|max:100',
            'tanggal'     => 'required|date', // Input tanggal baru
            'kegiatan_id' => 'required|exists:kegiatan,id', // Konek ke kegiatan
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file'        => 'nullable|mimes:pdf,doc,docx,zip,xls,xlsx|max:5048', // Input file baru
        ]);

        // Proses simpan gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('information', 'public');
        }

        // 5. Logika proses simpan file dokumen baru
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

        // Tambahkan validasi tanggal, kegiatan_id, dan file pada update
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

        // Update gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            if ($info->gambar && Storage::disk('public')->exists($info->gambar)) {
                Storage::disk('public')->delete($info->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('information', 'public');
        }

        // 6. Update file dokumen jika ada file baru
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

        // Hapus gambar dari storage
        if ($info->gambar && Storage::disk('public')->exists($info->gambar)) {
            Storage::disk('public')->delete($info->gambar);
        }

        // 7. Hapus file dokumen dari storage saat data dihapus
        if ($info->file && Storage::disk('public')->exists($info->file)) {
            Storage::disk('public')->delete($info->file);
        }

        $info->delete();

        return redirect()->route('admin.information')->with('success', 'Artikel informasi berhasil dihapus.');
    }
}