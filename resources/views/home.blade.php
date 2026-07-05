@extends('layouts.guest')

@section('content')

<!-- ================= HERO ================= -->
<section class="bg-gradient-to-r from-green-50 via-white to-green-100">

    <div class="max-w-7xl mx-auto px-6 py-24">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <span class="inline-block bg-green-100 text-green-700 px-5 py-2 rounded-full font-medium">
                    🌿 Platform Digital Peduli Lingkungan
                </span>

                <h1 class="text-5xl lg:text-6xl font-bold leading-tight mt-8">

                    Bersama Mewujudkan

                    <span class="text-green-600">

                        Lingkungan yang Lebih Bersih

                    </span>

                </h1>

                <p class="text-gray-600 text-lg mt-8 leading-8">

                    Aksi Lingkungan merupakan platform yang menghubungkan masyarakat,
                    relawan, dan komunitas untuk berkolaborasi menjaga kelestarian
                    lingkungan melalui berbagai kegiatan sosial dan edukasi.

                </p>

                <div class="flex flex-wrap gap-4 mt-10">

                    <button
                        type="button"
                        onclick="openLoginModal()"
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-semibold shadow-lg transition">

                        Login Sekarang

                    </button>

                    <a href="#tentang"
                        class="border border-green-600 text-green-600 hover:bg-green-50 px-8 py-4 rounded-xl font-semibold transition">

                        Pelajari Lebih Lanjut

                    </a>

                </div>

            </div>

            <div>

                <img
                    src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900"
                    alt="Lingkungan"
                    class="rounded-3xl shadow-2xl w-full">

            </div>

        </div>

    </div>

</section>

<!-- ================= TENTANG ================= -->

<section id="tentang" class="py-24 bg-white">

    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold">

            Tentang Aksi Lingkungan

        </h2>

        <p class="text-gray-600 text-lg leading-9 mt-8">

            Aksi Lingkungan adalah platform digital yang bertujuan meningkatkan
            kepedulian masyarakat terhadap lingkungan melalui kolaborasi antara
            masyarakat, relawan, dan komunitas.

            Platform ini menjadi wadah untuk berbagi informasi, mengikuti kegiatan,
            serta berpartisipasi dalam aksi nyata demi menciptakan lingkungan yang
            lebih bersih, hijau, dan berkelanjutan.

        </p>

    </div>

</section>

<!-- ================= VISI MISI ================= -->

<section class="bg-green-50 py-24">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-10">

            <div class="bg-white rounded-3xl shadow-lg p-10">

                <h3 class="text-3xl font-bold text-green-700 mb-6">

                    🌍 Visi

                </h3>

                <p class="text-gray-600 leading-8">

                    Menjadi platform digital yang mampu meningkatkan partisipasi
                    masyarakat dalam menjaga kelestarian lingkungan secara
                    berkelanjutan.

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-10">

                <h3 class="text-3xl font-bold text-green-700 mb-6">

                    🎯 Misi

                </h3>

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

        <h2 class="text-4xl font-bold text-center mb-16">

            Cara Menggunakan Aplikasi

        </h2>

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8">

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <div class="text-6xl">1️⃣</div>

                <h3 class="font-bold text-xl mt-6">

                    Login

                </h3>

                <p class="text-gray-500 mt-4">

                    Masuk menggunakan akun Anda.

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <div class="text-6xl">2️⃣</div>

                <h3 class="font-bold text-xl mt-6">

                    Jelajahi

                </h3>

                <p class="text-gray-500 mt-4">

                    Temukan berbagai kegiatan lingkungan.

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <div class="text-6xl">3️⃣</div>

                <h3 class="font-bold text-xl mt-6">

                    Berpartisipasi

                </h3>

                <p class="text-gray-500 mt-4">

                    Ikut menjadi relawan dalam kegiatan.

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <div class="text-6xl">4️⃣</div>

                <h3 class="font-bold text-xl mt-6">

                    Berikan Dampak

                </h3>

                <p class="text-gray-500 mt-4">

                    Bersama menciptakan lingkungan yang lebih baik.

                </p>

            </div>

        </div>

    </div>

</section>

<!-- ================= STATISTIK ================= -->

<section class="bg-gray-100 py-24">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8">

            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">

                <h2 class="text-5xl font-bold text-green-600">

                    1.250+

                </h2>

                <p class="mt-4 text-gray-600">

                    Aksi Lingkungan

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">

                <h2 class="text-5xl font-bold text-green-600">

                    850+

                </h2>

                <p class="mt-4 text-gray-600">

                    Relawan Aktif

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">

                <h2 class="text-5xl font-bold text-green-600">

                    320+

                </h2>

                <p class="mt-4 text-gray-600">

                    Komunitas

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">

                <h2 class="text-5xl font-bold text-green-600">

                    2.150 Kg

                </h2>

                <p class="mt-4 text-gray-600">

                    Sampah Terkelola

                </p>

            </div>

        </div>

    </div>

</section>

<!-- ================= CTA ================= -->

<section class="py-24">

    <div class="max-w-5xl mx-auto px-6">

        <div class="bg-green-600 rounded-3xl p-16 text-center text-white shadow-xl">

            <h2 class="text-4xl font-bold">

                Siap Menjadi Bagian dari Perubahan?

            </h2>

            <p class="text-lg mt-6 leading-8">

                Bergabunglah bersama masyarakat lainnya untuk menciptakan
                lingkungan yang lebih hijau, bersih, dan berkelanjutan.

            </p>

            <button
                type="button"
                onclick="openLoginModal()"
                class="inline-block mt-10 bg-white text-green-600 hover:bg-gray-100 px-10 py-4 rounded-xl font-bold transition">

                Login Sekarang

            </button>

        </div>

    </div>

</section>

@endsection
