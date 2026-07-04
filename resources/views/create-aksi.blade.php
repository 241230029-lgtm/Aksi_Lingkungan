@extends('layouts.app')

@section('content')

<section class="bg-green-600 py-16">

    <div class="max-w-7xl mx-auto px-6">

        <h1 class="text-5xl font-bold text-white">
            Buat Aksi
        </h1>

        <p class="text-green-100 mt-3">
            Bagikan aksi lingkungan agar lebih banyak orang ikut berpartisipasi.
        </p>

    </div>

</section>

<section class="py-16 bg-gray-100">

<div class="max-w-5xl mx-auto px-6">

<div class="bg-white rounded-3xl shadow-lg p-10">

<form>

<div class="grid md:grid-cols-2 gap-6">

<div>

<label class="font-semibold">

Judul Aksi

</label>

<input
type="text"
placeholder="Masukkan judul aksi"
class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500">

</div>

<div>

<label class="font-semibold">

Kategori

</label>

<select
class="mt-2 w-full border rounded-xl px-4 py-3">

<option>Penghijauan</option>

<option>Daur Ulang</option>

<option>Bersih Sungai</option>

<option>Kerja Bakti</option>

<option>Edukasi</option>

</select>

</div>

</div>

<div class="mt-6">

<label class="font-semibold">

Lokasi

</label>

<input
type="text"
placeholder="Contoh : Bandung"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<div class="mt-6">

<label class="font-semibold">

Tanggal

</label>

<input
type="date"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<div class="mt-6">

<label class="font-semibold">

Deskripsi

</label>

<textarea
rows="6"
placeholder="Tuliskan deskripsi kegiatan..."
class="mt-2 w-full border rounded-xl px-4 py-3"></textarea>

</div>

<div class="mt-6">

<label class="font-semibold">

Upload Foto

</label>

<input
type="file"
class="mt-2 w-full border rounded-xl p-3">

</div>

<div class="mt-10 flex justify-end gap-4">

<button
type="reset"
class="px-8 py-3 rounded-xl border">

Reset

</button>

<button
type="submit"
class="px-8 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700">

Publikasikan

</button>

</div>

</form>

</div>

</div>

</section>

@endsection