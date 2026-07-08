@extends('layouts.app')
@section('content')

<section class="bg-gradient-to-br from-green-600 to-green-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('volunteer.index') }}" class="text-green-200 hover:text-white inline-flex items-center gap-2 mb-6 text-sm font-medium transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Eco-Volunteer
        </a>
        <h1 class="text-3xl md:text-4xl font-extrabold">{{ $kegiatan->judul }}</h1>
        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-4 text-sm text-green-100">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $kegiatan->tanggal_kejadian ? \Carbon\Carbon::parse($kegiatan->tanggal_kejadian)->format('d M Y') : '-' }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $kegiatan->lokasi }}
            </span>
        </div>
    </div>
</section>

<section class="py-14 bg-gray-50">
<div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <img src="{{ $kegiatan->gambar ? asset('storage/' . $kegiatan->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}" class="w-full h-72 md:h-80 object-cover">
        <div class="p-8 md:p-10">
            <span class="bg-amber-100 text-amber-700 px-4 py-1.5 rounded-full text-sm font-bold">Eco-Volunteer</span>

            <p class="text-gray-600 mt-6 leading-relaxed whitespace-pre-line">{{ $kegiatan->deskripsi }}</p>

            @php
                $kuota = $kegiatan->kuota_relawan;
                $persen = $kuota ? min(100, round(($jumlahPendaftar / $kuota) * 100)) : 0;
            @endphp

            <div class="mt-8 bg-gray-50 border border-gray-100 rounded-xl p-5">
                <div class="flex justify-between items-center text-sm mb-2">
                    <span class="text-gray-600 font-medium flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/></svg>
                        Relawan Terdaftar
                    </span>
                    <span class="font-bold text-gray-800">{{ $jumlahPendaftar }}/{{ $kegiatan->kuota_relawan ?? '∞' }}</span>
                </div>
                @if($kuota)
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full transition-all" style="width: {{ $persen }}%"></div>
                </div>
                @endif
            </div>

            @if(session('success'))
            <div class="mt-6 bg-green-50 text-green-700 border border-green-200 px-4 py-3 rounded-xl text-sm font-semibold">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="mt-6 bg-red-50 text-red-700 border border-red-200 px-4 py-3 rounded-xl text-sm font-semibold">{{ session('error') }}</div>
            @endif

            @auth
                @if($sudahDaftar)
                <div class="mt-8 bg-gray-50 border border-gray-100 rounded-xl p-6 text-center text-gray-600 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Kamu sudah terdaftar sebagai relawan di kegiatan ini.
                </div>
                @else
                <form method="POST" action="{{ route('volunteer.daftar', $kegiatan->id_kegiatan) }}" class="mt-8 bg-gray-50 border border-gray-100 rounded-xl p-6">
                    @csrf
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan ingin bergabung</label>
                    <textarea name="alasan_bergabung" rows="4" required minlength="10" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" placeholder="Ceritakan alasan kamu ingin menjadi relawan di kegiatan ini..."></textarea>
                    <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-bold transition shadow">Daftar Sebagai Relawan</button>
                </form>
                @endif
            @else
                <div class="mt-8 bg-gray-50 border border-gray-100 rounded-xl p-6 text-center text-gray-600">
                    <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">Login</a> terlebih dahulu untuk mendaftar sebagai relawan.
                </div>
            @endauth
        </div>
    </div>
</div>
</section>
@endsection