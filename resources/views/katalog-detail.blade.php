@extends('layouts.app')

@section('content')

@php
    $badgeColor = match($item->kategori) {
        'Eco-Volunteer' => 'bg-amber-100 text-amber-700',
        'Eco-Sharing' => 'bg-purple-100 text-purple-700',
        default => 'bg-blue-100 text-blue-700',
    };
@endphp

<section class="bg-gradient-to-br from-green-600 to-green-700 text-white py-14">
    <div class="max-w-5xl mx-auto px-6">
        <a href="{{ route('katalog') }}" class="text-green-200 hover:text-white inline-flex items-center gap-2 mb-6 text-sm font-medium transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Katalog
        </a>
        <h1 class="text-3xl md:text-4xl font-extrabold">Detail Aksi Lingkungan</h1>
    </div>
</section>

<section class="py-14 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

            @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-80 md:h-96 object-cover">
            @else
                <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">Tidak Ada Gambar</div>
            @endif

            <div class="p-8 md:p-10">
                <span class="{{ $badgeColor }} px-4 py-1.5 rounded-full text-sm font-bold">{{ $item->kategori_label }}</span>

                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mt-5">{{ $item->judul }}</h2>

                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-4 text-sm text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $item->created_at->format('d F Y') }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $item->lokasi }}
                    </span>
                    @if(!empty($item->tanggal_kejadian))
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d F Y') }}
                    </span>
                    @endif
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Oleh <span class="text-green-600 font-semibold">{{ $item->user->name ?? 'Administrator' }}</span>
                    </span>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-3">Deskripsi Kegiatan</h3>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $item->deskripsi }}</p>
                </div>

                <div class="mt-10 border-t border-gray-100 pt-8">

                    @if($item->kategori == 'Eco-Sharing')
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Tertarik Mendapatkan Barang Ini?</h3>
                        <p class="text-gray-600 mb-6 text-sm">Hubungi langsung penyedia barang melalui WhatsApp untuk konfirmasi pengambilan atau pengiriman.</p>

                        @if($item->link_kontak)
                            <a href="{{ $item->link_kontak }}" target="_blank" class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-7 py-3.5 rounded-xl font-bold transition shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Hubungi via WhatsApp
                            </a>
                        @else
                            <p class="text-sm text-red-500 bg-red-50 inline-block px-4 py-2 rounded-lg">* Belum ada kontak WhatsApp yang tersedia.</p>
                        @endif

                    @elseif($item->kategori == 'Eco-Volunteer')
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Menjadi Relawan</h3>

                        @if($item->kuota_relawan)
                        <div class="mb-6 bg-amber-50 border border-amber-100 rounded-xl p-4">
                            <p class="text-sm text-amber-800 font-semibold">Sisa Kuota: {{ $item->kuota_relawan }} Orang</p>
                        </div>
                        @endif

                        @if(!auth()->check())
                            <p class="text-gray-600 mb-4 text-sm">Anda harus login terlebih dahulu untuk mendaftar sebagai relawan.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">Login Sekarang</a>
                        @else
                            @if(session('success'))
                                <div class="mb-4 p-4 bg-green-50 text-green-700 border border-green-200 rounded-xl font-semibold text-sm">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="mb-4 p-4 bg-red-50 text-red-700 border border-red-200 rounded-xl font-semibold text-sm">{{ session('error') }}</div>
                            @endif

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-50 text-red-700 border border-red-200 rounded-xl text-sm">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form method="POST" action="{{ route('volunteer.daftar', $item->id_kegiatan) }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Mengapa Anda ingin bergabung? *</label>
                                    <textarea name="alasan_bergabung" rows="4" required placeholder="Ceritakan motivasi Anda..." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 outline-none"></textarea>
                                </div>
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-7 py-3 rounded-xl font-bold transition shadow">Kirim Pendaftaran</button>
                            </form>
                        @endif

                    @else
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 flex gap-3">
                            <svg class="w-6 h-6 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <h3 class="text-base font-bold text-blue-800 mb-1">Informasi Edukasi</h3>
                                <p class="text-blue-700 text-sm">Halaman ini berisi materi edukasi satu arah. Jika ada pertanyaan lebih lanjut, silakan hubungi pembuat aksi melalui halaman katalog.</p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@endsection