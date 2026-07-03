<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranVolunteerController extends Controller
{
    /**
     * Menyimpan pendaftaran volunteer.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'alasan_bergabung' => 'required|string|min:10|max:1000',
        ]);

        // Cek apakah user sudah pernah mendaftar
        $sudahDaftar = Pendaftaran::where('kegiatan_id', $id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Kamu sudah mendaftar pada kegiatan ini.');
        }

        Pendaftaran::create([
            'kegiatan_id' => $id,
            'user_id' => Auth::id(),
            'alasan_bergabung' => $request->alasan_bergabung,
        ]);

        return back()->with(
            'success',
            'Pendaftaran berhasil dikirim. Terima kasih telah menjadi relawan.'
        );
    }
}