@extends('layouts.admin')

@section('content')

@if(session('success'))
<div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-2 text-sm shadow-sm">
    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Lowongan Relawan</h1>
        <p class="text-gray-500 text-sm">Buka pendaftaran program aksi lingkungan dan batasi kuota relawan masyarakat.</p>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.volunteer') }}" method="GET" class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama program..." class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 w-60 shadow-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </form>
        <button onclick="openModal('modalTambahVolunteer')" class="bg-green-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-green-700 shadow-sm transition cursor-pointer">
            + Buka Lowongan
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                <tr>
                    <th class="p-4 px-6 w-16 text-center">No</th>
                    <th class="p-4 px-6">Nama Program Aksi</th>
                    <th class="p-4 px-6">Kategori</th>
                    <th class="p-4 px-6">Lokasi</th>
                    <th class="p-4 px-6 text-center">Kuota Sedia</th>
                    <th class="p-4 px-6 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @if(isset($volunteers) && $volunteers->count() > 0)
                    @foreach($volunteers as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4 px-6 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 px-6 font-bold text-gray-900 max-w-xs truncate" title="{{ $item->judul }}">{{ $item->judul }}</td>
                            <td class="p-4 px-6">
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2.5 py-0.5 rounded-md text-xs font-semibold">{{ $item->kategori }}</span>
                            </td>
                            <td class="p-4 px-6 text-gray-600">{{ $item->lokasi }}</td>
                            <td class="p-4 px-6 text-center font-bold text-blue-600">{{ $item->kuota_relawan ?? '∞' }} Orang</td>
                            <td class="p-4 px-6 text-center flex items-center justify-center gap-2 mt-1">
                                <button onclick="openEditModal({{ json_encode($item) }})" class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-100 transition cursor-pointer">
                                    Edit
                                </button>
                                <button onclick="triggerDelete('{{ $item->id }}')" class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-100 transition cursor-pointer">
                                    Tutup
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400 italic">Belum ada program lowongan volunteer terdaftar di database.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambahVolunteer" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Buka Lowongan Relawan</h3>
            <button onclick="closeModal('modalTambahVolunteer')" class="text-gray-400 hover:text-gray-600 cursor-pointer">✕</button>
        </div>
        <form action="{{ route('admin.volunteer.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Nama Program Relawan</label>
                <input type="text" name="judul" required placeholder="Contoh: Bersih Pantai Berbatu" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kategori</label>
                    <select name="kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                        <option value="Eco-Volunteer">Eco-Volunteer</option>
                        <option value="Eco-Information">Eco-Information</option>
                        <option value="Eco-Sharing">Eco-Sharing</option>
                    </select>
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Lokasi Aksi</label>
                    <input type="text" name="lokasi" required placeholder="Bandung" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kuota (Orang)</label>
                    <input type="number" name="kuota_relawan" min="1" required placeholder="50" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Deskripsi Tugas Relawan</label>
                <textarea name="deskripsi" required rows="3" placeholder="Tulis rincian apa saja yang akan dikerjakan relawan di lapangan..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Link Kontak (opsional)</label>
                <input type="text" name="link_kontak" placeholder="https://wa.me/628123..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
            </div>
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalTambahVolunteer')" class="px-4 py-2 text-sm text-gray-500 rounded-xl hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-green-600 rounded-xl font-semibold hover:bg-green-700">Buka Pendaftaran</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditVolunteer" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Edit Program Relawan</h3>
            <button onclick="closeModal('modalEditVolunteer')" class="text-gray-400 hover:text-gray-600 cursor-pointer">✕</button>
        </div>
        <form id="editVolunteerForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Nama Program Relawan</label>
                <input type="text" id="edit_nama_program" name="judul" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kategori</label>
                    <select id="edit_kategori" name="kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                        <option value="Eco-Volunteer">Volunteer</option>
                        <option value="Eco-Information">Edukasi</option>
                        <option value="Eco-Sharing">Penghijauan</option>
                    </select>
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Lokasi Aksi</label>
                    <input type="text" id="edit_lokasi" name="lokasi" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kuota (Orang)</label>
                    <input type="number" id="edit_kuota" name="kuota_relawan" min="1" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Deskripsi Tugas Relawan</label>
                <textarea id="edit_deskripsi" name="deskripsi" required rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Link Kontak (opsional)</label>
                <input type="text" id="edit_link_kontak" name="link_kontak" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
            </div>
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalEditVolunteer')" class="px-4 py-2 text-sm text-gray-500 rounded-xl hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-xl font-semibold hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<form id="deleteVolunteerSilentForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = '';
    }
    function openEditModal(data) {
        document.getElementById('editVolunteerForm').action = `/admin/volunteer/update/${data.id_kegiatan}`;
        document.getElementById('edit_nama_program').value = data.judul;
        document.getElementById('edit_kategori').value = data.kategori;
        document.getElementById('edit_lokasi').value = data.lokasi;
        document.getElementById('edit_kuota').value = data.kuota_relawan || '';
        document.getElementById('edit_deskripsi').value = data.deskripsi;
        document.getElementById('edit_link_kontak').value = data.link_kontak || '';
        openModal('modalEditVolunteer');
    }
    function triggerDelete(id) {
        if(confirm('Apakah Anda yakin ingin menutup dan menghapus program lowongan relawan aksi ini?')) {
            const form = document.getElementById('deleteVolunteerSilentForm');
            form.action = `/admin/volunteer/${id}`;
            form.submit();
        }
    }
</script>

@endsection
