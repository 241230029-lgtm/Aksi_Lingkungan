<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran; // Menggunakan model Pendaftaran sesuai database Anda
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    /**
     * Tampilan Fitur Utama Publik / User Front-End
     */
    public function index()
    {
        $volunteers = Pendaftaran::latest()->get();
        return view('volunteer.index', compact('volunteers'));
    }

    public function show($id)
    {
        $volunteer = Pendaftaran::findOrFail($id);
        return view('volunteer.show', compact('volunteer'));
    }

    /**
     * =========================================================================
     * PANEL ADMIN: Manajemen Lowongan Relawan Menggunakan Tabel Pendaftarans
     * =========================================================================
     */
    public function adminIndex(Request $request)
    {
        $query = Pendaftaran::query();

        if ($request->filled('search')) {
            // Sesuai dengan Sub-CPMK 6 RPS Web Lanjut: Pencarian data tingkat lanjut
            $query->where('nama_program', 'like', '%' . $request->search . '%');
        }

        // Pagination dengan style Tailwind sesuai standar RPS Web Lanjut
        $volunteers = $query->latest()->paginate(10);

        return view('admin.volunteer-index', compact('volunteers'));
        $jumlahPendaftar = Pendaftaran::where('kegiatan_id', $kegiatan->id_kegiatan)->count();

        $sudahDaftar = false;
        if (Auth::check()) {
            $sudahDaftar = Pendaftaran::where('kegiatan_id', $kegiatan->id_kegiatan)
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('volunteer.detail', compact('kegiatan', 'jumlahPendaftar', 'sudahDaftar'));
    }

    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'lokasi'       => 'required|string|max:255',
            'kuota'        => 'required|integer|min:1',
            'deskripsi'    => 'required|string',
            'syarat'       => 'required|string',
        ]);

        Pendaftaran::create($data);

        return redirect()->route('admin.volunteer')->with('success', 'Program lowongan relawan baru berhasil dibuka!');
    }

    public function adminUpdate(Request $request, $id)
    {
        $volunteer = Pendaftaran::findOrFail($id);

        $data = $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'lokasi'       => 'required|string|max:255',
            'kuota'        => 'required|integer|min:1',
            'deskripsi'    => 'required|string',
            'syarat'       => 'required|string',
        ]);

        $volunteer->update($data);

        return redirect()->route('admin.volunteer')->with('success', 'Informasi program relawan berhasil diperbarui.');
    }

    public function adminDestroy($id)
    {
        $volunteer = Pendaftaran::findOrFail($id);
        $volunteer->delete();

        return redirect()->route('admin.volunteer')->with('success', 'Program relawan berhasil dihapus dari sistem.');
    }
}
