<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKegiatanController extends Controller
{
    private function mapJenis($kategori)
    {
        return match($kategori) {
            'Eco-Volunteer' => 'Volunteer',
            'Eco-Sharing' => 'Sharing',
            'Eco-Information' => 'Informasi',
            default => 'Informasi',
        };
    }

    public function index(Request $request)
    {
        $kegiatan = Kegiatan::when($request->search, function ($query, $search) {
            $query->where('judul', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function editJson($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return response()->json($kegiatan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'           => 'required|string|max:255',
            'tanggal_kejadian' => 'nullable|date',
            'kuota_relawan'    => 'nullable|integer|min:1',
            'link_kontak'      => 'nullable|url',
            'deskripsi'        => 'required|string',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file'             => 'nullable|mimes:pdf|max:5120',
            'status'           => 'required|in:akan_datang,terlaksana,selesai',
        ]);

        $data = $request->only([
            'judul', 'kategori', 'lokasi', 'tanggal_kejadian',
            'kuota_relawan', 'link_kontak', 'deskripsi', 'status'
        ]);

        $data['user_id'] = auth()->id();
        $data['jenis'] = $this->mapJenis($data['kategori']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('kegiatan-file', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|in:Eco-Sharing,Eco-Information,Eco-Volunteer',
            'lokasi'           => 'required|string|max:255',
            'tanggal_kejadian' => 'nullable|date',
            'kuota_relawan'    => 'nullable|integer|min:1',
            'link_kontak'      => 'nullable|url',
            'deskripsi'        => 'required|string',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file'             => 'nullable|mimes:pdf|max:5120',
            'status'           => 'required|in:akan_datang,terlaksana,selesai',
        ]);

        $data = $request->only([
            'judul', 'kategori', 'lokasi', 'tanggal_kejadian',
            'kuota_relawan', 'link_kontak', 'deskripsi', 'status'
        ]);

        $data['user_id'] = $kegiatan->user_id;
        $data['jenis'] = $this->mapJenis($data['kategori']);

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        if ($request->hasFile('file')) {
            if ($kegiatan->file && Storage::disk('public')->exists($kegiatan->file)) {
                Storage::disk('public')->delete($kegiatan->file);
            }
            $data['file'] = $request->file('file')->store('kegiatan-file', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        if ($kegiatan->file && Storage::disk('public')->exists($kegiatan->file)) {
            Storage::disk('public')->delete($kegiatan->file);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil dihapus.');
    }
}