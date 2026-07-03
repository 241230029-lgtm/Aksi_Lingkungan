@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">

<h1 class="text-3xl font-bold">

Manajemen Volunteer

</h1>

<button class="bg-green-600 text-white px-6 py-3 rounded-xl">

+ Tambah Volunteer

</button>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4">

No

</th>

<th>

Nama

</th>

<th>

Lokasi

</th>

<th>

Peserta

</th>

<th>

Status

</th>

<th>

Aksi

</th>

</tr>

</thead>

<tbody>

@for($i=1;$i<=10;$i++)

<tr class="border-b">

<td class="p-4">

{{ $i }}

</td>

<td>

Gerakan Bersih Sungai

</td>

<td>

Bandung

</td>

<td>

52

</td>

<td>

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

Aktif

</span>

</td>

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