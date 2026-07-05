<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminKegiatanController extends Controller
{
    /**
     * Menampilkan halaman daftar kegiatan (Index)
     */
    public function index(Request $request)
    {
        // Mengambil query pencarian jika ada input dari user
        $search = $request->input('search');

        // Mengambil data kegiatan dengan paginasi (10 data per halaman)
        $kegiatan = Kegiatan::when($search, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('admin.kegiatan-index', compact('kegiatan'));
    }

    /**
     * Menyimpan data kegiatan baru ke database (Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi data inputan sesuai parameter form
        $data = $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|string',
            'status'           => 'required|string',
            'lokasi'           => 'required|string',
            'tanggal_kejadian' => 'nullable|date',
            'kuota_relawan'    => 'nullable|integer|min:1',
            'link_kontak'      => 'nullable|string',
            'deskripsi'        => 'required|string',
            'gambar'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Handle upload file gambar banner jika dilampirkan
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        // 3. Mengatasi Error user_id null: Mengambil user pertama jika auth mengembalikan null
        $userAktif = User::first();
        $data['user_id'] = auth()->id() ?? ($userAktif ? $userAktif->id : 1);

        // 4. Eksekusi penyimpanan data ke database
        Kegiatan::create($data);

        // 5. Redirect kembali ke halaman index dengan membawa alert sukses
        return redirect()->route('admin.kegiatan')
            ->with('success', 'Data kegiatan baru berhasil disimpan dan diterbitkan!');
    }

    /**
     * Menampilkan detail kegiatan (Optional)
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan-show', compact('kegiatan'));
    }
}
