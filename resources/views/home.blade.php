@extends('layouts.guest')

@section('content')

{{-- NOTIFIKASI ERROR LOGIN --}}
@if($errors->any())
<div id="errorAlert" class="fixed top-5 right-5 left-5 sm:left-auto z-[9999] bg-red-50 text-red-700 px-5 sm:px-6 py-4 rounded-2xl border border-red-200 shadow-lg text-sm font-semibold flex items-center gap-2">
    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ $errors->first('login') }}
</div>
<script>setTimeout(() => { const el = document.getElementById('errorAlert'); if (el) el.style.display = 'none'; }, 5000);</script>
@endif

{{-- NOTIFIKASI SUKSES REGISTER --}}
@if(session('success'))
<div id="successAlert" class="fixed top-5 right-5 left-5 sm:left-auto z-[9999] bg-emerald-50 text-emerald-700 px-5 sm:px-6 py-4 rounded-2xl border border-emerald-200 shadow-lg text-sm font-semibold flex items-center gap-2">
    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
</div>
<script>setTimeout(() => { const el = document.getElementById('successAlert'); if (el) el.style.display = 'none'; }, 4000);</script>
@endif

<!-- ================= HERO ================= -->
<section class="bg-gradient-to-br from-emerald-700 to-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <div>
                <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-sm text-emerald-100 px-4 sm:px-5 py-2 rounded-full font-semibold text-xs sm:text-sm">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3C6 3 3 7 3 11c0 5 4 9 9 10 1-5 1-9 5-13 2-2 4-3 4-3s-1 6-5 8c-2 1-3 1-3 1"/></svg>
                    Platform Digital Peduli Lingkungan
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-6xl font-extrabold leading-tight mt-6 sm:mt-8">Bersama Mewujudkan <span class="text-emerald-300">Lingkungan yang Lebih Bersih</span></h1>
                <p class="text-slate-200 text-base sm:text-lg mt-6 sm:mt-8 leading-7 sm:leading-8">Aksi Lingkungan merupakan platform yang menghubungkan masyarakat, relawan, dan komunitas untuk berkolaborasi menjaga kelestarian lingkungan melalui berbagai kegiatan sosial dan edukasi.</p>

                <div class="mt-8 sm:mt-10">
                    <button type="button" onclick="openRegisterModal()" class="w-full sm:w-auto bg-white hover:bg-emerald-50 text-emerald-700 px-8 py-3.5 sm:py-4 rounded-xl font-bold shadow-lg transition">
                        Daftar Akun Baru
                    </button>
                    <p class="text-slate-300 text-sm mt-4">
                        Sudah punya akun?
                        <button type="button" onclick="openLoginModal()" class="text-emerald-300 font-semibold hover:text-white hover:underline transition">Masuk di sini</button>
                    </p>
                </div>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900" alt="Lingkungan" class="rounded-3xl shadow-2xl w-full">
            </div>
        </div>
    </div>
</section>

<!-- ================= TENTANG ================= -->
<section id="tentang" class="py-16 sm:py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900">Tentang Aksi Lingkungan</h2>
        <p class="text-slate-600 text-base sm:text-lg leading-7 sm:leading-9 mt-6 sm:mt-8">Aksi Lingkungan adalah platform digital yang bertujuan meningkatkan kepedulian masyarakat terhadap lingkungan melalui kolaborasi antara masyarakat, relawan, dan komunitas. Platform ini menjadi wadah untuk berbagi informasi, mengikuti kegiatan, serta berpartisipasi dalam aksi nyata demi menciptakan lingkungan yang lebih bersih, hijau, dan berkelanjutan.</p>
    </div>
</section>

<!-- ================= VISI MISI ================= -->
<section class="bg-slate-50 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-6 sm:gap-10">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 sm:p-10">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 mb-5 sm:mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mb-3 sm:mb-4">Visi</h3>
                <p class="text-slate-600 leading-7 sm:leading-8">Menjadi platform digital yang mampu meningkatkan partisipasi masyarakat dalam menjaga kelestarian lingkungan secara berkelanjutan.</p>
            </div>
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 sm:p-10">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 mb-5 sm:mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mb-3 sm:mb-4">Misi</h3>
                <ul class="space-y-3 text-slate-600">
                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">&bull;</span> Menghubungkan masyarakat dengan relawan.</li>
                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">&bull;</span> Menyediakan informasi mengenai aksi lingkungan.</li>
                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">&bull;</span> Mendukung kegiatan sosial berbasis lingkungan.</li>
                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">&bull;</span> Meningkatkan kepedulian masyarakat terhadap alam.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ================= CARA KERJA ================= -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-center text-slate-900 mb-10 sm:mb-16">Cara Menggunakan Aplikasi</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            @php
                $steps = [
                    ['title' => 'Daftar / Login', 'desc' => 'Buat akun baru atau masuk menggunakan akun Anda.'],
                    ['title' => 'Jelajahi', 'desc' => 'Temukan berbagai kegiatan lingkungan.'],
                    ['title' => 'Berpartisipasi', 'desc' => 'Ikut menjadi relawan dalam kegiatan.'],
                    ['title' => 'Berikan Dampak', 'desc' => 'Bersama menciptakan lingkungan yang lebih baik.'],
                ];
            @endphp
            @foreach($steps as $i => $step)
            <div class="bg-slate-50 rounded-3xl border border-slate-100 p-6 sm:p-8 text-center">
                <div class="w-12 h-12 sm:w-14 sm:h-14 mx-auto bg-gradient-to-br from-emerald-500 to-slate-800 rounded-2xl flex items-center justify-center text-white font-extrabold text-lg sm:text-xl">{{ $i + 1 }}</div>
                <h3 class="font-bold text-lg sm:text-xl mt-5 sm:mt-6 text-slate-900">{{ $step['title'] }}</h3>
                <p class="text-slate-500 mt-2 sm:mt-3 text-sm sm:text-base">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= STATISTIK ================= -->
