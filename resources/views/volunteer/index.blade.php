@extends('layouts.app')
@section('content')

<section class="bg-gradient-to-br from-green-600 to-green-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Eco-Volunteer</h1>
        <p class="mt-4 text-lg text-green-100 max-w-xl">Temukan aksi relawan dan ambil bagian untuk lingkungan yang lebih baik.</p>
    </div>
</section>

<section class="py-14 bg-gray-50">
<div class="max-w-7xl mx-auto px-6">

@if($kegiatans->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-14 text-center">
        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/></svg>
        <p class="text-gray-500">Belum ada aksi relawan yang tersedia saat ini.</p>
    </div>
@else
<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-7">
    @foreach($kegiatans as $item)
    @php
        $kuota = $item->kuota_relawan;
        $jumlah = $item->pendaftarans->count();
        $persen = $kuota ? min(100, round(($jumlah / $kuota) * 100)) : 0;
    @endphp
    <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
        <div class="relative overflow-hidden">
            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900' }}" class="h-52 w-full object-cover group-hover:scale-105 transition duration-500">
            <span class="absolute top-3 left-3 bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Eco-Volunteer</span>
        </div>
        <div class="p-6 flex flex-col flex-1">
            <h2 class="text-xl font-bold text-gray-900 leading-snug">{{ $item->judul }}</h2>
            <p class="text-gray-500 text-sm mt-2 flex-1">{{ Str::limit($item->deskripsi, 90) }}</p>

            <p class="text-sm text-gray-500 mt-4 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $item->lokasi }}
            </p>

            <div class="mt-3">
                <div class="flex justify-between items-center text-xs mb-1.5">
                    <span class="text-gray-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/></svg>
                        Relawan
                    </span>
                    <span class="font-semibold text-gray-700">{{ $jumlah }}/{{ $kuota ?? '∞' }}</span>
                </div>
                @if($kuota)
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-green-600 h-1.5 rounded-full" style="width: {{ $persen }}%"></div>
                </div>
                @endif
            </div>

            <div class="border-t border-gray-100 mt-4 pt-4 flex justify-end">
                <a href="{{ route('katalog.show', ['tipe' => 'volunteer', 'id' => $item->id_kegiatan]) }}" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition text-sm font-semibold">Detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

</div>
</section>
@endsection