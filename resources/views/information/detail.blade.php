@extends('layouts.app')
@section('content')

<section class="bg-gradient-to-br from-green-600 to-green-700 text-white py-16">
    <div class="max-w-5xl mx-auto px-6">
        <a href="{{ route('information.index') }}" class="text-green-200 hover:text-white inline-flex items-center gap-2 mb-6 text-sm font-medium transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Mading
        </a>
        <h1 class="text-3xl md:text-4xl font-extrabold">{{ $information->judul }}</h1>
        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-4 text-sm text-green-100">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                {{ $information->user->name ?? 'Admin' }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $information->created_at->format('d M Y') }}
            </span>
        </div>
    </div>
</section>

<section class="py-14 bg-gray-50">
<div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <img src="{{ $information->gambar ? asset('storage/' . $information->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}" class="w-full h-72 md:h-80 object-cover">
        <div class="p-8 md:p-10">
            <span class="bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-sm font-bold">Eco-Information</span>

            <div class="mt-8 border-t border-gray-100 pt-8">
                <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $information->deskripsi }}</div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection