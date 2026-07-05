<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.user-index', compact('users'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input nama, nomor hp, dan alamat tinggal
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        // 2. Otomatisasi Email unik agar MySQL tidak error duplicate
        $emailOtomatis = Str::slug($request->name) . rand(10, 99) . '@aksilingkungan.com';

        // 3. Otomatisasi Password (menggunakan nomor HP yang didaftarkan sebagai password awal)
        $passwordBawaan = Hash::make($request->phone);

        // 4. Eksekusi simpan ke database MySQL
        User::create([
            'name' => $request->name,
            'email' => $emailOtomatis,
            'password' => $passwordBawaan,
            'role' => 'user',
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.users')->with('success', 'Data masyarakat berhasil disimpan ke database tanpa password manual!');
    }

    // FIX: Menambahkan fungsi update data riil ke MySQL
    public function update(Request $request, $id)
    {
        // 1. Validasi data yang diubah
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        // 2. Cari user berdasarkan ID dan perbarui datanya
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        // 3. Kembalikan ke halaman index dengan notifikasi sukses
        return redirect()->route('admin.users')->with('success', 'Data identitas pengguna berhasil diperbarui di database!');
    }
}
