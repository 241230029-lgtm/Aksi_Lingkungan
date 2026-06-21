<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class PendaftaranVolunteerController extends Controller
{
    // Proses pendaftaran relawan
    public function store(Request $request, $id)
    {
        // Cek apakah user sudah pernah daftar
        $sudahDaftar = Pendaftaran::where('kegiatan_id', $id)
                        ->where('user_id', Auth::id())
                        ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Kamu sudah mendaftar kegiatan ini.');
        }

        Pendaftaran::create([
            'kegiatan_id' => $id,
            'user_id'     => Auth::id(),
            'status'      => 'menunggu',
        ]);

        return back()->with('success', 'Pendaftaran berhasil, tunggu konfirmasi.');
    }
}