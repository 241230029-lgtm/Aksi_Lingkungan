@extends('layouts.app')

@section('content')

<section class="bg-green-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('katalog') }}" class="text-green-200 hover:text-white inline-flex items-center gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Katalog
        </a>
        <h1 class="text-4xl font-bold">Detail Aksi Lingkungan</h1>
    </div>
</section>

<section class="py-16">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

            @if($gambar)
                <img src="{{ asset('storage/' . $gambar) }}" class="w-full h-96 object-cover">
            @else
                <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-gray-400 text-lg">Tidak Ada Gambar</div>
            @endif

            <div class="p-10">
                <span class="bg-green-100 text-green-700 px-4 py-1.5 rounded-full text-sm font-bold">{{ $kategoriLabel }}</span>

                <h2 class="text-3xl font-extrabold text-gray-900 mt-6">{{ $item->judul }}</h2>

                <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-500">
                    <span>📅 {{ $item->created_at->format('d F Y') }}</span>
                    @if($lokasi)
                        <span>📍 {{ $lokasi }}</span>
                    @endif
                    @if($tipe === 'volunteer' && !empty($item->tanggal_kejadian))
                        <span>🗓️ {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d F Y') }}</span>
                    @endif
                    <span>✍️ Oleh: <span class="text-green-600 font-semibold">{{ $namaPembuat }}</span></span>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $deskripsi }}</p>
                </div>

                {{-- ========================================== --}}
                {{-- AREA DINAMIS BERDASARKAN TIPE --}}
                {{-- ========================================== --}}
                <div class="mt-10 border-t border-gray-100 pt-8">

                    @if($tipe === 'sharing')
                        {{-- ECO-SHARING: TOMBOL HUBUNGI VIA WHATSAPP --}}
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Tertarik Mendapatkan Barang Ini?</h3>
                        <p class="text-gray-600 mb-6">Hubungi langsung penyedia barang untuk konfirmasi pengambilan atau pengiriman.</p>

                        @if(!empty($item->link_kontak))
                            <a href="{{ $item->link_kontak }}" target="_blank" class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                                Hubungi via WhatsApp
                            </a>
                        @else
                            <p class="text-sm text-red-500 bg-red-50 inline-block px-4 py-2 rounded-lg">* Belum ada kontak WhatsApp yang tersedia. Hubungi <span class="font-semibold">{{ $namaPembuat }}</span> melalui admin.</p>
                        @endif

                    @elseif($tipe === 'volunteer')
                        {{-- ECO-VOLUNTEER: FORM PENDAFTARAN RELAWAN --}}
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Menjadi Relawan</h3>

                        @if(!auth()->check())
                            <p class="text-gray-600 mb-4">Anda harus login terlebih dahulu untuk mendaftar sebagai relawan.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                                Login Sekarang
                            </a>
                        @else
                            @if(session('success'))
                                <div class="mb-4 p-4 bg-green-50 text-green-700 border border-green-200 rounded-xl font-semibold">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="mb-4 p-4 bg-red-50 text-red-700 border border-red-200 rounded-xl font-semibold">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('volunteer.daftar', $item->id_kegiatan) }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Mengapa Anda ingin bergabung? *</label>
                                    <textarea name="alasan_bergabung" rows="4" required placeholder="Ceritakan motivasi Anda untuk bergabung dalam aksi ini..." class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none"></textarea>
                                </div>
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-bold transition shadow">
                                    Kirim Pendaftaran
                                </button>
                            </form>
                        @endif

                        @if($item->kuota_relawan)
                            <p class="mt-4 text-sm text-gray-500">Sisa Kuota: <span class="font-bold text-gray-800">{{ $item->kuota_relawan }} Orang</span></p>
                        @endif

                    @else
                        {{-- ECO-INFORMATION: MADING SATU ARAH --}}
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">
                            <h3 class="text-lg font-bold text-blue-800 mb-2">ℹ️ Informasi Edukasi</h3>
                            <p class="text-blue-700 text-sm">Halaman ini berisi materi edukasi satu arah. Jika ada pertanyaan lebih lanjut, silakan hubungi pembuat aksi melalui halaman katalog.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@endsection