@extends('layouts.admin')

@section('content')

<div class="pb-6 mb-6 border-b border-gray-100">
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Admin</h1>
    <p class="text-sm text-gray-500 mt-1">Selamat datang kembali! Berikut adalah ringkasan perkembangan statistik aplikasi Aksi Lingkungan Anda.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Masyarakat Terdaftar</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalUser }}</h3>
            <span class="text-xs font-medium text-green-600 inline-flex items-center gap-1 mt-1">
                Aktif & Terverifikasi
            </span>
        </div>
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Kegiatan</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalKegiatan }}</h3>
            <span class="text-xs font-medium text-blue-600 inline-flex items-center gap-1 mt-1">
                Aksi Lingkungan Hidup
            </span>
        </div>
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Diskusi Forum</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalSharing }}</h3>
            <span class="text-xs font-medium text-purple-600 inline-flex items-center gap-1 mt-1">
                Topik Berbagi Cerita
            </span>
        </div>
        <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Artikel Edukasi</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalArtikel }}</h3>
            <span class="text-xs font-medium text-amber-600 inline-flex items-center gap-1 mt-1">
                Edukasi Sampah & Alam
            </span>
        </div>
        <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm lg:col-span-2 overflow-hidden">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Aksi & Kegiatan Terbaru</h3>
            <a href="{{ route('admin.kegiatan') }}" class="text-xs font-bold text-green-600 hover:underline">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-4">Nama Kegiatan</th>
                        <th class="py-3 px-4">Tanggal Dibuat</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @if(isset($kegiatanTerbaru) && $kegiatanTerbaru->count() > 0)
                        @foreach($kegiatanTerbaru as $kegiatan)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-3.5 px-4 font-semibold text-gray-900">{{ $kegiatan->title ?? $kegiatan->name }}</td>
                                <td class="py-3.5 px-4 text-gray-500 text-xs">{{ $kegiatan->created_at->diffForHumans() }}</td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">Active</span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="py-6 text-center text-sm text-gray-400 italic">Belum ada kegiatan lingkungan yang terdaftar.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Navigasi Cepat</h3>
        <div class="grid grid-cols-1 gap-3">
            <a href="{{ route('admin.users') }}" class="p-3 bg-gray-50 hover:bg-green-50 rounded-xl border border-gray-100 hover:border-green-200 text-sm font-semibold text-gray-700 hover:text-green-700 transition flex items-center justify-between">
                <span>Kelola Data Masyarakat</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('admin.kegiatan') }}" class="p-3 bg-gray-50 hover:bg-blue-50 rounded-xl border border-gray-100 hover:border-blue-200 text-sm font-semibold text-gray-700 hover:text-blue-700 transition flex items-center justify-between">
                <span>Kelola Kegiatan Alam</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

</div>

@endsection
