@extends('layouts.admin')

@section('content')

{{-- Notifikasi Sukses --}}
@if(session('success'))
<div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-2 text-sm shadow-sm">
    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

{{-- Notifikasi Error --}}
@if($errors->any())
<div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl flex items-center gap-2 text-sm shadow-sm">
    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-medium">{{ $errors->first() }}</span>
</div>
@endif

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen Masyarakat</h1>
        <p class="text-sm text-gray-500 mt-1">Daftar akun masyarakat yang terdaftar melalui sistem maupun ditambahkan oleh admin.</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="text-sm font-bold text-gray-500 bg-gray-100 px-4 py-2 rounded-xl">Total: {{ $users->count() }} Akun</span>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <th class="p-4 px-6 w-10">No</th>
                    <th class="p-4 px-6">Nama Pengguna</th>
                    <th class="p-4 px-6">Email (Otomatis)</th>
                    <th class="p-4 px-6">No. HP / Password Awal</th>
                    <th class="p-4 px-6">Alamat</th>
                    <th class="p-4 px-6">Terdaftar</th>
                    <th class="p-4 px-6 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse($users as $item)
                <tr class="hover:bg-gray-50/40 transition">
                    <td class="p-4 px-6 text-gray-400 font-bold">{{ $loop->iteration }}</td>
                    <td class="p-4 px-6 font-bold text-gray-900 flex items-center gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 text-xs font-bold">
                            {{ strtoupper(substr($item->name, 0, 1)) }}
                        </div>
                        {{ $item->name }}
                    </td>
                    <td class="p-4 px-6 text-gray-500 text-xs">{{ $item->email }}</td>
                    <td class="p-4 px-6 text-gray-500">{{ $item->phone ?? '-' }}</td>
                    <td class="p-4 px-6 text-gray-500 max-w-xs truncate">{{ $item->alamat ?? '-' }}</td>
                    <td class="p-4 px-6 text-gray-500 text-xs">{{ $item->created_at->format('d M Y') }}</td>
                    <td class="p-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="triggerDelete('{{ $item->id }}', '{{ $item->name }}')" class="p-2 rounded-lg transition cursor-pointer bg-red-50 hover:bg-red-100 text-red-600" title="Hapus Akun">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-400 italic">Belum ada masyarakat yang mendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Form Hapus Tersembunyi --}}
<form id="deleteForm" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>

<script>
    function triggerDelete(id, name) {
        if(confirm('Yakin ingin menghapus akun "' + name + '"? Aksi ini tidak bisa dibatalkan.')) {
            const form = document.getElementById('deleteForm');
            form.action = '/admin/users/' + id; // Sesuaikan jika perlu
            form.submit();
        }
    }
</script>

@endsection
