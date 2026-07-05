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
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen Kegiatan</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola data program sharing, informasi edukasi, dan pendaftaran volunteer.</p>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.kegiatan') }}" method="GET" class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul kegiatan..." class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 w-60 shadow-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </form>

        <button onclick="openModal('modalTambahKegiatan')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition shadow-sm cursor-pointer">
            Tambah Kegiatan
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <th class="p-4 px-6">Gambar</th>
                    <th class="p-4 px-6">Judul</th>
                    <th class="p-4 px-6">Kategori</th>
                    <th class="p-4 px-6">Lokasi</th>
                    <th class="p-4 px-6">Status</th>
                    <th class="p-4 px-6 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @if(isset($kegiatan) && $kegiatan->count() > 0)
                    @foreach($kegiatan as $item)
                        <tr class="hover:bg-gray-50/40 transition">
                            <td class="p-4 px-6">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-12 h-12 object-cover rounded-xl border border-gray-100">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 text-xs font-bold">No Img</div>
                                @endif
                            </td>
                            <td class="p-4 px-6 font-bold text-gray-900 max-w-xs truncate" title="{{ $item->judul }}">{{ $item->judul }}</td>
                            <td class="p-4 px-6">
                                <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">{{ $item->kategori }}</span>
                            </td>
                            <td class="p-4 px-6 text-gray-500">{{ $item->lokasi }}</td>
                            <td class="p-4 px-6">
                                @if($item->status == 'aktif')
                                    <span class="bg-green-50 text-green-700 border border-green-100 px-3 py-1 rounded-full text-xs font-bold">Aktif</span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                                @endif
                            </td>
                            <td class="p-4 px-6 text-center flex items-center justify-center gap-2 mt-2">
                                <button onclick="openEditModal({{ json_encode($item) }})" class="bg-amber-50 hover:bg-amber-100 text-amber-700 p-2 rounded-lg transition cursor-pointer" title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 20H8v-3L19.586 4.353z"/></svg>
                                </button>
                                <button onclick="triggerDelete('{{ $item->id }}')" class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition cursor-pointer" title="Hapus Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400 italic">Belum ada data kegiatan terdaftar atau data pencarian tidak ditemukan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    @if(isset($kegiatan) && $kegiatan->hasPages())
        <div class="p-4 bg-gray-50/50 border-t border-gray-100">
            {{ $kegiatan->links() }}
        </div>
    @endif
</div>

<div id="modalTambahKegiatan" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl max-h-[90vh] overflow-y-auto relative">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Tambah Kegiatan</h3>
            <button onclick="closeModal('modalTambahKegiatan')" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Judul Kegiatan</label>
                        <input type="text" name="judul" required placeholder="Contoh: Penanaman Pohon" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kategori</label>
                        <select name="kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                            <option value="Eco-Sharing">Eco-Sharing</option>
                            <option value="Eco-Information">Eco-Information</option>
                            <option value="Eco-Volunteer">Eco-Volunteer</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Lokasi</label>
                        <input type="text" name="lokasi" required placeholder="Contoh: Bandung" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tanggal Kejadian</label>
                        <input type="date" name="tanggal_kejadian" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kuota Relawan</label>
                        <input type="number" name="kuota_relawan" min="1" placeholder="Contoh: 50" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Link Kontak (WhatsApp)</label>
                        <input type="text" name="link_kontak" placeholder="https://wa.me/..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Deskripsi Lengkap</label>
                    <textarea name="deskripsi" required rows="3" placeholder="Tulis rincian jalannya aksi lingkungan..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Gambar Banner</label>
                        <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status Keaktifan</label>
                        <select name="status" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" onclick="closeModal('modalTambahKegiatan')" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50 rounded-xl cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow shadow-blue-100 cursor-pointer">Simpan Kegiatan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditKegiatan" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl max-h-[90vh] overflow-y-auto relative">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-900">Form Edit Kegiatan</h3>
            <button onclick="closeModal('modalEditKegiatan')" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Judul Kegiatan</label>
                        <input type="text" id="edit_judul" name="judul" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kategori</label>
                        <select id="edit_kategori" name="kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                            <option value="Eco-Sharing">Eco-Sharing</option>
                            <option value="Eco-Information">Eco-Information</option>
                            <option value="Eco-Volunteer">Eco-Volunteer</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Lokasi</label>
                        <input type="text" id="edit_lokasi" name="lokasi" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tanggal Kejadian</label>
                        <input type="date" id="edit_tanggal_kejadian" name="tanggal_kejadian" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kuota Relawan</label>
                        <input type="number" id="edit_kuota_relawan" name="kuota_relawan" min="1" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Link Kontak (WhatsApp)</label>
                        <input type="text" id="edit_link_kontak" name="link_kontak" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Deskripsi Lengkap</label>
                    <textarea id="edit_deskripsi" name="deskripsi" required rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Ganti Gambar Banner</label>
                        <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status Keaktifan</label>
                        <select id="edit_status" name="status" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" onclick="closeModal('modalEditKegiatan')" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50 rounded-xl cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-amber-500 hover:bg-amber-600 rounded-xl shadow transition cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<form id="deleteForm" method="POST" class="hidden">
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
        // Set action form URL dinamis sesuai ID data
        document.getElementById('editForm').action = `/admin/kegiatan/update/${data.id}`;

        // Isi input formulir modal edit data
        document.getElementById('edit_judul').value = data.judul;
        document.getElementById('edit_kategori').value = data.kategori;
        document.getElementById('edit_lokasi').value = data.lokasi;
        document.getElementById('edit_deskripsi').value = data.deskripsi;
        document.getElementById('edit_status').value = data.status;
        document.getElementById('edit_tanggal_kejadian').value = data.tanggal_kejadian || '';
        document.getElementById('edit_kuota_relawan').value = data.kuota_relawan || '';
        document.getElementById('edit_link_kontak').value = data.link_kontak || '';

        openModal('modalEditKegiatan');
    }

    function triggerDelete(id) {
        if(confirm('Apakah Anda yakin ingin menghapus agenda kegiatan aksi lingkungan ini dari MySQL?')) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/kegiatan/${id}`;
            form.submit();
        }
    }
</script>

@endsection
