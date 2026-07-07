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
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Sharing</h1>
        <p class="text-gray-500 text-sm">Kelola forum diskusi, testimoni, dan cerita aksi lingkungan dari pengguna.</p>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.sharing') }}" method="GET" class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari topik diskusi..." class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 w-60 shadow-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </form>
        <button onclick="openModal('modalTambahSharing')" class="bg-green-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-green-700 shadow-sm transition cursor-pointer">
            + Tambah Topik
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                <tr>
                    <th class="p-4 px-6 w-16 text-center">No</th>
                    <th class="p-4 px-6">Judul Topik</th>
                    <th class="p-4 px-6">Kategori</th>
                    <th class="p-4 px-6">Oleh (Pembuat)</th>
                    <th class="p-4 px-6">Tanggal</th>
                    <th class="p-4 px-6 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @if(isset($sharings) && $sharings->count() > 0)
                    @foreach($sharings as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4 px-6 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 px-6 font-bold text-gray-900 max-w-xs truncate" title="{{ $item->judul }}">{{ $item->judul }}</td>
                            <td class="p-4 px-6">
                                <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-0.5 rounded-md text-xs font-semibold">{{ $item->kategori }}</span>
                            </td>
                            <td class="p-4 px-6 text-gray-600">{{ $item->pembuat }}</td>
                            <td class="p-4 px-6 text-xs text-gray-400">
                                {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}
                            </td>
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
                        <td colspan="6" class="p-8 text-center text-gray-400 italic">Belum ada data topik sharing/diskusi di database.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambahSharing" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative my-auto">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Tambah Topik Sharing</h3>
            <button onclick="closeModal('modalTambahSharing')" class="text-gray-400 hover:text-gray-600 cursor-pointer">✕</button>
        </div>
        <form action="{{ route('admin.sharing.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Judul Topik / Diskusi</label>
                <input type="text" name="judul" required placeholder="Contoh: Pengalaman Mengurangi Kantong Plastik..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
            </div>
            
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Hubungkan ke Kegiatan</label>
                <select name="kegiatan_id" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                    <option value="">-- Pilih Kegiatan --</option>
                    @foreach($kegiatans as $kegiatan)
                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama_kegiatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kategori</label>
                    <select name="kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                        <option value="Penghijauan">Penghijauan</option>
                        <option value="Daur Ulang">Daur Ulang</option>
                        <option value="Gaya Hidup Minim Sampah">Gaya Hidup Minim Sampah</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Pembuat</label>
                    <input type="text" name="pembuat" value="Admin" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Tanggal</label>
                <input type="date" name="tanggal" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Upload Gambar Sampul</label>
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-1.5 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm bg-gray-50">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Upload File Lampiran (PDF/Docx)</label>
                <input type="file" name="file" class="w-full px-4 py-1.5 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm bg-gray-50">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Isi Cerita / Deskripsi Diskusi</label>
                <textarea name="deskripsi" required rows="3" placeholder="Tulis rincian cerita pengalamannya di sini..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm"></textarea>
            </div>
            
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalTambahSharing')" class="px-4 py-2 text-sm text-gray-500 rounded-xl hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-green-600 rounded-xl font-semibold hover:bg-green-700">Simpan Topik</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditSharing" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative my-auto">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Edit Topik Sharing</h3>
            <button onclick="closeModal('modalEditSharing')" class="text-gray-400 hover:text-gray-600 cursor-pointer">✕</button>
        </div>
        <form id="editSharingForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Judul Topik / Diskusi</label>
                <input type="text" id="edit_judul" name="judul" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Hubungkan ke Kegiatan</label>
                <select id="edit_kegiatan_id" name="kegiatan_id" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    <option value="">-- Pilih Kegiatan --</option>
                    @foreach($kegiatans as $kegiatan)
                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama_kegiatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Kategori</label>
                    <select id="edit_kategori" name="kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                        <option value="Penghijauan">Penghijauan</option>
                        <option value="Daur Ulang">Daur Ulang</option>
                        <option value="Gaya Hidup Minim Sampah">Gaya Hidup Minim Sampah</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Pembuat</label>
                    <input type="text" id="edit_pembuat" name="pembuat" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Tanggal</label>
                <input type="date" id="edit_tanggal" name="tanggal" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Ganti Gambar Sampul</label>
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-1.5 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm bg-gray-50">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Ganti File Lampiran (PDF/Docx)</label>
                <input type="file" name="file" class="w-full px-4 py-1.5 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm bg-gray-50">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Isi Cerita / Deskripsi Diskusi</label>
                <textarea id="edit_deskripsi" name="deskripsi" required rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm"></textarea>
            </div>
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalEditSharing')" class="px-4 py-2 text-sm text-gray-500 rounded-xl hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-xl font-semibold hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<form id="deleteSharingSilentForm" method="POST" class="hidden">
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
        document.getElementById('editSharingForm').action = `/admin/sharing/update/${data.id}`;
        document.getElementById('edit_judul').value = data.judul;
        document.getElementById('edit_kategori').value = data.kategori;
        document.getElementById('edit_pembuat').value = data.pembuat;
        document.getElementById('edit_deskripsi').value = data.deskripsi;
        
        // Update JavaScript: Mengisi otomatis data kegiatan lama & tanggal lama ke form edit
        document.getElementById('edit_kegiatan_id').value = data.kegiatan_id || '';
        document.getElementById('edit_tanggal').value = data.tanggal || '';
        
        openModal('modalEditSharing');
    }
    function triggerDelete(id) {
        if(confirm('Yakin ingin menghapus topik sharing diskusi ini?')) {
            const form = document.getElementById('deleteSharingSilentForm');
            form.action = `/admin/sharing/${id}`;
            form.submit();
        }
    }
</script>

@endsection