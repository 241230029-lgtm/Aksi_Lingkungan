@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="bg-green-50 border-b border-green-100 text-green-700 py-3 text-center font-medium text-sm">
    {{ session('success') }}
</div>
@endif

<section class="bg-gradient-to-br from-green-600 to-green-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Katalog Aksi Lingkungan</h1>
        <p class="mt-4 text-lg text-green-100 max-w-xl">Temukan berbagai aksi relawan, informasi edukasi, dan barang yang dibagikan untuk lingkungan yang lebih baik.</p>
    </div>
</section>

<section class="py-8 bg-gray-50 border-b border-gray-100">
<div class="max-w-7xl mx-auto px-6">
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
<form method="GET" action="{{ route('katalog') }}" class="grid lg:grid-cols-4 gap-3">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari judul aksi..." class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
    <select name="kategori" class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 outline-none">
        <option value="semua">Semua Kategori</option>
        <option value="Eco-Volunteer" {{ request('kategori') == 'Eco-Volunteer' ? 'selected' : '' }}>Relawan</option>
        <option value="Eco-Sharing" {{ request('kategori') == 'Eco-Sharing' ? 'selected' : '' }}>Sharing</option>
        <option value="Eco-Information" {{ request('kategori') == 'Eco-Information' ? 'selected' : '' }}>Informasi</option>
    </select>
    <select name="lokasi" class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 outline-none">
        <option value="semua">Semua Lokasi</option>
        @foreach($lokasiList as $lokasi)
        <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>{{ $lokasi }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-semibold text-sm flex items-center justify-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
        Cari
    </button>
</form>
</div>
</div>
</section>

<section class="py-14 bg-gray-50">
<div class="max-w-7xl mx-auto px-6">

@if($items->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-14 text-center">
        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-gray-500">Tidak ada aksi yang ditemukan.</p>
    </div>
@else
<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-7">
    @foreach($items as $item)
    @php
        $badgeColor = match($item->kategori_label) {
            'Relawan' => 'bg-amber-100 text-amber-700',
            'Sharing' => 'bg-purple-100 text-purple-700',
            default => 'bg-blue-100 text-blue-700',
        };
    @endphp
    <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
        <div class="relative overflow-hidden">
            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900' }}" class="h-52 w-full object-cover group-hover:scale-105 transition duration-500">
            <span class="absolute top-3 left-3 {{ $badgeColor }} px-3 py-1 rounded-full text-xs font-bold shadow-sm">{{ $item->kategori_label }}</span>
        </div>
        <div class="p-6 flex flex-col flex-1">
            <h2 class="text-xl font-bold text-gray-900 leading-snug">{{ $item->judul }}</h2>
            <p class="text-gray-500 text-sm mt-2 flex-1">{{ Str::limit($item->deskripsi, 90) }}</p>
            <div class="border-t border-gray-100 mt-4 pt-4">
                <p class="text-xs text-gray-400 mb-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ $item->user->name ?? 'Administrator' }}
                </p>
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-500 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $item->lokasi }}
                    </p>
                    <a href="{{ $item->detailRoute() }}" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition text-sm font-semibold">Detail</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-10 flex justify-center">
    {{ $items->links() }}
</div>
@endif

</div>
</section>
@endsection