<?php

namespace App\Http\Controllers\Sharing;

use App\Http\Controllers\Controller;
use App\Models\Sharing;
use Illuminate\Http\Request;

class SharingController extends Controller
{
    /**
     * Tampilan untuk Halaman Depan/Public (Sudah ada di proyek Anda)
     */
    public function index()
    {
        $sharings = Sharing::latest()->get();
        return view('sharing.index', compact('sharings')); // Sesuaikan dengan view public Anda jika ada
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

        return view('admin.sharing-index', compact('sharings'));
    }

    /**
     * PANEL ADMIN: Menyimpan data sharing baru
     */
    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'pembuat'   => 'required|string|max:100',
        ]);

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
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'pembuat'   => 'required|string|max:100',
        ]);

        $sharing->update($data);

        return redirect()->route('admin.sharing')->with('success', 'Data sharing diskusi berhasil diperbarui.');
    }

    /**
     * PANEL ADMIN: Menghapus data sharing
     */
    public function adminDestroy($id)
    {
        $sharing = Sharing::findOrFail($id);
        $sharing->delete();

        return redirect()->route('admin.sharing')->with('success', 'Data sharing diskusi berhasil dihapus.');
    }
}
