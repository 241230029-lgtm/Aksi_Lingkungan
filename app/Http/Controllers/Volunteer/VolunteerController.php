<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::where('jenis', 'Volunteer')->latest()->get();
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

    public function adminIndex(Request $request)
    {
        $query = Kegiatan::where('jenis', 'Volunteer');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $volunteers = $query->latest()->paginate(10);

        return view('admin.volunteer-index', compact('volunteers'));
    }

    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|string|max:255',
            'lokasi'           => 'required|string|max:255',
            'tanggal_kejadian' => 'nullable|date',
            'kuota_relawan'    => 'nullable|integer|min:1',
            'deskripsi'        => 'required|string',
            'link_kontak'      => 'nullable|string|max:255',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file'             => 'nullable|mimes:pdf|max:5120',
        ]);

        $data['user_id'] = Auth::id() ?? 1;
        $data['status']  = 'akan_datang';
        $data['jenis']   = 'Volunteer';

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('volunteer', 'public');
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('volunteer-file', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('admin.volunteer')->with('success', 'Program lowongan relawan baru berhasil dibuka!');
    }

    public function adminUpdate(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $data = $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|string|max:255',
            'lokasi'           => 'required|string|max:255',
            'tanggal_kejadian' => 'nullable|date',
            'kuota_relawan'    => 'nullable|integer|min:1',
            'deskripsi'        => 'required|string',
            'link_kontak'      => 'nullable|string|max:255',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file'             => 'nullable|mimes:pdf|max:5120',
        ]);

        $data['jenis'] = 'Volunteer';

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('volunteer', 'public');
        }

        if ($request->hasFile('file')) {
            if ($kegiatan->file && Storage::disk('public')->exists($kegiatan->file)) {
                Storage::disk('public')->delete($kegiatan->file);
            }
            $data['file'] = $request->file('file')->store('volunteer-file', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.volunteer')->with('success', 'Informasi program relawan berhasil diperbarui.');
    }

    public function adminDestroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        if ($kegiatan->file && Storage::disk('public')->exists($kegiatan->file)) {
            Storage::disk('public')->delete($kegiatan->file);
        }

        $kegiatan->delete();

        return redirect()->route('admin.volunteer')->with('success', 'Program relawan berhasil dihapus dari sistem.');
    }
}