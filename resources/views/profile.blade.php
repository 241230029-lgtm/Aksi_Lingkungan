@extends('layouts.app')

@section('content')

<section class="bg-green-600 py-16">

    <div class="max-w-7xl mx-auto px-6">

        <h1 class="text-5xl font-bold text-white">
            Profil Saya
        </h1>

        <p class="text-green-100 mt-3">
            Kelola informasi akun dan aktivitas Anda.
        </p>

    </div>

</section>

<section class="py-16 bg-gray-100">

<div class="max-w-7xl mx-auto px-6">

<div class="grid lg:grid-cols-4 gap-8">

<!-- Sidebar -->

<div class="bg-white rounded-3xl shadow p-8">

<div class="text-center">

<div class="w-32 h-32 rounded-full bg-green-200 mx-auto"></div>

<h2 class="mt-5 text-2xl font-bold">

Budi Santoso

</h2>

<p class="text-gray-500">

budi@email.com

</p>

</div>

<hr class="my-6">

<nav class="space-y-3">

<a href="#" class="block px-4 py-3 rounded-xl bg-green-600 text-white">

Profil

</a>

<a href="#" class="block px-4 py-3 rounded-xl hover:bg-green-100">

Aktivitas Saya

</a>

<a href="#" class="block px-4 py-3 rounded-xl hover:bg-green-100">

Relawan

</a>

<a href="#" class="block px-4 py-3 rounded-xl hover:bg-green-100">

Pengaturan

</a>

<a href="#" class="block px-4 py-3 rounded-xl text-red-600 hover:bg-red-100">

Logout

</a>

</nav>

</div>

<!-- Content -->

<div class="lg:col-span-3">

<div class="bg-white rounded-3xl shadow p-8">

<h2 class="text-3xl font-bold mb-8">

Informasi Profil

</h2>

<div class="grid md:grid-cols-2 gap-6">

<div>

<label class="font-semibold">

Nama Lengkap

</label>

<input
type="text"
value="Budi Santoso"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<div>

<label class="font-semibold">

Email

</label>

<input
type="email"
value="budi@email.com"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<div>

<label class="font-semibold">

Nomor HP

</label>

<input
type="text"
value="08123456789"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<div>

<label class="font-semibold">

Alamat

</label>

<input
type="text"
value="Bandung"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

</div>

<div class="mt-8">

<button
class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl">

Simpan Perubahan

</button>

</div>

</div>

<!-- Statistik -->

<div class="grid md:grid-cols-3 gap-6 mt-8">

<div class="bg-white rounded-2xl shadow p-6 text-center">

<h2 class="text-4xl font-bold text-green-600">

12

</h2>

<p class="mt-2">

Aksi Dibuat

</p>

</div>

<div class="bg-white rounded-2xl shadow p-6 text-center">

<h2 class="text-4xl font-bold text-green-600">

8

</h2>

<p class="mt-2">

Relawan Diikuti

</p>

</div>

<div class="bg-white rounded-2xl shadow p-6 text-center">

<h2 class="text-4xl font-bold text-green-600">

34

</h2>

<p class="mt-2">

Postingan

</p>

</div>

</div>

</div>

</div>

</div>

</section>

@endsection