<section class="bg-slate-50 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-8">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-5 sm:p-10 text-center">
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-emerald-600">1.250+</h2>
                <p class="mt-2 sm:mt-4 text-slate-600 font-medium text-xs sm:text-base">Aksi Lingkungan</p>
            </div>
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-5 sm:p-10 text-center">
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-emerald-600">850+</h2>
                <p class="mt-2 sm:mt-4 text-slate-600 font-medium text-xs sm:text-base">Relawan Aktif</p>
            </div>
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-5 sm:p-10 text-center">
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-emerald-600">320+</h2>
                <p class="mt-2 sm:mt-4 text-slate-600 font-medium text-xs sm:text-base">Komunitas</p>
            </div>
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-5 sm:p-10 text-center">
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-emerald-600">2.150 Kg</h2>
                <p class="mt-2 sm:mt-4 text-slate-600 font-medium text-xs sm:text-base">Sampah Terkelola</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= CTA ================= -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="bg-gradient-to-br from-emerald-700 to-slate-900 rounded-3xl p-8 sm:p-16 text-center text-white shadow-xl">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold">Siap Menjadi Bagian dari Perubahan?</h2>
            <p class="text-base sm:text-lg mt-4 sm:mt-6 leading-7 sm:leading-8 text-slate-200">Bergabunglah bersama masyarakat lainnya untuk menciptakan lingkungan yang lebih hijau, bersih, dan berkelanjutan.</p>
            <div class="mt-8 sm:mt-10">
                <button type="button" onclick="openRegisterModal()" class="w-full sm:w-auto bg-white text-emerald-700 hover:bg-emerald-50 px-8 sm:px-10 py-3.5 sm:py-4 rounded-xl font-bold transition">Daftar Akun Baru</button>
                <p class="text-slate-300 text-sm mt-4">
                    Sudah punya akun?
                    <button type="button" onclick="openLoginModal()" class="text-emerald-300 font-semibold hover:text-white hover:underline transition">Masuk di sini</button>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ================= MODAL REGISTER ================= -->
<div id="registerModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background-color: rgba(15,23,42,0.7); align-items: center; justify-content: center; padding: 1rem; overflow-y: auto;">
    <div style="background-color: white; border-radius: 1.5rem; max-width: 28rem; width: 100%; padding: 1.75rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); margin: auto; position: relative;">
        <button onclick="closeRegisterModal()" style="position: absolute; top: 1rem; right: 1.25rem; background: none; border: none; cursor: pointer; color: #9ca3af;">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h2 class="text-xl sm:text-2xl font-extrabold text-center text-emerald-700 mb-2">Daftar Akun Baru</h2>
        <p class="text-center text-sm text-slate-500 mb-6">Buat akun menggunakan Nama Pengguna</p>

        <form method="POST" action="{{ route('register.process') }}" data-turbo="false">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Pengguna</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Contoh: BudiPeduli01">
            </div>
            <div class="mb-4 relative">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Password</label>
                <input type="password" id="regPassword" name="password" required class="w-full border border-slate-200 rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Minimal 4 karakter">
                <button type="button" onclick="togglePassword('regPassword')" class="absolute right-3 top-8 text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
            <div class="mb-6 relative">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Konfirmasi Password</label>
                <input type="password" id="regPasswordConf" name="password_confirmation" required class="w-full border border-slate-200 rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Ulangi password">
                <button type="button" onclick="togglePassword('regPasswordConf')" class="absolute right-3 top-8 text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl font-bold transition cursor-pointer">Daftar Sekarang</button>
            <p class="text-center text-sm text-slate-500 mt-4">Sudah punya akun? <a href="#" onclick="closeRegisterModal(); setTimeout(openLoginModal, 200);" class="text-emerald-600 font-bold hover:underline">Login di sini</a></p>
        </form>
    </div>
</div>

@endsection