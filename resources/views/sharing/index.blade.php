@extends('layouts.app')
@section('content')

<section class="bg-gradient-to-br from-green-600 to-green-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Eco-Sharing</h1>
        <p class="mt-4 text-lg text-green-100 max-w-xl">Bagikan atau temukan barang bekas pakai untuk lingkungan yang lebih baik.</p>
    </div>
</section>

<section class="py-14 bg-gray-50">
<div class="max-w-7xl mx-auto px-6">

@if($sharings->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-14 text-center">
        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <p class="text-gray-500">Belum ada barang yang dibagikan saat ini.</p>
    </div>
@else
<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-7">
    @foreach($sharings as $item)
    <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
        <div class="relative overflow-hidden">
            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900' }}" class="h-52 w-full object-cover group-hover:scale-105 transition duration-500">
            <span class="absolute top-3 left-3 bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Eco-Sharing</span>
        </div>
        <div class="p-6 flex flex-col flex-1">
            <h2 class="text-xl font-bold text-gray-900 leading-snug">{{ $item->judul }}</h2>
            <p class="text-gray-500 text-sm mt-2 flex-1">{{ Str::limit($item->deskripsi, 90) }}</p>
            <div class="border-t border-gray-100 mt-4 pt-4">
                <div class="flex justify-between items-end">
                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $item->lokasi }}
                        </p>
                        <p class="text-xs text-gray-400 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $item->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <a href="{{ route('katalog.show', ['tipe' => 'sharing', 'id' => $item->id_kegiatan]) }}" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition text-sm font-semibold shrink-0">Detail</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

</div>
</section>
@endsection