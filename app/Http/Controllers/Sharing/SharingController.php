<?php

namespace App\Http\Controllers\Sharing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sharing;
use Illuminate\Support\Facades\Auth;

class SharingController extends Controller
{
    // GET: ambil semua data
    public function index()
    {
        $sharing = Sharing::with('user')
            ->latest()
            ->get();

        return view('sharing.index', compact('sharing'));
    }

    // POST: simpan data
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'cerita' => 'required|string',
        ]);

        Sharing::create([
            'user_id' => Auth::id() ?? 1, // fallback biar tidak error
            'judul' => $request->judul,
            'cerita' => $request->cerita,
        ]);

        return redirect('/sharing');
    }
}