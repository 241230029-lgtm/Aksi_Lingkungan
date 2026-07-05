@extends('layouts.admin')

@section('content')

<div class="pb-6 mb-6 border-b border-gray-100">
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Admin</h1>
    <p class="text-sm text-gray-500 mt-1">Selamat datang kembali! Berikut adalah ringkasan performa platform Aksi Lingkungan Anda hari ini.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total User</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalUser }}</h3>
        </div>
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
            <svg class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Relawan Aktif</p>
            <h3 class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $totalVolunteer }}</h3>
        </div>
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
            <svg class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Artikel</p>
            <h3 class="text-3xl font-extrabold text-blue-600 mt-1">{{ $totalArtikel }}</h3>
        </div>
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1M19 20a2 2 0 002-2V8a2 2 0 00-2-2h-2m2 14h-2m-4 0H5a2 2 0 01-2-2v-2m14 0h4m-4 0v4m-4-12h3m-3 4h3m-6 0h1"/></svg>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Berkas Sharing</p>
            <h3 class="text-3xl font-extrabold text-amber-600 mt-1">{{ $totalSharing }}</h3>
        </div>
        <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600">
            <svg class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 10.742a3 3 0 110 2.516m6.532-4.258a3 3 0 11-2.414 4.938m2.414-4.938a3 3 0 01-2.414-4.938m2.414 4.938l-4.132 2.066m4.132-2.066l-4.132-2.066"/></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col justify-between">
        <div>
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900">Aktivitas Kegiatan Terbaru</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50/70 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                            <th class="py-3 px-6">Nama Agenda / Aksi</th>
                            <th class="py-3 px-6">Status</th>
                            <th class="py-3 px-6 text-right">Tanggal Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse($aktivitasTerbaru as $kegiatan)
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <td class="py-3.5 px-6 font-semibold text-gray-900">{{ $kegiatan->judul }}</td>
                            <td class="py-3.5 px-6">
                                @if($kegiatan->status == 'aktif')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-6 text-right text-gray-400 text-xs font-medium">
                                {{ $kegiatan->tanggal_kejadian ? \Carbon\Carbon::parse($kegiatan->tanggal_kejadian)->translatedFormat('d M Y') : 'Belum diatur' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-12 text-center text-gray-400 text-sm font-medium">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <span>Belum ada aktivitas kegiatan terbaru.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-4 bg-gray-50/50 border-t border-gray-100 text-center">
            <a href="{{ route('admin.kegiatan') }}" class="text-xs font-bold text-green-600 hover:text-green-700 transition">Lihat Seluruh Kegiatan &rarr;</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-bold text-gray-900 pb-4 border-b border-gray-100 mb-4">Ringkasan Sistem</h2>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-green-50 rounded-lg flex items-center justify-center text-green-600">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">User Terdaftar</span>
                    </div>
                    <span class="text-xs font-bold text-gray-900 bg-gray-100 px-2.5 py-1 rounded-md">{{ $totalUser }} User</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Total Kegiatan</span>
                    </div>
                    <span class="text-xs font-bold text-gray-900 bg-gray-100 px-2.5 py-1 rounded-md">{{ $totalKegiatan }} Agenda</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Kategori Volunteer</span>
                    </div>
                    <span class="text-xs font-bold text-gray-900 bg-gray-100 px-2.5 py-1 rounded-md">{{ $totalVolunteer }} Data</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Artikel Edukasi</span>
                    </div>
                    <span class="text-xs font-bold text-gray-900 bg-gray-100 px-2.5 py-1 rounded-md">{{ $totalArtikel }} Berita</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 10.742a3 3 0 110 2.516m6.532-4.258a3 3 0 11-2.414 4.938m2.414-4.938a3 3 0 01-2.414-4.938m2.414 4.938l-4.132 2.066m4.132-2.066l-4.132-2.066"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Berkas Sharing</span>
                    </div>
                    <span class="text-xs font-bold text-gray-900 bg-gray-100 px-2.5 py-1 rounded-md">{{ $totalSharing }} File</span>
                </div>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-center text-gray-400 font-medium">
            Sistem diperbarui otomatis secara real-time
        </div>
    </div>

</div>

@endsection
