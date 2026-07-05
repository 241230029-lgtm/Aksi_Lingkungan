<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    /**
     * Tampilan Fitur Utama Publik / User Front-End
     */
    public function index()
    {
        $kegiatans = Kegiatan::where('kategori', 'Eco-Volunteer')->latest()->get();
        return view('volunteer.index', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::withCount('pendaftarans')->findOrFail($id);

        $jumlahPendaftar = $kegiatan->pendaftarans_count;
        $sudahDaftar = false;

        if (Auth::check()) {
            $sudahDaftar = Pendaftaran::where('kegiatan_id', $kegiatan->id_kegiatan)
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('volunteer.detail', compact('kegiatan', 'jumlahPendaftar', 'sudahDaftar'));
    }

    /**
     * =========================================================================
     * PANEL ADMIN: Manajemen Lowongan Relawan Menggunakan Tabel Kegiatan
     * =========================================================================
     */
    public function adminIndex(Request $request)
    {
        $query = Kegiatan::where('kategori', 'Eco-Volunteer');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $volunteers = $query->latest()->paginate(10);

        return view('admin.volunteer-index', compact('volunteers'));
    }

    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'kategori'       => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'         => 'required|string|max:255',
            'kuota_relawan'  => 'nullable|integer|min:1',
            'deskripsi'      => 'required|string',
            'link_kontak'    => 'nullable|string|max:255',
            'gambar'         => 'nullable|string|max:255',
            'status'         => 'required|in:aktif,selesai',
        ]);

        $data['user_id'] = Auth::id() ?? 1;

        Kegiatan::create($data);

        return redirect()->route('admin.volunteer')->with('success', 'Program lowongan relawan baru berhasil dibuka!');
    }

    public function adminUpdate(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'kategori'       => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'         => 'required|string|max:255',
            'kuota_relawan'  => 'nullable|integer|min:1',
            'deskripsi'      => 'required|string',
            'link_kontak'    => 'nullable|string|max:255',
            'gambar'         => 'nullable|string|max:255',
            'status'         => 'required|in:aktif,selesai',
        ]);

        $kegiatan->update($data);

        return redirect()->route('admin.volunteer')->with('success', 'Informasi program relawan berhasil diperbarui.');
    }

    public function adminDestroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('admin.volunteer')->with('success', 'Program relawan berhasil dihapus dari sistem.');
    }
}
