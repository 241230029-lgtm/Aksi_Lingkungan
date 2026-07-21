<?php

namespace App\Http\Controllers\Sharing;

use App\Http\Controllers\Controller;
use App\Models\Sharing;
use App\Models\Kegiatan; // Di-import agar bisa konek ke menu Kegiatan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk menghapus file lama saat update/destroy jika diperlukan

class SharingController extends Controller
{
    public function index()
    {
        $sharings = Kegiatan::where('kategori', 'Eco-Sharing')->where('status', 'Aktif')->latest()->get();
        return view('sharing.index', compact('sharings'));
    }

    /**
     * =========================================================================
     * PANEL ADMIN: Menampilkan daftar sharing di halaman admin
     * =========================================================================
     */
    public function adminIndex(Request $request)
    {
        $query = Sharing::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $sharings = $query->latest()->paginate(10);
        $kegiatans = Kegiatan::all(); // Ambil semua data kegiatan untuk dropdown form tambah

        return view('admin.sharing-index', compact('sharings', 'kegiatans'));
    }

    /**
     * PANEL ADMIN: Menyimpan data sharing baru
     */
    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'deskripsi'   => 'required|string',
            'pembuat'     => 'required|string|max:100',
            'tanggal'     => 'required|date',
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'file'        => 'nullable|mimes:pdf,doc,docx,zip,xls,xlsx|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sharing/gambar', 'public');
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('sharing/file', 'public');
        }

        Sharing::create($data);

        return redirect()->route('admin.sharing')->with('success', 'Data sharing diskusi berhasil ditambahkan.');
    }

    /**
     * PANEL ADMIN: Memperbarui data sharing
     */
    public function adminUpdate(Request $request, $id)
    {
        $sharing = Sharing::findOrFail($id);

        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'deskripsi'   => 'required|string',
            'pembuat'     => 'required|string|max:100',
            'tanggal'     => 'required|date',
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'file'        => 'nullable|mimes:pdf,doc,docx,zip,xls,xlsx|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($sharing->gambar) {
                Storage::disk('public')->delete($sharing->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sharing/gambar', 'public');
        }

        if ($request->hasFile('file')) {
            if ($sharing->file) {
                Storage::disk('public')->delete($sharing->file);
            }
            $data['file'] = $request->file('file')->store('sharing/file', 'public');
        }

        $sharing->update($data);

        return redirect()->route('admin.sharing')->with('success', 'Data sharing diskusi berhasil diperbarui.');
    }

    /**
     * PANEL ADMIN: Menghapus data sharing
     */
    public function adminDestroy($id)
    {
        $sharing = Sharing::findOrFail($id);

        if ($sharing->gambar) {
            Storage::disk('public')->delete($sharing->gambar);
        }
        if ($sharing->file) {
            Storage::disk('public')->delete($sharing->file);
        }

        $sharing->delete();

        return redirect()->route('admin.sharing')->with('success', 'Data sharing diskusi berhasil dihapus.');
    }
}