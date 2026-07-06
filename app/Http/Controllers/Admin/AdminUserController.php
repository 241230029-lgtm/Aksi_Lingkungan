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

        // PERHATIKAN BARIS INI: admin.user.index (sesuai folder kamu)
        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $emailOtomatis = Str::slug($request->name) . rand(10, 99) . '@aksilingkungan.com';
        $passwordBawaan = Hash::make($request->phone);

        User::create([
            'name' => $request->name,
            'email' => $emailOtomatis,
            'password' => $passwordBawaan,
            'role' => 'user',
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.users')->with('success', 'Data masyarakat berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.users')->with('success', 'Data masyarakat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->withErrors(['error' => 'Akun admin tidak bisa dihapus.']);
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Akun masyarakat berhasil dihapus.');
    }
}
