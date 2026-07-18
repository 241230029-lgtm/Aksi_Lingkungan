<?php

namespace App\Http\Controllers\Sharing;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
<<<<<<< HEAD
use App\Models\Sharing;
use App\Models\Kegiatan; // 1. Di-import agar bisa konek ke menu Kegiatan
=======
use App\Models\Kegiatan;
>>>>>>> ba27d15 (fix: samakan controller publik Sharing/Information/Volunteer ke tabel kegiatans, perbaiki link detail ke katalog.show)
=======
use App\Models\Kegiatan;
>>>>>>> ea2a8be11c5dd4f232a7a027cc1cb1b2b6bf701f
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk menghapus file lama saat update/destroy jika diperlukan

class SharingController extends Controller
{
    public function index()
    {
        $sharings = Kegiatan::where('kategori', 'Eco-Sharing')->where('status', 'Aktif')->latest()->get();
        return view('sharing.index', compact('sharings'));
    }
<<<<<<< HEAD
<<<<<<< HEAD

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
        $kegiatans = Kegiatan::all(); // 2. Ambil semua data kegiatan untuk dropdown form tambah

        // 3. Oper data sharings dan kegiatans ke view admin
        return view('admin.sharing-index', compact('sharings', 'kegiatans'));
    }

    /**
     * PANEL ADMIN: Menyimpan data sharing baru
     */
    public function adminStore(Request $request)
    {
        // 4. Tambahkan validasi untuk inputan baru: kegiatan_id, tanggal, gambar, dan file
        $data = $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'deskripsi'   => 'required|string',
            'pembuat'     => 'required|string|max:100',
            'tanggal'     => 'required|date', // Sesuai kolom database kamu
            'kegiatan_id' => 'required|exists:kegiatan,id', // Validasi koneksi ke tabel kegiatan
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
            'file'        => 'nullable|mimes:pdf,doc,docx,zip,xls,xlsx|max:5048', // Maksimal 5MB
        ]);

        // 5. Logika upload File Gambar (Sama seperti Volunteer)
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sharing/gambar', 'public');
        }

        // 6. Logika upload File Dokumen
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

        // Validasi data update termasuk rute baru
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

        // Proses update gambar baru jika ada yang di-upload
        if ($request->hasFile('gambar')) {
            if ($sharing->gambar) {
                Storage::disk('public')->delete($sharing->gambar); // Hapus gambar lama
            }
            $data['gambar'] = $request->file('gambar')->store('sharing/gambar', 'public');
        }

        // Proses update file dokumen baru jika ada yang di-upload
        if ($request->hasFile('file')) {
            if ($sharing->file) {
                Storage::disk('public')->delete($sharing->file); // Hapus file lama
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
        
        // Hapus file fisik dari storage saat data di-delete agar tidak menumpuk sampah
        if ($sharing->gambar) {
            Storage::disk('public')->delete($sharing->gambar);
        }
        if ($sharing->file) {
            Storage::disk('public')->delete($sharing->file);
        }

        $sharing->delete();

        return redirect()->route('admin.sharing')->with('success', 'Data sharing diskusi berhasil dihapus.');
    }
=======
>>>>>>> ba27d15 (fix: samakan controller publik Sharing/Information/Volunteer ke tabel kegiatans, perbaiki link detail ke katalog.show)
=======
>>>>>>> ea2a8be11c5dd4f232a7a027cc1cb1b2b6bf701f
}