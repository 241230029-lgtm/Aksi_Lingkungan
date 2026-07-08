<?php

namespace App\Http\Controllers\Sharing;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class SharingController extends Controller
{
    public function index()
    {
        $sharings = Kegiatan::where('kategori', 'Eco-Sharing')->where('status', 'Aktif')->latest()->get();
        return view('sharing.index', compact('sharings'));
    }
}