@extends('layouts.admin')

@section('content')

<div class="grid lg:grid-cols-4 gap-6">

<div class="bg-white rounded-2xl shadow p-8">

<p class="text-gray-500">

Total User

</p>

<h2 class="text-5xl font-bold text-green-600 mt-3">

320

</h2>

</div>

<div class="bg-white rounded-2xl shadow p-8">

<p class="text-gray-500">

Relawan

</p>

<h2 class="text-5xl font-bold text-green-600 mt-3">

150

</h2>

</div>

<div class="bg-white rounded-2xl shadow p-8">

<p class="text-gray-500">

Artikel

</p>

<h2 class="text-5xl font-bold text-green-600 mt-3">

85

</h2>

</div>

<div class="bg-white rounded-2xl shadow p-8">

<p class="text-gray-500">

Sharing

</p>

<h2 class="text-5xl font-bold text-green-600 mt-3">

42

</h2>

</div>

</div>

<div class="grid lg:grid-cols-3 gap-8 mt-10">

<div class="lg:col-span-2 bg-white rounded-2xl shadow p-8">

<h2 class="text-2xl font-bold mb-6">

Aktivitas Terbaru

</h2>

<table class="w-full">

<thead>

<tr class="border-b">

<th class="text-left py-3">

Nama

</th>

<th>

Status

</th>

<th>

Tanggal

</th>

</tr>

</thead>

<tbody>

@for($i=1;$i<=8;$i++)

<tr class="border-b">

<td class="py-4">

Gerakan Tanam Pohon

</td>

<td>

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

Aktif

</span>

</td>

<td>

10 Juni 2026

</td>

</tr>

@endfor

</tbody>

</table>

</div>

<div class="bg-white rounded-2xl shadow p-8">

<h2 class="text-2xl font-bold mb-5">

Ringkasan

</h2>

<ul class="space-y-5">

<li>👤 25 User Baru</li>

<li>🌱 5 Kegiatan Baru</li>

<li>🤝 13 Volunteer Baru</li>

<li>📚 9 Artikel Baru</li>

<li>💬 7 Sharing Baru</li>

</ul>

</div>

</div>

@endsection