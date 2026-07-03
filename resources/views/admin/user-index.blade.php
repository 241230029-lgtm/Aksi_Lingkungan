@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold">
            Manajemen User
        </h1>

        <p class="text-gray-500">
            Kelola seluruh pengguna aplikasi.
        </p>
    </div>

    <button
        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

        + Tambah User

    </button>

</div>


<div class="bg-white rounded-2xl shadow">

<div class="p-6 border-b">

<input
type="text"
placeholder="Cari user..."
class="border rounded-xl px-4 py-3 w-80">

</div>

<div class="overflow-x-auto">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4 text-left">

No

</th>

<th class="p-4 text-left">

Nama

</th>

<th class="p-4">

Email

</th>

<th>

Role

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

<tr class="border-b hover:bg-gray-50">

<td class="p-4">

{{ $i }}

</td>

<td>

Budi Santoso

</td>

<td>

budi@email.com

</td>

<td class="text-center">

User

</td>

<td class="text-center">

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

Aktif

</span>

</td>

<td class="text-center">

<button
class="bg-blue-500 text-white px-3 py-2 rounded-lg">

Edit

</button>

<button
class="bg-red-500 text-white px-3 py-2 rounded-lg">

Hapus

</button>

</td>

</tr>

@endfor

</tbody>

</table>

</div>

</div>

@endsection