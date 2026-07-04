@extends('layouts.app')

@section('content')

<!-- Hero -->
<section class="bg-gradient-to-r from-green-50 to-white">
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div>
                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                    🌿 Platform Peduli Lingkungan
                </span>

                <h1 class="text-5xl font-bold leading-tight mt-6">
                    Bersama Bergerak,
                    <span class="text-green-600">
                        Lestarikan Bumi Kita
                    </span>
                </h1>

                <p class="text-gray-600 mt-6 text-lg">
                    Temukan aksi sosial, edukasi lingkungan,
                    forum diskusi, dan kegiatan relawan
                    dalam satu platform.
                </p>

                <div class="mt-8 flex gap-4">

                    <a href="/katalog"
                        class="bg-green-600 hover:bg-green-700 text-white px-7 py-3 rounded-xl font-semibold">

                        Jelajahi Katalog

                    </a>

                    <a href="/buat-aksi"
                        class="border border-green-600 text-green-600 hover:bg-green-50 px-7 py-3 rounded-xl font-semibold">

                        Buat Aksi

                    </a>

                </div>

            </div>

            <div>

                <img
                    src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900"
                    class="rounded-3xl shadow-xl w-full">

            </div>

        </div>
    </div>
</section>

<!-- Statistik -->

<section class="py-16">

<div class="max-w-7xl mx-auto px-6">

<div class="grid md:grid-cols-4 gap-6">

<div class="bg-white rounded-2xl shadow p-8 text-center">

<h2 class="text-4xl font-bold text-green-600">

1250+

</h2>

<p class="text-gray-500 mt-2">

Aksi Lingkungan

</p>

</div>

<div class="bg-white rounded-2xl shadow p-8 text-center">

<h2 class="text-4xl font-bold text-green-600">

850+

</h2>

<p class="text-gray-500 mt-2">

Relawan Aktif

</p>

</div>

<div class="bg-white rounded-2xl shadow p-8 text-center">

<h2 class="text-4xl font-bold text-green-600">

320+

</h2>

<p class="text-gray-500 mt-2">

Komunitas

</p>

</div>

<div class="bg-white rounded-2xl shadow p-8 text-center">

<h2 class="text-4xl font-bold text-green-600">

2.150 Kg

</h2>

<p class="text-gray-500 mt-2">

Sampah Terkelola

</p>

</div>

</div>

</div>

</section>

<!-- Kategori -->

<section class="pb-20">

<div class="max-w-7xl mx-auto px-6">

<div class="flex justify-between items-center mb-8">

<h2 class="text-3xl font-bold">

Kategori Populer

</h2>

<a href="/katalog" class="text-green-600">

Lihat Semua →

</a>

</div>

<div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6">

@foreach([
['🌱','Penghijauan'],
['♻️','Daur Ulang'],
['🧹','Kerja Bakti'],
['🌊','Bersih Sungai'],
['🌳','Penanaman Pohon'],
['📚','Edukasi'],
['🤝','Relawan'],
['💬','Forum']
] as $item)

<div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-8 text-center">

<div class="text-6xl">

{{ $item[0] }}

</div>

<h3 class="font-bold mt-5">

{{ $item[1] }}

</h3>

</div>

@endforeach

</div>

</div>

</section>

<!-- Aksi Terbaru -->

<section class="bg-gray-100 py-20">

<div class="max-w-7xl mx-auto px-6">

<h2 class="text-3xl font-bold mb-10">

Aksi Terbaru

</h2>

<div class="grid lg:grid-cols-3 gap-8">

@for($i=1;$i<=3;$i++)

<div class="bg-white rounded-2xl shadow overflow-hidden">

<img
src="https://images.unsplash.com/photo-1528323273322-d81458248d40?w=900"
class="h-56 w-full object-cover">

<div class="p-6">

<h3 class="font-bold text-xl">

Gerakan Bersih Pantai

</h3>

<p class="text-gray-500 mt-3">

Kegiatan gotong royong membersihkan
pantai bersama masyarakat.

</p>

<div class="mt-6">

<a href="#"
class="text-green-600 font-semibold">

Selengkapnya →

</a>

</div>

</div>

</div>

@endfor

</div>

</div>

</section>

<!-- CTA -->

<section class="py-20">

<div class="max-w-6xl mx-auto px-6">

<div class="bg-green-600 rounded-3xl p-16 text-center text-white">

<h2 class="text-4xl font-bold">

Ayo Bergabung Menjadi Agen Perubahan

</h2>

<p class="mt-6 text-lg">

Mulailah aksi kecil hari ini untuk masa depan bumi yang lebih hijau.

</p>

<a href="/buat-aksi"

class="inline-block mt-8 bg-white text-green-600 px-8 py-4 rounded-xl font-bold">

Mulai Sekarang

</a>

</div>

</div>

</section>

@endsection