@extends('layouts.app')

@section('content')

<section class="bg-green-600 text-white py-16">

    <div class="max-w-7xl mx-auto px-6">

        <h1 class="text-5xl font-bold">

            Katalog Aksi Lingkungan

        </h1>

        <p class="mt-4 text-lg text-green-100">

            Temukan berbagai aksi lingkungan yang dapat kamu ikuti.

        </p>

    </div>

</section>


<section class="py-10 bg-gray-100">

<div class="max-w-7xl mx-auto px-6">

<div class="bg-white rounded-2xl shadow p-6">

<div class="grid lg:grid-cols-4 gap-4">

<input
type="text"
placeholder="Cari aksi..."
class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">

<select class="border rounded-xl px-4 py-3">

<option>Semua Kategori</option>

<option>Penghijauan</option>

<option>Daur Ulang</option>

<option>Kerja Bakti</option>

<option>Bersih Sungai</option>

</select>

<select class="border rounded-xl px-4 py-3">

<option>Semua Lokasi</option>

<option>Bandung</option>

<option>Jakarta</option>

<option>Surabaya</option>

</select>

<button
class="bg-green-600 text-white rounded-xl hover:bg-green-700">

Cari

</button>

</div>

</div>

</div>

</section>



<section class="py-16">

<div class="max-w-7xl mx-auto px-6">

<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">

@for($i=1;$i<=9;$i++)

<div
class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

<img
src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900"
class="h-60 w-full object-cover">

<div class="p-6">

<span
class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

Penghijauan

</span>

<h2
class="text-2xl font-bold mt-4">

Gerakan Tanam Pohon

</h2>

<p
class="text-gray-500 mt-3">

Mari bersama melakukan penghijauan
di lingkungan sekitar agar udara
lebih bersih dan sehat.

</p>

<div
class="flex justify-between items-center mt-6">

<div>

<p class="text-sm text-gray-500">

📍 Bandung

</p>

<p class="text-sm text-gray-500">

👥 120 Relawan

</p>

</div>

<a
href="#"
class="bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700">

Detail

</a>

</div>

</div>

</div>

@endfor

</div>

<div class="mt-10 flex justify-center">

<nav class="flex gap-2">

<button
class="w-10 h-10 rounded-lg border">

1

</button>

<button
class="w-10 h-10 rounded-lg bg-green-600 text-white">

2

</button>

<button
class="w-10 h-10 rounded-lg border">

3

</button>

<button
class="w-10 h-10 rounded-lg border">

>

</button>

</nav>

</div>

</div>

</section>

@endsection