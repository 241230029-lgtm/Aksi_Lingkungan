<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $users = User::where('role', 'user')
                    ->latest()
                    ->paginate(10);

        return view('admin.user-index', compact('users'));
    }

    /**
     * Menghapus user.
     */
    public function destroy(User $user)
    {
        // Mencegah admin menghapus akun sendiri
        if ($user->id == auth()->id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}