<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Sharing;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $keyword        = $request->filled('keyword') ? $request->keyword : null;
        $kategoriFilter = ($request->filled('kategori') && $request->kategori != 'semua') ? $request->kategori : null;
        $lokasiFilter   = ($request->filled('lokasi') && $request->lokasi != 'semua') ? $request->lokasi : null;

        $items = collect();

        // --- Eco-Volunteer (tabel kegiatans) ---
        if (!$kategoriFilter || $kategoriFilter === 'Eco-Volunteer') {
            $query = Kegiatan::with('user')->where('kategori', 'Eco-Volunteer')->where('status', 'aktif');
            if ($keyword) $query->where('judul', 'like', "%{$keyword}%");
            if ($lokasiFilter) $query->where('lokasi', $lokasiFilter);

            foreach ($query->get() as $k) {
                $items->push((object) [
                    'tipe'           => 'volunteer',
                    'id'             => $k->id_kegiatan,
                    'judul'          => $k->judul,
                    'kategori_label' => $k->kategori_label,
                    'deskripsi'      => $k->deskripsi,
                    'lokasi'         => $k->lokasi,
                    'gambar'         => $k->gambar,
                    'pembuat'        => $k->user->name ?? 'Administrator',
                    'created_at'     => $k->created_at,
                ]);
            }
        }

        // --- Eco-Sharing (tabel sharings), diabaikan kalau ada filter lokasi ---
        if (!$lokasiFilter && (!$kategoriFilter || $kategoriFilter === 'Eco-Sharing')) {
            $query = Sharing::query();
            if ($keyword) $query->where('judul', 'like', "%{$keyword}%");

            foreach ($query->get() as $s) {
                $items->push((object) [
                    'tipe'           => 'sharing',
                    'id'             => $s->id,
                    'judul'          => $s->judul,
                    'kategori_label' => 'Sharing',
                    'deskripsi'      => $s->deskripsi,
                    'lokasi'         => null,
                    'gambar'         => null,
                    'pembuat'        => $s->pembuat,
                    'created_at'     => $s->created_at,
                ]);
            }
        }

        // --- Eco-Information (tabel information), diabaikan kalau ada filter lokasi ---
        if (!$lokasiFilter && (!$kategoriFilter || $kategoriFilter === 'Eco-Information')) {
            $query = Information::query();
            if ($keyword) $query->where('judul', 'like', "%{$keyword}%");

            foreach ($query->get() as $i) {
                $items->push((object) [
                    'tipe'           => 'information',
                    'id'             => $i->id,
                    'judul'          => $i->judul,
                    'kategori_label' => 'Informasi',
                    'deskripsi'      => $i->konten,
                    'lokasi'         => null,
                    'gambar'         => $i->gambar,
                    'pembuat'        => $i->penulis,
                    'created_at'     => $i->created_at,
                ]);
            }
        }

        // Urutkan terbaru dulu, lalu paginasi manual (karena datanya campuran 3 tabel)
        $items = $items->sortByDesc('created_at')->values();

        $perPage = 9;
        $page = (int) $request->input('page', 1);

        $paged = new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $lokasiList = Kegiatan::where('kategori', 'Eco-Volunteer')
            ->whereNotNull('lokasi')
            ->distinct()
            ->pluck('lokasi');

        return view('katalog', ['items' => $paged, 'lokasiList' => $lokasiList]);
    }

    public function show($tipe, $id)
    {
        switch ($tipe) {
            case 'sharing':
                $item = Sharing::findOrFail($id);
                $namaPembuat  = $item->pembuat;
                $deskripsi    = $item->deskripsi;
                $gambar       = null;
                $lokasi       = null;
                $kategoriLabel = 'Sharing';
                break;

            case 'information':
                $item = Information::findOrFail($id);
                $namaPembuat  = $item->penulis;
                $deskripsi    = $item->konten;
                $gambar       = $item->gambar;
                $lokasi       = null;
                $kategoriLabel = 'Informasi';
                break;

            default: // volunteer
                $item = Kegiatan::with('user')->findOrFail($id);
                $namaPembuat  = $item->user->name ?? 'Administrator';
                $deskripsi    = $item->deskripsi;
                $gambar       = $item->gambar;
                $lokasi       = $item->lokasi;
                $kategoriLabel = 'Relawan';
                $tipe = 'volunteer';
                break;
        }

        return view('katalog-detail', compact('item', 'tipe', 'namaPembuat', 'deskripsi', 'gambar', 'lokasi', 'kategoriLabel'));
    }
}