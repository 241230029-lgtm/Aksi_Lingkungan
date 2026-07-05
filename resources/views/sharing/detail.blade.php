@extends('layouts.app')

@section('content')

<section class="bg-green-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('sharing.index') }}" class="text-green-100 hover:text-white text-sm">&larr; Kembali ke Eco-Sharing</a>
        <h1 class="text-4xl font-bold mt-4">{{ $sharing->judul }}</h1>
        <p class="mt-3 text-green-100">📅 {{ $sharing->created_at->format('d M Y') }} &nbsp;|&nbsp; 📍 {{ $sharing->lokasi }}</p>
    </div>
</section>

<section class="py-16 bg-gray-100">
<div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <img src="{{ $sharing->gambar ? asset('storage/' . $sharing->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}" class="w-full h-80 object-cover">
        <div class="p-8">
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Eco-Sharing</span>
            <p class="text-gray-700 mt-6 leading-relaxed whitespace-pre-line">{{ $sharing->deskripsi }}</p>
            @if($sharing->link_kontak)
            <div class="mt-8">
                <a href="{{ $sharing->link_kontak }}" target="_blank" class="inline-block bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700">Hubungi Pemilik</a>
            </div>
            @endif
        </div>
    </div>
</div>
</section>

@endsection
