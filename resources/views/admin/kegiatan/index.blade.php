@extends('layouts.admin')

@push('styles')

<style>
.label { @apply block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1; }
.input { @apply w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500; }
.file-input { @apply w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100; }
.badge { @apply px-2.5 py-1 rounded-md text-xs font-semibold border; }
.btn { @apply px-4 py-2 text-sm font-semibold rounded-xl cursor-pointer transition; }
.icon-btn { @apply p-2 rounded-lg transition cursor-pointer; }
</style>
@endpush

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
<input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan..." class="input pl-10 w-60 shadow-sm">
<svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
</form>
<button onclick="openModal('modalKegiatan')" class="btn bg-blue-600 hover:bg-blue-700 text-white shadow-sm">+ Tambah</button>
</div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left whitespace-nowrap text-sm">
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
<tbody class="divide-y divide-gray-100 text-gray-700">
@forelse($kegiatan as $item)
<tr class="hover:bg-gray-50/40 transition">
<td class="p-4 px-6">
@if($item->gambar)
<img src="{{ asset('storage/' . $item->gambar) }}" class="w-12 h-12 object-cover rounded-xl border border-gray-100">
@else
<div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 text-xs font-bold">-</div>
@endif
</td>
<td class="p-4 px-6 font-bold text-gray-900 max-w-xs truncate" title="{{ $item->judul }}">{{ $item->judul }}</td>
<td class="p-4 px-6"><span class="badge bg-blue-50 text-blue-700 border-blue-100">{{ $item->kategori }}</span></td>
<td class="p-4 px-6 text-gray-500">{{ $item->lokasi }}</td>
<td class="p-4 px-6">
<span class="badge rounded-full {{ $item->status == 'Aktif' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-gray-100 text-gray-600 border-gray-200' }}">
{{ $item->status }}
</span>
</td>
<td class="p-4 px-6">
<div class="flex items-center justify-center gap-2">
<button onclick="openEditModal({{ json_encode($item) }})" class="icon-btn bg-amber-50 hover:bg-amber-100 text-amber-700" title="Edit">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 20H8v-3L19.586 4.353z"/></svg>
</button>
<button onclick="triggerDelete({{ $item->id_kegiatan }})" class="icon-btn bg-red-50 hover:bg-red-100 text-red-600" title="Hapus">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
</button>
</div>
</td>
</tr>
@empty
<tr><td colspan="6" class="p-8 text-center text-gray-400 italic">Belum ada data kegiatan.</td></tr>
@endforelse
</tbody>
</table>
</div>
@if($kegiatan->hasPages())
<div class="p-4 bg-gray-50/50 border-t border-gray-100">{{ $kegiatan->links() }}</div>
@endif
</div>

<div id="modalKegiatan" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
<div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl relative">
<div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-100">
<h3 id="modalTitle" class="text-xl font-bold text-gray-900">Tambah Kegiatan</h3>
<button onclick="closeModal('modalKegiatan')" class="text-gray-400 hover:text-gray-600 cursor-pointer">✕</button>
</div>

<form id="kegiatanForm" action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
@csrf
<input type="hidden" name="_method" value="POST">

<div>
<div class="label">Preview Gambar</div>
<div class="w-full h-40 bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center overflow-hidden">
<img id="imgPreview" src="" class="hidden w-full h-full object-cover">
<span id="imgPlaceholder" class="text-gray-400 text-xs font-semibold">Belum ada gambar</span>
</div>
</div>

<div class="grid grid-cols-2 gap-4">
<div>
<label class="label">Judul</label>
<input type="text" name="judul" id="f_judul" required class="input">
</div>
<div>
<label class="label">Kategori</label>
<select name="kategori" id="f_kategori" required class="input">
<option value="Eco-Sharing">Eco-Sharing</option>
<option value="Eco-Information">Eco-Information</option>
<option value="Eco-Volunteer">Eco-Volunteer</option>
</select>
</div>
</div>

<div class="grid grid-cols-2 gap-4">
<div>
<label class="label">Lokasi</label>
<input type="text" name="lokasi" id="f_lokasi" required class="input">
</div>
<div>
<label class="label">Tanggal</label>
<input type="date" name="tanggal_kejadian" id="f_tanggal" class="input">
</div>
</div>

<div class="grid grid-cols-2 gap-4">
<div>
<label class="label">Kuota Relawan</label>
<input type="number" name="kuota_relawan" id="f_kuota" min="1" class="input">
</div>
<div>
<label class="label">Link WA</label>
<input type="text" name="link_kontak" id="f_link" placeholder="https://wa.me/..." class="input">
</div>
</div>

<div>
<label class="label">Deskripsi</label>
<textarea name="deskripsi" id="f_deskripsi" required rows="3" class="input"></textarea>
</div>

<div class="grid grid-cols-2 gap-4">
<div>
<label class="label">Gambar</label>
<input type="file" name="gambar" accept="image/*" onchange="previewImage(event)" class="file-input">
</div>
<div>
<label class="label">Status</label>
<select name="status" id="f_status" required class="input">
<option value="Aktif">Aktif</option>
<option value="Selesai">Selesai</option>
</select>
</div>
</div>

<div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
<button type="button" onclick="closeModal('modalKegiatan')" class="btn text-gray-500 hover:bg-gray-50">Batal</button>
<button type="submit" id="submitBtn" class="btn text-white bg-blue-600 hover:bg-blue-700 shadow">Simpan</button>
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
document.getElementById('modalTitle').textContent = 'Edit Kegiatan';
document.getElementById('kegiatanForm').action = '/admin/kegiatan/update/' + data.id_kegiatan;
document.querySelector('#kegiatanForm input[name="_method"]').value = 'PUT';

document.getElementById('f_judul').value = data.judul || '';
document.getElementById('f_kategori').value = data.kategori || '';
document.getElementById('f_lokasi').value = data.lokasi || '';
document.getElementById('f_tanggal').value = data.tanggal_kejadian || '';
document.getElementById('f_kuota').value = data.kuota_relawan || '';
document.getElementById('f_link').value = data.link_kontak || '';
document.getElementById('f_deskripsi').value = data.deskripsi || '';
document.getElementById('f_status').value = data.status || '';

if (data.gambar) {
document.getElementById('imgPreview').src = '{{ asset("storage/") }}/' + data.gambar;
document.getElementById('imgPreview').classList.remove('hidden');
document.getElementById('imgPlaceholder').classList.add('hidden');
} else {
resetPreview();
}

var submitBtn = document.getElementById('submitBtn');
submitBtn.textContent = 'Simpan Perubahan';
submitBtn.className = 'btn text-white bg-amber-500 hover:bg-amber-600 shadow';

openModal('modalKegiatan');
}

function resetPreview() {
document.getElementById('imgPreview').src = '';
document.getElementById('imgPreview').classList.add('hidden');
document.getElementById('imgPlaceholder').classList.remove('hidden');
}

function previewImage(e) {
const file = e.target.files && e.target.files[0];
if (!file) return resetPreview();
const reader = new FileReader();
reader.onload = function(ev) {
document.getElementById('imgPreview').src = ev.target.result;
document.getElementById('imgPreview').classList.remove('hidden');
document.getElementById('imgPlaceholder').classList.add('hidden');
};
reader.readAsDataURL(file);
}

function triggerDelete(id) {
if(confirm('Yakin ingin menghapus kegiatan ini?')) {
const f = document.getElementById('deleteForm');
f.action = '/admin/kegiatan/' + id;
f.submit();
}
}

document.getElementById('modalKegiatan').addEventListener('click', function(e) {
if (e.target === this) closeModal('modalKegiatan');
});
</script>

@endsection



