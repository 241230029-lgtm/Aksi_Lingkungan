@extends('layouts.app')

@section('content')

<section class="bg-green-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('information.index') }}" class="text-green-100 hover:text-white text-sm">&larr; Kembali ke Mading</a>
        <h1 class="text-4xl font-bold mt-4">{{ $information->judul }}</h1>
        <p class="mt-3 text-green-100">
            ✍️ {{ $information->penulis }} &nbsp;|&nbsp; 
            📅 {{ isset($information->tanggal) ? \Carbon\Carbon::parse($information->tanggal)->format('d M Y') : $information->created_at->format('d M Y') }}
        </p>
    </div>
</section>

<section class="py-16 bg-gray-100">
<div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="relative cursor-pointer group" onclick="toggleModal(true)">
            <img src="{{ $information->gambar ? asset('storage/' . $information->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}" 
                 class="w-full h-96 object-cover group-hover:opacity-90 transition-opacity" 
                 alt="{{ $information->judul }}">
            <div class="absolute bottom-4 right-4 bg-black bg-opacity-60 text-white px-3 py-1 rounded-lg text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                🔍 Klik untuk memperbesar
            </div>
        </div>

        <div class="p-8">
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">{{ $information->kategori }}</span>
            <div class="text-gray-700 mt-6 leading-relaxed whitespace-pre-line">{{ $information->konten }}</div>

            @if(!empty($information->file))
                <div class="mt-8 p-5 bg-gray-50 border border-gray-200 rounded-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h4 class="font-bold text-gray-800">📄 File Dokumen Lampiran</h4>
                        <p class="text-sm text-gray-500">Unduh berkas pendukung resmi terkait informasi ini.</p>
                    </div>
                    <a href="{{ asset('storage/' . $information->file) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow transition-colors inline-flex items-center gap-2" 
                       target="_blank">
                        📥 Download File
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
</section>

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
            document.body.style.overflow = 'hidden'; // Kunci scroll layar utama
        } else {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Lepas scroll layar utama
        }
    }
</script>

@endsection