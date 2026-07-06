@extends('layouts.guest')

@section('content')

{{-- NOTIFIKASI ERROR LOGIN --}}
@if($errors->any())
<div id="errorAlert" style="position: fixed; top: 20px; right: 20px; z-index: 99999; background-color: #fef2f2; color: #991b1b; padding: 1rem 1.5rem; border-radius: 1rem; border: 1px solid #fecaca; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); font-size: 0.875rem; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ $errors->first('login') }}
</div>
<script>
    setTimeout(() => { document.getElementById('errorAlert').style.display = 'none'; }, 5000);
</script>
@endif

{{-- NOTIFIKASI SUKSES REGISTER --}}
@if(session('success'))
<div id="successAlert" style="position: fixed; top: 20px; right: 20px; z-index: 99999; background-color: #dcfce7; color: #166534; padding: 1rem 1.5rem; border-radius: 1rem; border: 1px solid #bbf7d0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); font-size: 0.875rem; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
</div>
<script>
    setTimeout(() => { document.getElementById('successAlert').style.display = 'none'; }, 4000);
</script>
@endif

<!-- ================= HERO ================= -->
<section class="bg-gradient-to-r from-green-50 via-white to-green-100">
    <div class="max-w-7xl mx-auto px-6 py-24">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block bg-green-100 text-green-700 px-5 py-2 rounded-full font-medium">🌿 Platform Digital Peduli Lingkungan</span>
                <h1 class="text-5xl lg:text-6xl font-bold leading-tight mt-8">Bersama Mewujudkan <span class="text-green-600">Lingkungan yang Lebih Bersih</span></h1>
                <p class="text-gray-600 text-lg mt-8 leading-8">Aksi Lingkungan merupakan platform yang menghubungkan masyarakat, relawan, dan komunitas untuk berkolaborasi menjaga kelestarian lingkungan melalui berbagai kegiatan sosial dan edukasi.</p>
                <div class="flex flex-wrap gap-4 mt-10">
                    <button type="button" onclick="openLoginModal()" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-semibold shadow-lg transition">Login Sekarang</button>
                    <button type="button" onclick="openRegisterModal()" class="border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white px-8 py-4 rounded-xl font-semibold transition">Daftar Akun Baru</button>
                </div>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900" alt="Lingkungan" class="rounded-3xl shadow-2xl w-full">
            </div>
        </div>
    </div>
</section>

<!-- ================= TENTANG ================= -->
<section id="tentang" class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold">Tentang Aksi Lingkungan</h2>
        <p class="text-gray-600 text-lg leading-9 mt-8">Aksi Lingkungan adalah platform digital yang bertujuan meningkatkan kepedulian masyarakat terhadap lingkungan melalui kolaborasi antara masyarakat, relawan, dan komunitas. Platform ini menjadi wadah untuk berbagi informasi, mengikuti kegiatan, serta berpartisipasi dalam aksi nyata demi menciptakan lingkungan yang lebih bersih, hijau, dan berkelanjutan.</p>
    </div>
</section>

<!-- ================= VISI MISI ================= -->
<section class="bg-green-50 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-10">
            <div class="bg-white rounded-3xl shadow-lg p-10">
                <h3 class="text-3xl font-bold text-green-700 mb-6">🌍 Visi</h3>
                <p class="text-gray-600 leading-8">Menjadi platform digital yang mampu meningkatkan partisipasi masyarakat dalam menjaga kelestarian lingkungan secara berkelanjutan.</p>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-10">
                <h3 class="text-3xl font-bold text-green-700 mb-6">🎯 Misi</h3>
                <ul class="space-y-4 text-gray-600">
                    <li>✅ Menghubungkan masyarakat dengan relawan.</li>
                    <li>✅ Menyediakan informasi mengenai aksi lingkungan.</li>
                    <li>✅ Mendukung kegiatan sosial berbasis lingkungan.</li>
                    <li>✅ Meningkatkan kepedulian masyarakat terhadap alam.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ================= CARA KERJA ================= -->
