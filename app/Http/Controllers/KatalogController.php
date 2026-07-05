<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::whereIn('kategori', ['Eco-Sharing', 'Eco-Information', 'Eco-Volunteer'])
            ->where('status', 'aktif');

        if ($request->filled('keyword')) {
            $query->where('judul', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('lokasi') && $request->lokasi != 'semua') {
            $query->where('lokasi', $request->lokasi);
        }

        $items = $query->latest()->paginate(9)->withQueryString();

        $lokasiList = Kegiatan::whereIn('kategori', ['Eco-Sharing', 'Eco-Information', 'Eco-Volunteer'])
            ->distinct()
            ->pluck('lokasi');

        return view('katalog', compact('items', 'lokasiList'));
    }
}