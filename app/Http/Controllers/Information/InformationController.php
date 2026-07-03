<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;

class InformationController extends Controller
{
    /**
     * Menampilkan semua informasi lingkungan.
     */
    public function index()
    {
        $informations = Kegiatan::where('kategori', 'Eco-Information')
            ->where('status', 'aktif')
            ->latest()
            ->get();

        return view('information.index', compact('informations'));
    }

    /**
     * Menampilkan detail informasi.
     */
    public function show($id)
    {
        $information = Kegiatan::where('kategori', 'Eco-Information')
            ->where('id_kegiatan', $id)
            ->firstOrFail();

        return view('information.detail', compact('information'));
    }
}