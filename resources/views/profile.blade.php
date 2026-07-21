@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-br from-emerald-700 to-slate-900 py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white">Profil Saya</h1>
        <p class="text-emerald-100 mt-3 text-sm sm:text-base">Kelola informasi akun dan aktivitas Anda secara real-time.</p>
    </div>
</section>

<section class="py-8 sm:py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm flex justify-between items-center gap-3">
                <span class="font-medium text-sm sm:text-base">Berhasil: {{ session('success') }}</span>
                <button type="button" class="text-emerald-600 hover:text-emerald-900 font-bold shrink-0" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        @endif

        @error('photo')
            <div class="mb-6 p-4 rounded-2xl bg-red-100 text-red-800 border border-red-200 shadow-sm text-sm sm:text-base">
                {{ $message }}
            </div>
        @enderror

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 sm:gap-8">

            <div class="bg-white rounded-3xl shadow-lg shadow-slate-950/5 border border-slate-100 p-6 sm:p-8 h-fit">
                <div class="text-center">

                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 mx-auto">
                        <img
                            id="photo-preview"
                            src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=10b981&color=fff&size=128' }}"
                            class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover bg-emerald-100 ring-4 ring-emerald-50"
                            alt="Foto profil">

                        <label for="photo-input" class="absolute bottom-0 right-0 bg-emerald-600 hover:bg-emerald-700 text-white w-9 h-9 rounded-full flex items-center justify-center cursor-pointer shadow-md transition" title="Ganti foto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>

                        <input
                            type="file"
                            name="photo"
                            id="photo-input"
                            form="profile-form"
                            accept="image/png, image/jpeg, image/webp"
                            class="hidden"
                            onchange="previewPhoto(this)">
                    </div>
                    <p class="text-xs text-slate-400 mt-2">JPG/PNG/WebP, maks 2MB</p>

                    <h2 class="mt-5 text-xl sm:text-2xl font-bold text-slate-800 break-words">{{ $user->name }}</h2>
                    <p class="text-slate-500 text-sm break-words">{{ $user->email }}</p>
                </div>

                <hr class="my-6 border-slate-100">

                <nav class="space-y-3">
                    <a href="{{ route('profil') }}" class="block px-4 py-3 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition font-medium text-sm sm:text-base">Profil</a>
                    <a href="{{ route('aktivitas') }}" class="block px-4 py-3 rounded-xl text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition font-medium text-sm sm:text-base">Aktivitas Saya</a>
                    <a href="{{ route('relawan') }}" class="block px-4 py-3 rounded-xl text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition font-medium text-sm sm:text-base">Relawan</a>
                    <a href="{{ route('pengaturan') }}" class="block px-4 py-3 rounded-xl text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition font-medium text-sm sm:text-base">Pengaturan</a>

                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition font-medium text-sm sm:text-base">Logout</button>
                    </form>
                </nav>
            </div>

            <div class="lg:col-span-3">

                <div class="bg-white rounded-3xl shadow-lg shadow-slate-950/5 border border-slate-100 p-5 sm:p-8">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8 text-slate-900">Informasi Profil</h2>

                    <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="grid sm:grid-cols-2 gap-6">

                            <div>
                                <label for="name" class="font-semibold text-slate-700 text-sm sm:text-base">Nama Lengkap</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                    class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('name') border-red-500 @enderror" required>
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="email" class="font-semibold text-slate-700 text-sm sm:text-base">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('email') border-red-500 @enderror" required>
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="phone" class="font-semibold text-slate-700 text-sm sm:text-base">Nomor HP</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789"
                                    class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('phone') border-red-500 @enderror">
                                @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="alamat" class="font-semibold text-slate-700 text-sm sm:text-base">Alamat</label>
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $user->alamat) }}" placeholder="Tulis alamat rumah Anda"
                                    class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('alamat') border-red-500 @enderror">
                                @error('alamat')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                        </div>

                        <div class="mt-8 border-t border-slate-100 pt-8">
                            <h3 class="text-lg sm:text-xl font-bold mb-4 text-slate-900">Ganti Kata Sandi</h3>
                            <p class="text-sm text-slate-500 mb-6">Biarkan kolom di bawah ini kosong jika Anda tidak ingin mengganti password lama.</p>

                            <div class="grid sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="password" class="font-semibold text-slate-700 text-sm sm:text-base">Password Baru</label>
                                    <input type="password" name="password" id="password" placeholder="Minimal 8 karakter"
                                        class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none @error('password') border-red-500 @enderror">
                                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="font-semibold text-slate-700 text-sm sm:text-base">Ulangi Password Baru</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password baru"
                                        class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl transition font-medium shadow">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mt-8">
                    <div class="bg-white rounded-2xl shadow-lg shadow-slate-950/5 border border-slate-100 p-5 sm:p-6 text-center">
                        <h2 class="text-3xl sm:text-4xl font-bold text-emerald-600">12</h2>
                        <p class="mt-2 text-slate-600 text-sm sm:text-base">Aksi Dibuat</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg shadow-slate-950/5 border border-slate-100 p-5 sm:p-6 text-center">
                        <h2 class="text-3xl sm:text-4xl font-bold text-emerald-600">8</h2>
                        <p class="mt-2 text-slate-600 text-sm sm:text-base">Relawan Diikuti</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg shadow-slate-950/5 border border-slate-100 p-5 sm:p-6 text-center">
                        <h2 class="text-3xl sm:text-4xl font-bold text-emerald-600">34</h2>
                        <p class="mt-2 text-slate-600 text-sm sm:text-base">Postingan</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('photo-preview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection