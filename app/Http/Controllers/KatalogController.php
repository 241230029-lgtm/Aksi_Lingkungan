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
            ->where('status', 'Aktif');

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
            ->whereNotNull('lokasi')
            ->distinct()
            ->pluck('lokasi');

        return view('katalog', compact('items', 'lokasiList'));
    }

public function show($tipe, $id)
{
    $item = Kegiatan::with('user')->where('id_kegiatan', $id)->firstOrFail();
    return view('katalog-detail', compact('item'));
}}
