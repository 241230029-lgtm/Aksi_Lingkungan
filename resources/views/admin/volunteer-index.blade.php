@extends('layouts.admin')

@section('content')

@if(session('success'))
<div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-2 text-sm shadow-sm">
    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

@if($errors->any())
<div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm shadow-sm">
    <p class="font-semibold mb-1">Periksa kembali isian form:</p>
    <ul class="list-disc list-inside space-y-0.5">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
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
                    <th class="p-4 px-6">Gambar</th>
                    <th class="p-4 px-6">Nama Program Aksi</th>
                    <th class="p-4 px-6">Kategori</th>
                    <th class="p-4 px-6">Lokasi</th>
                    <th class="p-4 px-6">Tanggal</th>
                    <th class="p-4 px-6 text-center">Kuota Sedia</th>
                    <th class="p-4 px-6 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @if(isset($volunteers) && $volunteers->count() > 0)
                    @foreach($volunteers as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4 px-6 text-center text-gray-400 font-medium">{{ $volunteers->firstItem() + $index }}</td>
                            <td class="p-4 px-6">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-12 h-12 object-cover rounded-xl border border-gray-100 cursor-pointer" onclick="openImagePreview('{{ asset('storage/' . $item->gambar) }}')">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 text-xs font-bold">-</div>
                                @endif
                            </td>
                            <td class="p-4 px-6 font-bold text-gray-900 max-w-xs truncate" title="{{ $item->judul }}">{{ $item->judul }}</td>
                            <td class="p-4 px-6">
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2.5 py-0.5 rounded-md text-xs font-semibold">{{ $item->kategori }}</span>
                            </td>
                            <td class="p-4 px-6 text-gray-600">{{ $item->lokasi }}</td>
                            <td class="p-4 px-6 text-gray-600">{{ $item->tanggal_kejadian ? \Carbon\Carbon::parse($item->tanggal_kejadian)->translatedFormat('d M Y') : '-' }}</td>
                            <td class="p-4 px-6 text-center font-bold text-blue-600">{{ $item->kuota_relawan ?? 'Tanpa batas' }}</td>
                            <td class="p-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick='openEditModal(@json($item))' class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-100 transition cursor-pointer">
                                        Edit
                                    </button>
                                    <button onclick="triggerDelete('{{ $item->id_kegiatan }}')" class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-100 transition cursor-pointer">
                                        Tutup
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="p-8 text-center text-gray-400 italic">Belum ada program lowongan volunteer terdaftar di database.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if($volunteers->hasPages())
        <div class="p-4 bg-gray-50/50 border-t border-gray-100">{{ $volunteers->links() }}</div>
    @endif
</div>

{{-- MODAL PREVIEW GAMBAR --}}
<div id="imagePreviewModal" class="hidden fixed inset-0 z-[60] bg-black/80 items-center justify-center p-4" onclick="closeImagePreview()">
    <img id="imagePreviewImg" src="" class="max-w-[90%] max-h-[90%] rounded-xl">
</div>

{{-- MODAL TAMBAH --}}
<div id="modalTambahVolunteer" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative my-8">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Buka Lowongan Relawan</h3>
            <button type="button" onclick="closeModal('modalTambahVolunteer')" class="text-gray-400 hover:text-gray-600 cursor-pointer">&#10005;</button>
        </div>
        <form action="{{ route('admin.volunteer.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Nama Program Relawan</label>
                <input type="text" name="judul" required placeholder="Contoh: Bersih Pantai Berbatu" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kategori</label>
                    <input type="text" name="kategori" required placeholder="Ketik kategori sesuai kebutuhan..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Lokasi Aksi</label>
                    <input type="text" name="lokasi" required placeholder="Bandung" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kuota (Orang)</label>
                    <input type="number" name="kuota_relawan" min="1" placeholder="50" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kejadian" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Deskripsi Tugas Relawan</label>
                <textarea name="deskripsi" required rows="3" placeholder="Tulis rincian apa saja yang akan dikerjakan relawan di lapangan..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Link Kontak (opsional)</label>
                <input type="text" name="link_kontak" placeholder="https://wa.me/628123..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Foto</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">File Dokumen (PDF)</label>
                    <input type="file" name="file" accept="application/pdf" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>
            </div>
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalTambahVolunteer')" class="px-4 py-2 text-sm text-gray-500 rounded-xl hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-green-600 rounded-xl font-semibold hover:bg-green-700">Buka Pendaftaran</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modalEditVolunteer" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative my-8">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Edit Program Relawan</h3>
            <button type="button" onclick="closeModal('modalEditVolunteer')" class="text-gray-400 hover:text-gray-600 cursor-pointer">&#10005;</button>
        </div>
        <form id="editVolunteerForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Preview Gambar Saat Ini</label>
                <div class="w-full h-32 bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center overflow-hidden">
                    <img id="edit_gambar_preview" src="" class="hidden w-full h-full object-cover">
                    <span id="edit_gambar_placeholder" class="text-gray-400 text-xs font-semibold">Belum ada gambar</span>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Nama Program Relawan</label>
                <input type="text" id="edit_nama_program" name="judul" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kategori</label>
                    <input type="text" id="edit_kategori" name="kategori" required placeholder="Ketik kategori sesuai kebutuhan..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Lokasi Aksi</label>
                    <input type="text" id="edit_lokasi" name="lokasi" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kuota (Orang)</label>
                    <input type="number" id="edit_kuota" name="kuota_relawan" min="1" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Tanggal Kegiatan</label>
                <input type="date" id="edit_tanggal" name="tanggal_kejadian" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Deskripsi Tugas Relawan</label>
                <textarea id="edit_deskripsi" name="deskripsi" required rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Link Kontak (opsional)</label>
                <input type="text" id="edit_link_kontak" name="link_kontak" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Ganti Foto (opsional)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Ganti File PDF (opsional)</label>
                    <input type="file" name="file" accept="application/pdf" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
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
        document.getElementById(id).classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
        document.body.style.overflow = '';
    }
    function openEditModal(data) {
        document.getElementById('editVolunteerForm').action = `/admin/volunteer/update/${data.id_kegiatan}`;
        document.getElementById('edit_nama_program').value = data.judul || '';
        document.getElementById('edit_kategori').value = data.kategori || '';
        document.getElementById('edit_lokasi').value = data.lokasi || '';
        document.getElementById('edit_kuota').value = data.kuota_relawan || '';
        document.getElementById('edit_tanggal').value = data.tanggal_kejadian ? data.tanggal_kejadian.substring(0, 10) : '';
        document.getElementById('edit_deskripsi').value = data.deskripsi || '';
        document.getElementById('edit_link_kontak').value = data.link_kontak || '';

        const img = document.getElementById('edit_gambar_preview');
        const placeholder = document.getElementById('edit_gambar_placeholder');
        if (data.gambar) {
            img.src = '/storage/' + data.gambar;
            img.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            img.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        openModal('modalEditVolunteer');
    }
    function triggerDelete(id) {
        if (confirm('Apakah Anda yakin ingin menutup dan menghapus program lowongan relawan aksi ini?')) {
            const form = document.getElementById('deleteVolunteerSilentForm');
            form.action = `/admin/volunteer/${id}`;
            form.submit();
        }
    }
    function openImagePreview(src) {
        const modal = document.getElementById('imagePreviewModal');
        document.getElementById('imagePreviewImg').src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeImagePreview() {
        const modal = document.getElementById('imagePreviewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

@endsection