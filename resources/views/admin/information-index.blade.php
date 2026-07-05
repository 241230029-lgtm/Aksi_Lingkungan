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
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Informasi</h1>
        <p class="text-gray-500 text-sm">Kelola artikel dan konten edukasi lingkungan hidup.</p>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.information') }}" method="GET" class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel..." class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 w-60 shadow-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </form>
        <button onclick="openModal('modalTambahInfo')" class="bg-green-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-green-700 shadow-sm transition cursor-pointer">
            + Tambah Artikel
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                <tr>
                    <th class="p-4 px-6 w-16 text-center">No</th>
                    <th class="p-4 px-6">Sampul</th>
                    <th class="p-4 px-6">Judul</th>
                    <th class="p-4 px-6">Kategori</th>
                    <th class="p-4 px-6">Penulis</th>
                    <th class="p-4 px-6">Tanggal Rilis</th>
                    <th class="p-4 px-6 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @if(isset($informations) && $informations->count() > 0)
                    @foreach($informations as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4 px-6 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 px-6">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-12 h-12 object-cover rounded-xl border border-gray-100">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 text-xs font-bold">No Cover</div>
                                @endif
                            </td>
                            <td class="p-4 px-6 font-bold text-gray-900 max-w-xs truncate" title="{{ $item->judul }}">{{ $item->judul }}</td>
                            <td class="p-4 px-6">
                                <span class="bg-green-50 text-green-700 border border-green-100 px-2.5 py-0.5 rounded-md text-xs font-semibold">{{ $item->kategori }}</span>
                            </td>
                            <td class="p-4 px-6 text-gray-600">{{ $item->penulis }}</td>
                            <td class="p-4 px-6 text-xs text-gray-400">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                            <td class="p-4 px-6 text-center flex items-center justify-center gap-2 mt-2">
                                <button onclick="openEditModal({{ json_encode($item) }})" class="bg-blue-50 text-blue-600 p-2 rounded-lg hover:bg-blue-100 transition cursor-pointer">
                                    Edit
                                </button>
                                <button onclick="triggerDelete('{{ $item->id }}')" class="bg-red-50 text-red-600 p-2 rounded-lg hover:bg-red-100 transition cursor-pointer">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-400 italic">Belum ada data artikel informasi di database.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambahInfo" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Tambah Artikel</h3>
            <button onclick="closeModal('modalTambahInfo')" class="text-gray-400 hover:text-gray-600 cursor-pointer">✕</button>
        </div>
        <form action="{{ route('admin.information.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Judul Artikel</label>
                <input type="text" name="judul" required placeholder="Masukkan judul edukasi..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kategori</label>
                    <select name="kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                        <option value="Edukasi">Edukasi</option>
                        <option value="Berita">Berita</option>
                        <option value="Tips Lingkungan">Tips Lingkungan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Penulis</label>
                    <input type="text" name="penulis" value="Admin" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Isi Konten Informasi</label>
                <textarea name="konten" required rows="4" placeholder="Tulis isi pembahasan lengkap di sini..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Gambar Sampul</label>
                <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700">
            </div>
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalTambahInfo')" class="px-4 py-2 text-sm text-gray-500 rounded-xl hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-green-600 rounded-xl font-semibold hover:bg-green-700">Terbitkan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditInfo" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Edit Artikel</h3>
            <button onclick="closeModal('modalEditInfo')" class="text-gray-400 hover:text-gray-600 cursor-pointer">✕</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Judul Artikel</label>
                <input type="text" id="edit_judul" name="judul" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kategori</label>
                    <select id="edit_kategori" name="kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                        <option value="Edukasi">Edukasi</option>
                        <option value="Berita">Berita</option>
                        <option value="Tips Lingkungan">Tips Lingkungan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Penulis</label>
                    <input type="text" id="edit_penulis" name="penulis" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Isi Konten Informasi</label>
                <textarea id="edit_konten" name="konten" required rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Ganti Gambar Sampul (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
            </div>
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalEditInfo')" class="px-4 py-2 text-sm text-gray-500 rounded-xl hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-xl font-semibold hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<form id="deleteSilentForm" method="POST" class="hidden">
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
        document.getElementById('editForm').action = `/admin/information/update/${data.id}`;
        document.getElementById('edit_judul').value = data.judul;
        document.getElementById('edit_kategori').value = data.kategori;
        document.getElementById('edit_penulis').value = data.penulis;
        document.getElementById('edit_konten').value = data.konten;
        openModal('modalEditInfo');
    }
    function triggerDelete(id) {
        if(confirm('Yakin ingin menghapus artikel edukasi ini?')) {
            const form = document.getElementById('deleteSilentForm');
            form.action = `/admin/information/${id}`;
            form.submit();
        }
    }
</script>

@endsection
