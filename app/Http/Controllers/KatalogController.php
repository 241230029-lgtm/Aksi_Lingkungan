<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::with('user')
            ->whereIn('kategori', ['Eco-Sharing', 'Eco-Information', 'Eco-Volunteer'])
            ->where('status', 'aktif');

        // FILTER 1: PENCARIAN KATA KUNCI
        if ($request->filled('keyword')) {
            $query->where('judul', 'like', '%' . $request->keyword . '%');
        }

        // FILTER 2: KATEGORI
        if ($request->filled('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // FILTER 3: LOKASI (SUDAH DIPERBAIKI DARI $request->kategori JADI $request->lokasi)
        if ($request->filled('lokasi') && $request->lokasi != 'semua') {
            $query->where('lokasi', $request->lokasi);
        }

        $items = $query->latest()->paginate(9)->withQueryString();

        // Mengambil daftar lokasi unik untuk dropdown filter
        $lokasiList = Kegiatan::whereIn('kategori', ['Eco-Sharing', 'Eco-Information', 'Eco-Volunteer'])
            ->whereNotNull('lokasi')
            ->distinct()
            ->pluck('lokasi');

        return view('katalog', compact('items', 'lokasiList'));
    }

    public function show($id)
    {
        $item = Kegiatan::with('user')->findOrFail($id);
        return view('katalog-detail', compact('item'));
    }
}
