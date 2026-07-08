<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKegiatanController extends Controller
{
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
        return $this->saveKegiatan($request);
    }

    public function update(Request $request, $id)
    {
        return $this->saveKegiatan($request, $id);
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }
        $kegiatan->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    public function indexKategori(Request $request, $kategori)
    {
        $query = Kegiatan::where('kategori', $kategori);

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $items = $query->latest()->paginate(10)->withQueryString();

        return view('admin.kegiatan.kategori', compact('items', 'kategori'));
    }

public function storeKategori(Request $request)
{
    return $this->saveKegiatan($request, null, $request->kategori);
}

public function updateKategori(Request $request, $id)
{
    return $this->saveKegiatan($request, $id, $request->kategori);
}
    private function saveKegiatan(Request $request, $id = null, $forceKategori = null)
    {
        $isUpdate = $id !== null;
        $kategori = $forceKategori ?? $request->kategori;

        $rules = [
            'judul'           => 'required|string|max:255',
            'lokasi'          => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'          => 'required|in:Aktif,Selesai',
        ];

        if ($kategori === 'Eco-Volunteer') {
            $rules['tanggal_kejadian'] = 'nullable|date';
            $rules['kuota_relawan']   = 'nullable|integer|min:1';
        }

        if ($kategori === 'Eco-Sharing') {
            $rules['link_kontak'] = 'required|string|max:255';
        }

        $request->validate($rules);

        $data = $request->only([
            'judul', 'lokasi', 'tanggal_kejadian',
            'kuota_relawan', 'link_kontak', 'deskripsi', 'status'
        ]);

        $data['kategori'] = $kategori;
        $data['user_id'] = $isUpdate ? Kegiatan::find($id)->user_id : auth()->id();

        $data['jenis'] = match($kategori) {
            'Eco-Sharing'    => 'Barang',
            'Eco-Information' => 'Edukasi',
            'Eco-Volunteer'  => 'Relawan',
            default          => 'Lainnya',
        };

        if ($request->hasFile('gambar')) {
            if ($isUpdate) {
                $old = Kegiatan::find($id);
                if ($old->gambar && Storage::disk('public')->exists($old->gambar)) {
                    Storage::disk('public')->delete($old->gambar);
                }
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        if ($isUpdate) {
            Kegiatan::find($id)->update($data);
            return back()->with('success', 'Data berhasil diperbarui.');
        } else {
            Kegiatan::create($data);
            $routeName = 'admin.' . strtolower(str_replace('Eco-', '', $kategori));
            return redirect()->route($routeName)->with('success', 'Data berhasil ditambahkan.');
        }
    }
}
