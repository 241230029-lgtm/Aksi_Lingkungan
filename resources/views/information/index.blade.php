@extends('layouts.app')
@section('content')

<section class="bg-gradient-to-br from-green-600 to-green-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Mading Informasi</h1>
        <p class="mt-4 text-lg text-green-100 max-w-xl">Edukasi dan informasi seputar lingkungan hidup.</p>
    </div>
</section>

<section class="py-14 bg-gray-50">
<div class="max-w-7xl mx-auto px-6">

@if($informations->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-14 text-center">
        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6M9 17h6M9 9h1"/></svg>
        <p class="text-gray-500">Belum ada informasi yang tersedia saat ini.</p>
    </div>
@else
<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-7">
    @foreach($informations as $info)
    <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
        <div class="relative overflow-hidden">
            <img src="{{ $info->gambar ? asset('storage/' . $info->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900' }}" class="h-52 w-full object-cover group-hover:scale-105 transition duration-500">
            <span class="absolute top-3 left-3 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Eco-Information</span>
        </div>
        <div class="p-6 flex flex-col flex-1">
            <h2 class="text-xl font-bold text-gray-900 leading-snug">{{ $info->judul }}</h2>
            <p class="text-gray-500 text-sm mt-2 flex-1">{{ Str::limit($info->deskripsi, 90) }}</p>
            <div class="border-t border-gray-100 mt-4 pt-4">
                <div class="flex justify-between items-end">
                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $info->user->name ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-gray-400 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $info->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <a href="{{ route('information.show', $info->id_kegiatan) }}" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition text-sm font-semibold shrink-0">Baca</a>
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