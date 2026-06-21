<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    // Menampilkan semua daftar lowongan relawan
    public function index()
    {
        return view('volunteer.index');
    }

    // Menampilkan detail salah satu lowongan relawan
    public function show($id)
    {
        return view('volunteer.detail');
    }

    // Tempat tim Backend menyimpan aksi baru ke database nanti
    public function store(Request $request)
    {
        // Kosongkan dulu untuk diisi tim nanti
    }
}
