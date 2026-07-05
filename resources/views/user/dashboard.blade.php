@extends('layouts.app')

@section('content')

<div class="px-6 py-8 md:px-12 md:py-12">

    <div class="p-8 bg-emerald-700/80 backdrop-blur-md rounded-3xl border border-emerald-600/50 shadow-2xl shadow-emerald-950/30 flex flex-col md:flex-row items-center justify-between gap-6 mb-12">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 bg-emerald-50 text-emerald-700 rounded-3xl shadow-lg shadow-emerald-950/20 flex items-center justify-center shrink-0">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-emerald-50 tracking-tight">Dashboard Relawan</h1>
                <p class="text-lg text-emerald-100 mt-1 max-w-xl">Selamat datang kembali,<span class="font-bold text-white">{{ $user->name ?? 'Relawan' }}!</span> Mari bersama-sama <span class="font-semibold text-white">#BeraksiUntukBumi</span> hari ini.</p>
            </div>
        </div>
        <a href="{{ route('buat-aksi') }}" class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white text-base font-semibold px-6 py-3 rounded-2xl shadow-lg shadow-blue-950/30 transition-all duration-200 transform hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Aksi Lingkungan
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

        <div class="bg-white/50 backdrop-blur-lg p-6 rounded-3xl border border-gray-100/50 shadow-xl shadow-gray-950/5 flex items-center justify-between group hover:border-emerald-200 hover:bg-emerald-50/50 transition-all duration-300">
            <div class="space-y-1">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider group-hover:text-emerald-500 transition">Total Aksi Diikuti</p>
                <h3 class="text-5xl font-extrabold text-gray-950 group-hover:text-emerald-700 transition">{{ $totalAksi }}</h3>
                <span class="text-xs font-medium text-emerald-600 inline-flex items-center gap-1.5 mt-1.5 bg-emerald-100 px-2 py-0.5 rounded-md">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    Aktif & Selesai
                </span>
            </div>
            <div class="w-16 h-16 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center shadow-md shadow-emerald-950/10 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 transform group-hover:rotate-12">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        </div>

        <div class="bg-white/50 backdrop-blur-lg p-6 rounded-3xl border border-gray-100/50 shadow-xl shadow-gray-950/5 flex items-center justify-between group hover:border-blue-200 hover:bg-blue-50/50 transition-all duration-300">
            <div class="space-y-1">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider group-hover:text-blue-500 transition">Volunteer Terdaftar</p>
                <h3 class="text-5xl font-extrabold text-gray-950 group-hover:text-blue-700 transition">{{ $totalRelawan }}</h3>
                <span class="text-xs font-medium text-blue-600 inline-flex items-center gap-1.5 mt-1.5 bg-blue-100 px-2 py-0.5 rounded-md">
                    Relawan Bumi Terdaftar
                </span>
            </div>
            <div class="w-16 h-16 bg-blue-100 text-blue-700 rounded-2xl flex items-center justify-center shadow-md shadow-blue-950/10 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 transform group-hover:-rotate-12">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>

        <div class="bg-white/50 backdrop-blur-lg p-6 rounded-3xl border border-gray-100/50 shadow-xl shadow-gray-950/5 flex items-center justify-between group hover:border-amber-200 hover:bg-amber-50/50 transition-all duration-300">
            <div class="space-y-1">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider group-hover:text-amber-500 transition">Artikel Edukasi</p>
                <h3 class="text-5xl font-extrabold text-gray-950 group-hover:text-amber-700 transition">{{ $totalEdukasi }}</h3>
                <span class="text-xs font-medium text-amber-600 inline-flex items-center gap-1.5 mt-1.5 bg-amber-100 px-2 py-0.5 rounded-md">
                    Sampah, Iklim, Hidup Minim Sampah
                </span>
            </div>
            <div class="w-16 h-16 bg-amber-100 text-amber-700 rounded-2xl flex items-center justify-center shadow-md shadow-amber-950/10 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300 transform group-hover:scale-110">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        </div>

        <div class="bg-white/50 backdrop-blur-lg p-6 rounded-3xl border border-gray-100/50 shadow-xl shadow-gray-950/5 flex items-center justify-between group hover:border-purple-200 hover:bg-purple-50/50 transition-all duration-300">
            <div class="space-y-1">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider group-hover:text-purple-500 transition">Diskusi Forum</p>
                <h3 class="text-5xl font-extrabold text-gray-900 group-hover:text-purple-700 transition">{{ $totalSharing }}</h3>
                <span class="text-xs font-medium text-purple-600 inline-flex items-center gap-1.5 mt-1.5 bg-purple-100 px-2 py-0.5 rounded-md">
                    Topik Berbagi Cerita
                </span>
            </div>
            <div class="w-16 h-16 bg-purple-100 text-purple-700 rounded-2xl flex items-center justify-center shadow-md shadow-purple-950/10 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300 transform group-hover:translate-x-1">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="bg-white/70 backdrop-blur-xl p-8 rounded-3xl border border-gray-100/50 shadow-2xl shadow-gray-950/5 lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-950">Aksi Lingkungan Terbaru</h3>
                <a href="{{ route('katalog') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1.5 group">
                    Katalog Lengkap
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-100/50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100/50">
                            <th class="py-4 px-6 w-16 text-center">No</th>
                            <th class="py-4 px-6">Nama Aksi</th>
                            <th class="py-4 px-6">Lokasi</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/50 text-sm text-gray-700">
                        @if(isset($aktivitasTerbaru) && $aktivitasTerbaru->count() > 0)
                            @foreach($aktivitasTerbaru as $index => $kegiatan)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                                    <td class="py-4 px-6 font-semibold text-gray-950 max-w-sm truncate">{{ $kegiatan->judul }}</td>
                                    <td class="py-4 px-6 text-gray-500">{{ $kegiatan->lokasi }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">Aktif</span>
                                    </td>
                                    <td class="py-4 px-6 text-center text-gray-400 text-xs">{{ $kegiatan->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        @else
                            @for($i=1;$i<=6;$i++)
                            <tr class="border-b border-gray-100/50 hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 text-center text-gray-400 font-medium">{{ $i }}</td>
                                <td class="py-4 px-6 font-semibold text-gray-950 max-w-sm truncate">Simulasi: Aksi Tanam Pohon Di {{ $i }}</td>
                                <td class="py-4 px-6 text-gray-500">Pontianak Timur</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">Simulasi</span>
                                </td>
                                <td class="py-4 px-6 text-center text-gray-400 text-xs">10 Juni 2026</td>
                            </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white/70 backdrop-blur-xl p-8 rounded-3xl border border-gray-100/50 shadow-2xl shadow-gray-950/5 h-fit">
            <h3 class="text-xl font-bold text-gray-950 mb-6">Info & Pengumuman</h3>
            <div class="space-y-5">
                <div class="flex items-start gap-4 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-700 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M18 13a3 3 0 000-6v6zm-3-6a3 3 0 013 3v1a3 3 0 01-3 3v-7z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Aksi Tanam Pohon Sukses!</p>
                        <p class="text-sm text-gray-600 mt-0.5">Terima kasih kepada 50 relawan yang telah berpartisipasi di Pontianak Timur.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-blue-50 text-blue-700 rounded-2xl border border-blue-100">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-700 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Artikel Edukasi Terbaru</p>
                        <p class="text-sm text-gray-600 mt-0.5">Pelajari 10 tips mudah mengurangi sampah plastik di rumah. Baca sekarang!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
