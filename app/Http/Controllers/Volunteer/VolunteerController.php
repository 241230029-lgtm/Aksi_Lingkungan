<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    /**
     * Menampilkan semua kegiatan volunteer yang masih aktif.
     */
    public function index()
    {
        $kegiatans = Kegiatan::where('kategori', 'Eco-Volunteer')
            ->where('status', 'aktif')
            ->latest()
            ->get();

        return view('volunteer.index', compact('kegiatans'));
    }

    /**
     * Menampilkan detail kegiatan.
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('volunteer.detail', compact('kegiatan'));
    }

    /**
     * Menyimpan kegiatan volunteer baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'kuota_relawan' => 'required|integer|min:1',
            'link_kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['user_id'] = Auth::id();
        $data['kategori'] = 'Eco-Volunteer';
        $data['status'] = 'aktif';

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('volunteer.index')
            ->with('success', 'Kegiatan volunteer berhasil ditambahkan.');
    }
}