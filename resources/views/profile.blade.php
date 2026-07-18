@extends('layouts.app')

@section('content')

<!-- Header -->
<section class="bg-green-600 py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-5xl font-bold text-white">
            Profil Saya
        </h1>
        <p class="text-green-100 mt-3">
            Kelola informasi akun dan aktivitas Anda secara real-time.
        </p>
    </div>
</section>

<!-- Profile Section -->
<section class="py-16 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Alert Pesan Sukses -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-green-100 text-green-800 border border-green-200 shadow-sm flex justify-between items-center">
                <span class="font-medium">✨ {{ session('success') }}</span>
                <button type="button" class="text-green-600 hover:text-green-900 font-bold" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        @endif

        <div class="grid lg:grid-cols-4 gap-8">

            <!-- Sidebar -->
            <div class="bg-white rounded-3xl shadow-lg p-8 h-fit">
                <div class="text-center">
                    <div class="w-32 h-32 rounded-full bg-green-200 mx-auto flex items-center justify-center text-5xl">
                        👤
                    </div>
                    <!-- Menampilkan nama dan email user yang sedang login -->
                    <h2 class="mt-5 text-2xl font-bold text-gray-800">
                        {{ $user->name }}
                    </h2>
                    <p class="text-gray-500">
                        {{ $user->email }}
                    </p>
                </div>

                <hr class="my-6">

                <nav class="space-y-3">
                    <a href="{{ route('profil') }}"
                        class="block px-4 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700 transition">
                        👤 Profil
                    </a>
                    <a href="{{ route('aktivitas') }}"
                        class="block px-4 py-3 rounded-xl hover:bg-green-100 hover:text-green-700 transition">
                        📋 Aktivitas Saya
                    </a>
                    <a href="{{ route('relawan') }}"
                        class="block px-4 py-3 rounded-xl hover:bg-green-100 hover:text-green-700 transition">
                        🤝 Relawan
                    </a>
                    <a href="{{ route('pengaturan') }}"
                        class="block px-4 py-3 rounded-xl hover:bg-green-100 hover:text-green-700 transition">
                        ⚙️ Pengaturan
                    </a>
                    
                    <!-- Logout Form yang Aman -->
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-red-600 hover:bg-red-100 transition">
                            🚪 Logout
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-3">

                <!-- Informasi Profil Form -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold mb-8">
                        Informasi Profil
                    </h2>

                    <!-- FORM UTAMA PROSES UPDATE -->
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="grid md:grid-cols-2 gap-6">

                            <!-- Input Nama -->
                            <div>
                                <label for="name" class="font-semibold text-gray-700">Nama Lengkap</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('name') border-red-500 @enderror"
                                    required>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Input Email -->
                            <div>
                                <label for="email" class="font-semibold text-gray-700">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('email') border-red-500 @enderror"
                                    required>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Input No HP -->
                            <div>
                                <label for="phone" class="font-semibold text-gray-700">Nomor HP</label>
                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    placeholder="Contoh: 08123456789"
                                    class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Input Alamat -->
                            <div>
                                <label for="alamat" class="font-semibold text-gray-700">Alamat</label>
                                <input
                                    type="text"
                                    name="alamat"
                                    id="alamat"
                                    value="{{ old('alamat', $user->alamat) }}"
                                    placeholder="Tulis alamat rumah Anda"
                                    class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('alamat') border-red-500 @enderror">
                                @error('alamat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Bagian Ganti Password (Opsional) -->
                        <div class="mt-8 border-t pt-8">
                            <h3 class="text-xl font-bold mb-4">Ganti Kata Sandi</h3>
                            <p class="text-sm text-gray-500 mb-6">💡 <em>Biarkan kolom di bawah ini kosong jika Anda tidak ingin mengganti password lama.</em></p>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="password" class="font-semibold text-gray-700">Password Baru</label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        placeholder="Minimal 8 karakter"
                                        class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('password') border-red-500 @enderror">
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="font-semibold text-gray-700">Ulangi Password Baru</label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        placeholder="Ulangi password baru"
                                        class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl transition font-medium shadow">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Bagian Statistik (Tetap dipertahankan dari desain temanmu) -->
                <div class="grid md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                        <h2 class="text-4xl font-bold text-green-600">12</h2>
                        <p class="mt-2 text-gray-600">Aksi Dibuat</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                        <h2 class="text-4xl font-bold text-green-600">8</h2>
                        <p class="mt-2 text-gray-600">Relawan Diikuti</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                        <h2 class="text-4xl font-bold text-green-600">34</h2>
                        <p class="mt-2 text-gray-600">Postingan</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection