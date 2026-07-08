<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $informations = Kegiatan::where('kategori', 'Eco-Information')->where('status', 'Aktif')->latest()->get();
        return view('information.index', compact('informations'));
    }

    public function show($id)
    {
        $information = Kegiatan::where('kategori', 'Eco-Information')->where('id_kegiatan', $id)->firstOrFail();
        return view('information.detail', compact('information'));
    }
}