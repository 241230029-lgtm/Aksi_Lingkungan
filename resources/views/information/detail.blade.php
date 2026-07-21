@extends('layouts.app')
@section('content')

<section class="bg-gradient-to-br from-emerald-700 to-slate-900 text-white py-10 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <a href="{{ route('information.index') }}" class="inline-flex items-center gap-2 mb-6 text-sm font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-sm px-4 py-2 rounded-full transition">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Mading
        </a>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold">{{ $information->judul }}</h1>
        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-4 text-sm text-emerald-100">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                {{ $information->user->name ?? $information->penulis ?? 'Admin' }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ isset($information->tanggal) ? \Carbon\Carbon::parse($information->tanggal)->format('d M Y') : $information->created_at->format('d M Y') }}
            </span>
        </div>
    </div>
</section>

<section class="py-10 sm:py-14 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

            <div class="relative cursor-pointer group" onclick="toggleModal(true)">
                <img src="{{ $information->gambar ? asset('storage/' . $information->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}"
                     class="w-full h-56 sm:h-72 md:h-96 object-cover group-hover:opacity-95 transition"
                     alt="{{ $information->judul }}">
                <div class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4 bg-slate-900/70 text-white px-3 py-1.5 rounded-lg text-xs opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
                    Klik untuk memperbesar
                </div>
            </div>

            <div class="p-5 sm:p-8 md:p-10">
                <span class="bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-sm font-bold">Eco-Information</span>

                <div class="mt-8 border-t border-slate-100 pt-8">
                    <div class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $information->deskripsi ?? $information->konten }}</div>
                </div>

                @if(!empty($information->file))
                    <div class="mt-8 p-4 sm:p-5 bg-slate-50 border border-slate-100 rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">File Dokumen Lampiran</h4>
                                <p class="text-sm text-slate-500">Unduh berkas pendukung resmi terkait informasi ini.</p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $information->file) }}"
                           class="w-full sm:w-auto justify-center bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition inline-flex items-center gap-2"
                           target="_blank">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                            Download File
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<div id="imageModal" class="fixed inset-0 z-50 hidden bg-slate-950/85 flex items-center justify-center p-4" onclick="toggleModal(false)">
    <div class="relative max-w-4xl max-h-full" onclick="event.stopPropagation()">
        <button class="absolute -top-10 right-0 text-white text-3xl font-bold hover:text-slate-300" onclick="toggleModal(false)">&times;</button>
        <img src="{{ $information->gambar ? asset('storage/' . $information->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200' }}"
             class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
    </div>
</div>

@push('scripts')
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
@endpush
@endsection