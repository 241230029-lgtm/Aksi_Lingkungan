@extends('layouts.app')

@section('content')

<section class="bg-green-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('information.index') }}" class="text-green-100 hover:text-white text-sm">&larr; Kembali ke Mading</a>
        <h1 class="text-4xl font-bold mt-4">{{ $information->judul }}</h1>
        <p class="mt-3 text-green-100">✍️ {{ $information->penulis }} &nbsp;|&nbsp; 📅 {{ $information->created_at->format('d M Y') }}</p>
    </div>
</section>

<section class="py-16 bg-gray-100">
<div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <img src="{{ $information->gambar ? asset('storage/' . $information->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}" class="w-full h-80 object-cover">
        <div class="p-8">
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">{{ $information->kategori }}</span>
            <div class="text-gray-700 mt-6 leading-relaxed whitespace-pre-line">{{ $information->konten }}</div>
        </div>
    </div>
</div>
</section>

@endsection