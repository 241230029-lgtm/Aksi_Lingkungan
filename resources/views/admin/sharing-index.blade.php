@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">

<h1 class="text-3xl font-bold">

Forum Sharing

</h1>

<button class="bg-green-600 text-white px-6 py-3 rounded-xl">

+ Posting

</button>

</div>

<div class="grid lg:grid-cols-2 gap-6">

@for($i=1;$i<=6;$i++)

<div class="bg-white rounded-2xl shadow p-6">

<h2 class="text-xl font-bold">

Cara Mengurangi Sampah Plastik

</h2>

<p class="text-gray-500 mt-3">

Diskusi mengenai solusi pengurangan sampah plastik
di lingkungan sekitar.

</p>

<div class="flex justify-between mt-6">

<span>

💬 25 Komentar

</span>

<div>

<button class="bg-blue-500 text-white px-3 py-2 rounded-lg">

Edit

</button>

<button class="bg-red-500 text-white px-3 py-2 rounded-lg">

Hapus

</button>

</div>

</div>

</div>

@endfor

</div>

@endsection