<section class="py-24">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-16">Cara Menggunakan Aplikasi</h2>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">
                <div class="text-6xl">1️⃣</div>
                <h3 class="font-bold text-xl mt-6">Daftar / Login</h3>
                <p class="text-gray-500 mt-4">Buat akun baru atau masuk menggunakan akun Anda.</p>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">
                <div class="text-6xl">2️⃣</div>
                <h3 class="font-bold text-xl mt-6">Jelajahi</h3>
                <p class="text-gray-500 mt-4">Temukan berbagai kegiatan lingkungan.</p>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">
                <div class="text-6xl">3️⃣</div>
                <h3 class="font-bold text-xl mt-6">Berpartisipasi</h3>
                <p class="text-gray-500 mt-4">Ikut menjadi relawan dalam kegiatan.</p>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">
                <div class="text-6xl">4️⃣</div>
                <h3 class="font-bold text-xl mt-6">Berikan Dampak</h3>
                <p class="text-gray-500 mt-4">Bersama menciptakan lingkungan yang lebih baik.</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= STATISTIK ================= -->
<section class="bg-gray-100 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">
                <h2 class="text-5xl font-bold text-green-600">1.250+</h2>
                <p class="mt-4 text-gray-600">Aksi Lingkungan</p>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">
                <h2 class="text-5xl font-bold text-green-600">850+</h2>
                <p class="mt-4 text-gray-600">Relawan Aktif</p>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">
                <h2 class="text-5xl font-bold text-green-600">320+</h2>
                <p class="mt-4 text-gray-600">Komunitas</p>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">
                <h2 class="text-5xl font-bold text-green-600">2.150 Kg</h2>
                <p class="mt-4 text-gray-600">Sampah Terkelola</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= CTA ================= -->
<section class="py-24">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-green-600 rounded-3xl p-16 text-center text-white shadow-xl">
            <h2 class="text-4xl font-bold">Siap Menjadi Bagian dari Perubahan?</h2>
            <p class="text-lg mt-6 leading-8">Bergabunglah bersama masyarakat lainnya untuk menciptakan lingkungan yang lebih hijau, bersih, dan berkelanjutan.</p>
            <div class="flex flex-wrap justify-center gap-4 mt-10">
                <button type="button" onclick="openLoginModal()" class="bg-white text-green-600 hover:bg-gray-100 px-10 py-4 rounded-xl font-bold transition">Login Sekarang</button>
                <button type="button" onclick="openRegisterModal()" class="border-2 border-white text-white hover:bg-white hover:text-green-600 px-10 py-4 rounded-xl font-bold transition">Daftar Akun Baru</button>
            </div>
        </div>
    </div>
</section>

<!-- ================= MODAL REGISTER ================= -->
<div id="registerModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background-color: rgba(0,0,0,0.6); align-items: center; justify-content: center; padding: 1rem; overflow-y: auto;">
    <div style="background-color: white; border-radius: 1.5rem; max-width: 28rem; width: 100%; padding: 2.5rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); margin: auto; position: relative;">
        <button onclick="closeRegisterModal()" style="position: absolute; top: 1rem; right: 1.5rem; background: none; border: none; cursor: pointer; color: #9ca3af;">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h2 class="text-2xl font-extrabold text-center text-green-700 mb-2">Daftar Akun Baru</h2>
        <p class="text-center text-sm text-gray-500 mb-6">Buat akun menggunakan Nama Pengguna</p>

        <form method="POST" action="{{ route('register.process') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Pengguna</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: BudiPeduli01">
            </div>
            <div class="mb-4 relative">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Password</label>
                <input type="password" id="regPassword" name="password" required class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Minimal 4 karakter">
                <button type="button" onclick="togglePassword('regPassword')" class="absolute right-3 top-8 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
            <div class="mb-6 relative">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Konfirmasi Password</label>
                <input type="password" id="regPasswordConf" name="password_confirmation" required class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Ulangi password">
                <button type="button" onclick="togglePassword('regPasswordConf')" class="absolute right-3 top-8 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-bold transition cursor-pointer">Daftar Sekarang</button>
            <p class="text-center text-sm text-gray-500 mt-4">Sudah punya akun? <a href="#" onclick="closeRegisterModal(); setTimeout(openLoginModal, 200);" class="text-green-600 font-bold hover:underline">Login di sini</a></p>
        </form>
    </div>
</div>

@endsection
