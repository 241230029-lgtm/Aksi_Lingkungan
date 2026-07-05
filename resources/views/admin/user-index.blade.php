@extends('layouts.admin')

@section('content')

<div class="pb-6 mb-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen User</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola, pantau, dan verifikasi seluruh hak akses pengguna aplikasi Aksi Lingkungan.</p>
    </div>
    <div>
        <button class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah User Baru
        </button>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pengguna</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ count($users ?? []) ?: 10 }}</h3>
        </div>
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">User Aktif</p>
            <h3 class="text-3xl font-extrabold text-emerald-600 mt-1">{{ count($users ?? []) ?: 10 }}</h3>
        </div>
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Sesi Hari Ini</p>
            <h3 class="text-3xl font-extrabold text-blue-600 mt-1">1</h3>
        </div>
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
    </div>
</div>

<div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
    <div class="w-full md:w-80 relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </span>
        <input type="text" placeholder="Cari nama atau email user..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 focus:border-green-500 focus:bg-white text-sm rounded-xl focus:outline-none transition duration-150">
    </div>
    <div class="flex items-center gap-2 text-xs font-medium text-gray-400 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
        <span>Menampilkan seluruh pengguna dengan Role: Masyarakat</span>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/70 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3.5 px-6 w-16 text-center">No</th>
                    <th class="py-3.5 px-6">Identitas Pengguna</th>
                    <th class="py-3.5 px-6">Email</th>
                    <th class="py-3.5 px-6">Role</th>
                    <th class="py-3.5 px-6 text-center">Status</th>
                    <th class="py-3.5 px-6 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @php $nomorNyata = 1; @endphp

                @if(isset($users) && count($users) > 0)
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <td class="py-4 px-6 text-center font-medium text-gray-400">{{ $nomorNyata++ }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center font-bold text-gray-600 uppercase text-xs">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span class="font-bold text-gray-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-medium text-gray-500">{{ $user->email }}</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                    Masyarakat
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span> Aktif
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit User" class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button title="Hapus User" class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg flex items-center justify-center transition duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

                {{-- DUMMY DATA FALLBACK: Otomatis memicu data tiruan ini jika di database belum ada user masyarakat --}}
                @if($nomorNyata == 1)
                    @for ($i = 1; $i <= 8; $i++)
                    <tr class="hover:bg-gray-50/50 transition duration-150">
                        <td class="py-4 px-6 text-center font-medium text-gray-400">{{ $i }}</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-green-50 text-green-700 rounded-full flex items-center justify-center font-bold text-xs">
                                    BS
                                </div>
                                <span class="font-bold text-gray-900">Budi Santoso</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-500">budi{{ $i }}@email.com</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                Masyarakat
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span> Aktif
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg flex items-center justify-center transition duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
