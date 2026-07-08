@extends('layouts.app')

@section('content')
<!-- Header: Menggunakan gaya gradasi visual terbaru (e51adf9) -->
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
                {{ $information->user->name ?? $information->penulis ?? 'Admin' }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ isset($information->tanggal) ? \Carbon\Carbon::parse($information->tanggal)->format('d M Y') : $information->created_at->format('d M Y') }}
            </span>
        </div>
    </div>
</section>

<!-- Konten Utama: Struktur modern digabung dengan fitur interaktif milikmu -->
<section class="py-14 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Menjaga fitur interaktif modal gambar saat diklik -->
            <div class="relative cursor-pointer group" onclick="toggleModal(true)">
                <img src="{{ $information->gambar ? asset('storage/' . $information->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}" 
                     class="w-full h-96 object-cover group-hover:opacity-95 transition" 
                     alt="{{ $information->judul }}">
                <div class="absolute bottom-4 right-4 bg-black bg-opacity-60 text-white px-3 py-1 rounded-lg text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                    🔍 Klik untuk memperbesar
                </div>
            </div>

            <div class="p-8 md:p-10">
                <span class="bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-sm font-bold">Eco-Information</span>

                <div class="mt-8 border-t border-gray-100 pt-8">
                    <!-- Menyelaraskan field konten (deskripsi/konten) secara aman -->
                    <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $information->deskripsi ?? $information->konten }}</div>
                </div>

                <!-- Menjaga fitur download file dokumen pendukung -->
                @if(!empty($information->file))
                    <div class="mt-8 p-5 bg-gray-50 border border-gray-100 rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h4 class="font-bold text-gray-800">📄 File Dokumen Lampiran</h4>
                            <p class="text-sm text-gray-500">Unduh berkas pendukung resmi terkait informasi ini.</p>
                        </div>
                        <a href="{{ asset('storage/' . $information->file) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition inline-flex items-center gap-2" 
                           target="_blank">
                            📥 Download File
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Modal Pop-up Gambar -->
<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-80 flex items-center justify-center p-4" onclick="toggleModal(false)">
    <div class="relative max-w-4xl max-h-full" onclick="event.stopPropagation()">
        <button class="absolute -top-10 right-0 text-white text-3xl font-bold hover:text-gray-300" onclick="toggleModal(false)">&times;</button>
        <img src="{{ $information->gambar ? asset('storage/' . $information->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}" 
             class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
    </div>
</div>

<script>
    function toggleModal(show) {
        const modal = document.getElementById('imageModal');
        if (show) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }
</script>
@endsection