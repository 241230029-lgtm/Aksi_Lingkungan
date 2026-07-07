@extends('layouts.app')

@section('content')

<section class="bg-green-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-5xl font-bold">Mading Informasi</h1>
        <p class="mt-4 text-lg text-green-100">Edukasi dan informasi seputar lingkungan hidup.</p>
    </div>
</section>

<section class="py-16 bg-gray-100">
<div class="max-w-7xl mx-auto px-6">

@if($informations->isEmpty())
    <div class="bg-white rounded-2xl shadow p-10 text-center">
        <p class="text-gray-500 text-lg">Belum ada informasi yang tersedia saat ini.</p>
    </div>
@else
<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">
    @foreach($informations as $info)
    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">
        <img src="{{ $info->gambar ? asset('storage/' . $info->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900' }}" class="h-60 w-full object-cover">
        <div class="p-6">
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">{{ $info->kategori }}</span>
            <h2 class="text-2xl font-bold mt-4">{{ $info->judul }}</h2>
            <p class="text-gray-500 mt-3">{{ Str::limit(strip_tags($info->konten), 100) }}</p>
            <div class="flex justify-between items-center mt-6">
                <div>
                    <p class="text-sm text-gray-500">✍️ {{ $info->penulis }}</p>
                    <p class="text-sm text-gray-500">📅 {{ $info->created_at->format('d M Y') }}</p>
                </div>
                <a href="{{ route('information.show', $info->id) }}" class="bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700">Baca</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

</div>
</section>

@endsection