@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold">
            Manajemen Informasi
        </h1>

        <p class="text-gray-500">
            Kelola artikel dan edukasi lingkungan.
        </p>
    </div>

    <button class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700">
        + Tambah Artikel
    </button>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4">No</th>

<th>Judul</th>

<th>Kategori</th>

<th>Penulis</th>

<th>Tanggal</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@for($i=1;$i<=8;$i++)

<tr class="border-b hover:bg-gray-50">

<td class="p-4">{{ $i }}</td>

<td>Edukasi Daur Ulang Sampah</td>

<td>Edukasi</td>

<td>Admin</td>

<td>10 Juni 2026</td>

<td>

<button class="bg-blue-500 text-white px-3 py-2 rounded-lg">
Edit
</button>

<button class="bg-red-500 text-white px-3 py-2 rounded-lg">
Hapus
</button>

</td>

</tr>

@endfor

</tbody>

</table>

</div>

@endsection