@extends('layouts.app')

@section('content')

<section class="bg-green-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('volunteer.index') }}" class="text-green-100 hover:text-white text-sm">&larr; Kembali ke Eco-Volunteer</a>
        <h1 class="text-4xl font-bold mt-4">{{ $kegiatan->judul }}</h1>
        <p class="mt-3 text-green-100">
            📅 {{ $kegiatan->tanggal_kejadian ? \Carbon\Carbon::parse($kegiatan->tanggal_kejadian)->format('d M Y') : '-' }}
            &nbsp;|&nbsp;
            📍 {{ $kegiatan->lokasi }}
        </p>
    </div>
</section>

<section class="py-16 bg-gray-100">
<div class="max-w-4xl mx-auto px-6">

    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <img src="{{ $kegiatan->gambar ? asset('storage/' . $kegiatan->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}" class="w-full h-80 object-cover">
        <div class="p-8">
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Eco-Volunteer</span>

            <p class="text-gray-700 mt-6 leading-relaxed whitespace-pre-line">{{ $kegiatan->deskripsi }}</p>

            <div class="mt-6 flex gap-6">
                <p class="text-sm text-gray-500">👥 {{ $jumlahPendaftar }}/{{ $kegiatan->kuota_relawan ?? '∞' }} Relawan</p>
            </div>

            @if(session('success'))
            <div class="mt-6 bg-green-100 text-green-700 px-4 py-3 rounded-xl">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="mt-6 bg-red-100 text-red-700 px-4 py-3 rounded-xl">{{ session('error') }}</div>
            @endif

            @auth
                @if($sudahDaftar)
                <div class="mt-8 bg-gray-100 rounded-xl p-6 text-center text-gray-600">
                    Kamu sudah terdaftar sebagai relawan di kegiatan ini.
                </div>
                @else
                <form method="POST" action="{{ route('volunteer.daftar', $kegiatan->id_kegiatan) }}" class="mt-8 bg-gray-50 rounded-xl p-6">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan ingin bergabung</label>
                    <textarea name="alasan_bergabung" rows="4" required minlength="10" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none" placeholder="Ceritakan alasan kamu ingin menjadi relawan di kegiatan ini..."></textarea>
                    <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700">Daftar Sebagai Relawan</button>
                </form>
                @endif
            @else
                <div class="mt-8 bg-gray-100 rounded-xl p-6 text-center text-gray-600">
                    <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">Login</a> terlebih dahulu untuk mendaftar sebagai relawan.
                </div>
            @endauth

        </div>
    </div>

</div>
</section>

@endsection