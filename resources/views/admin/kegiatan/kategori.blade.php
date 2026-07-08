@extends('layouts.admin')

@section('content')

@php
    $tema = match($kategori) {
        'Eco-Volunteer' => ['badge' => 'bg-amber-50 text-amber-700 border-amber-100', 'btn' => 'bg-amber-600 hover:bg-amber-700', 'ring' => 'focus:border-amber-500', 'icon' => 'text-amber-600 bg-amber-50'],
        'Eco-Sharing' => ['badge' => 'bg-purple-50 text-purple-700 border-purple-100', 'btn' => 'bg-purple-600 hover:bg-purple-700', 'ring' => 'focus:border-purple-500', 'icon' => 'text-purple-600 bg-purple-50'],
        default => ['badge' => 'bg-blue-50 text-blue-700 border-blue-100', 'btn' => 'bg-blue-600 hover:bg-blue-700', 'ring' => 'focus:border-blue-500', 'icon' => 'text-blue-600 bg-blue-50'],
    };
@endphp

@if ($errors->any())
<div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm shadow-sm">
    <p class="font-bold mb-1">Data gagal disimpan, periksa kembali:</p>
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-2 text-sm shadow-sm">
    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen {{ $kategori }}</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola data {{ strtolower($kategori) }} yang masuk ke Katalog pengguna.</p>
    </div>
    <div class="flex items-center gap-3">
        <form method="GET" class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..." class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none {{ $tema['ring'] }} w-56 shadow-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </form>
        <button onclick="openModal()" class="{{ $tema['btn'] }} text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition shadow-sm cursor-pointer whitespace-nowrap">+ Tambah {{ $kategori }}</button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <th class="p-4 px-6">Judul</th>
                    <th class="p-4 px-6">Lokasi</th>
                    <th class="p-4 px-6">Status</th>
                    <th class="p-4 px-6 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse($items as $item)
                <tr class="hover:bg-gray-50/60 transition">
                    <td class="p-4 px-6 font-bold text-gray-900">{{ $item->judul }}</td>
                    <td class="p-4 px-6 text-gray-500 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $item->lokasi }}
                    </td>
                    <td class="p-4 px-6">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $item->status == 'Aktif' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-gray-100 text-gray-600 border-gray-200' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="p-4 px-6 text-center flex items-center justify-center gap-2">
                        <button onclick="openModalEdit({{ $item->id_kegiatan }})" class="p-2 rounded-lg transition cursor-pointer bg-amber-50 hover:bg-amber-100 text-amber-700" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 20H8v-3L19.586 4.353z"/></svg>
                        </button>
                        <button onclick="triggerDelete({{ $item->id_kegiatan }})" class="p-2 rounded-lg transition cursor-pointer bg-red-50 hover:bg-red-100 text-red-600" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-14 text-center text-gray-400">
                        <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-6 4h6m2 4H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p class="italic">Belum ada data.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
        <div class="p-4 bg-gray-50/50 border-t border-gray-100">{{ $items->links() }}</div>
    @endif
</div>

{{-- MODAL TAMBAH & EDIT --}}
<div id="modal" class="hidden fixed inset-0 z-50 items-center justify-center p-4 bg-black/50 backdrop-blur-sm overflow-y-auto">
    <div class="bg-white rounded-2xl max-w-lg w-full p-7 shadow-2xl relative m-auto">
        <button onclick="closeModal()" class="absolute top-4 right-5 text-gray-400 hover:text-gray-600 cursor-pointer transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h3 id="modalTitle" class="text-lg font-bold text-gray-900 mb-6 pb-3 border-b border-gray-100"></h3>

        <form id="mainForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="kategori" value="{{ $kategori }}">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Judul</label>
                    <input type="text" name="judul" id="f_judul" required class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none {{ $tema['ring'] }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Lokasi</label>
                    <input type="text" name="lokasi" id="f_lokasi" required class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none {{ $tema['ring'] }}">
                </div>
            </div>

            <div id="fieldVolunteer" class="hidden grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Tanggal</label>
                    <input type="date" name="tanggal_kejadian" id="f_tanggal" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none {{ $tema['ring'] }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kuota Relawan</label>
                    <input type="number" name="kuota_relawan" id="f_kuota" min="1" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none {{ $tema['ring'] }}">
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Link WhatsApp Panitia</label>
                    <input type="text" name="link_kontak_v" id="f_link_v" placeholder="https://wa.me/..." class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none {{ $tema['ring'] }}">
                </div>
            </div>

            <div id="fieldSharing" class="hidden">
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Link WhatsApp</label>
                <input type="text" name="link_kontak" id="f_link" placeholder="https://wa.me/..." class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none {{ $tema['ring'] }}">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="f_deskripsi" required rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none {{ $tema['ring'] }}"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Gambar</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold {{ $tema['icon'] }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Status</label>
                    <select name="status" id="f_status" required class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none {{ $tema['ring'] }}">
                        <option value="Aktif">Aktif</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2 border-t border-gray-100 pt-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50 rounded-xl cursor-pointer">Batal</button>
                <button type="submit" id="submitBtn" class="px-5 py-2 text-sm font-semibold text-white {{ $tema['btn'] }} rounded-xl cursor-pointer transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<form id="deleteForm" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>

<script>
const form = document.getElementById('mainForm');
const modal = document.getElementById('modal');
const kategori = "{{ $kategori }}";

document.getElementById('fieldVolunteer').classList.toggle('grid', kategori === 'Eco-Volunteer');
document.getElementById('fieldVolunteer').classList.toggle('hidden', kategori !== 'Eco-Volunteer');
document.getElementById('fieldSharing').classList.toggle('hidden', kategori !== 'Eco-Sharing');

function openModal() {
    document.getElementById('modalTitle').textContent = 'Tambah ' + kategori;
    document.getElementById('submitBtn').textContent = 'Simpan ' + kategori;
    form.action = window.location.pathname + '/store';
    form.querySelector('input[name="_method"]').value = 'POST';
    form.reset();
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

form.addEventListener('submit', function() {
    if (kategori === 'Eco-Volunteer') {
        document.getElementById('f_link_v').name = 'link_kontak';
    }
});

function openModalEdit(id) {
    document.getElementById('modalTitle').textContent = 'Edit ' + kategori;
    document.getElementById('submitBtn').textContent = 'Simpan Perubahan';
    form.action = '/admin/kegiatan/update/' + id;
    form.querySelector('input[name="_method"]').value = 'PUT';

    fetch('/admin/kegiatan/' + id + '/edit')
        .then(r => r.json())
        .then(data => {
            document.getElementById('f_judul').value = data.judul || '';
            document.getElementById('f_lokasi').value = data.lokasi || '';
            document.getElementById('f_deskripsi').value = data.deskripsi || '';
            document.getElementById('f_status').value = data.status || '';
            if(kategori === 'Eco-Volunteer') {
                document.getElementById('f_tanggal').value = data.tanggal_kejadian || '';
                document.getElementById('f_kuota').value = data.kuota_relawan || '';
                document.getElementById('f_link_v').value = data.link_kontak || '';
            }
            if(kategori === 'Eco-Sharing') {
                document.getElementById('f_link').value = data.link_kontak || '';
            }
        });

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

function triggerDelete(id) {
    if(confirm('Hapus data ini?')) {
        const f = document.getElementById('deleteForm');
        f.action = window.location.pathname + '/' + id;
        f.submit();
    }
}

window.addEventListener('click', function(e) { if (e.target === modal) closeModal(); });
</script>

@endsection