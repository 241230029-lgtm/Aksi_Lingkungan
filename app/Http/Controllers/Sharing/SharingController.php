<?php

namespace App\Http\Controllers\Sharing;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;

class SharingController extends Controller
{
    /**
     * Menampilkan semua kegiatan Eco-Sharing.
     */
    public function index()
    {
        $sharings = Kegiatan::where('kategori', 'Eco-Sharing')
            ->where('status', 'aktif')
            ->latest()
            ->get();

        return view('sharing.index', compact('sharings'));
    }

    /**
     * Menampilkan detail kegiatan Eco-Sharing.
     */
    public function show($id)
    {
        $sharing = Kegiatan::where('kategori', 'Eco-Sharing')
            ->where('id_kegiatan', $id)
            ->firstOrFail();

        return view('sharing.detail', compact('sharing'));
    }
}