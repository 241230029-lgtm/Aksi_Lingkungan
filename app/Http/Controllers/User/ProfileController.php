<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Memproses perubahan data dari form profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input form secara ketat dan aman
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Simpan perubahan ke database
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->alamat = $request->alamat;

        // Jika user mengisi password baru, enkripsi dan simpan
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Kembalikan ke halaman profil dengan pesan sukses
        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
    }
}