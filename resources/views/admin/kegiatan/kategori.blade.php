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
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen {{ $kategori }}</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola data {{ strtolower($kategori) }} yang masuk ke Katalog pengguna.</p>
    </div>
    <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition shadow-sm cursor-pointer">+ Tambah {{ $kategori }}</button>
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
                <tr class="hover:bg-gray-50/40 transition">
                    <td class="p-4 px-6 font-bold text-gray-900">{{ $item->judul }}</td>
                    <td class="p-4 px-6 text-gray-500">{{ $item->lokasi }}</td>
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
                <tr><td colspan="4" class="p-8 text-center text-gray-400 italic">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
        <div class="p-4 bg-gray-50/50 border-t border-gray-100">{{ $items->links() }}</div>
    @endif
</div>

{{-- MODAL TAMBAH & EDIT --}}
<div id="modal" style="display:none; position:fixed; inset:0; z-index:50; background-color:rgba(0,0,0,0.6); align-items:center; justify-content:center; padding:1rem; overflow-y:auto;">
    <div style="background-color:white; border-radius:1.5rem; max-width:32rem; width:100%; padding:2rem; box-shadow:0 25px 50px -12px rgba(0,0,0,0.25); margin:auto; position:relative;">
        <button onclick="closeModal()" style="position:absolute; top:1rem; right:1.5rem; background:none; border:none; cursor:pointer; color:#9ca3af;">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h3 id="modalTitle" style="font-size:1.25rem; font-weight:700; color:#111827;" class="mb-6"></h3>

        <form id="mainForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="kategori" value="{{ $kategori }}">

            <div style="display:grid; gap:1rem;">
                <div>
                    <label style="display:block; font-size:0.75rem; font-weight:700; color:#9ca3af; text-transform:uppercase; margin-bottom:0.25rem;">Judul</label>
                    <input type="text" name="judul" id="f_judul" required class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label style="display:block; font-size:0.75rem; font-weight:700; color:#9ca3af; text-transform:uppercase; margin-bottom:0.25rem;">Lokasi</label>
                    <input type="text" name="lokasi" id="f_lokasi" required class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div id="fieldVolunteer" style="display:none; margin-top:1rem; display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:0.75rem; font-weight:700; color:#9ca3af; text-transform:uppercase; margin-bottom:0.25rem;">Tanggal</label>
                    <input type="date" name="tanggal_kejadian" id="f_tanggal" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label style="display:block; font-size:0.75rem; font-weight:700; color:#9ca3af; text-transform:uppercase; margin-bottom:0.25rem;">Kuota Relawan</label>
                    <input type="number" name="kuota_relawan" id="f_kuota" min="1" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div id="fieldSharing" style="display:none; margin-top:1rem;">
                <label style="display:block; font-size:0.75rem; font-weight:700; color:#9ca3af; text-transform:uppercase; margin-bottom:0.25rem;">Link WhatsApp</label>
                <input type="text" name="link_kontak" id="f_link" placeholder="https://wa.me/..." class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>

            <div style="margin-top:1rem;">
                <label style="display:block; font-size:0.75rem; font-weight:700; color:#9ca3af; text-transform:uppercase; margin-bottom:0.25rem;">Deskripsi</label>
                <textarea name="deskripsi" id="f_deskripsi" required rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-top:1rem;">
                <div>
                    <label style="display:block; font-size:0.75rem; font-weight:700; color:#9ca3af; text-transform:uppercase; margin-bottom:0.25rem;">Gambar</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                </div>
                <div>
                    <label style="display:block; font-size:0.75rem; font-weight:700; color:#9ca3af; text-transform:uppercase; margin-bottom:0.25rem;">Status</label>
                    <select name="status" id="f_status" required class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
                        <option value="Aktif">Aktif</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>

            <div style="margin-top:1.5rem; display:flex; justify-content:flex-end; gap:0.75rem; border-top:1px solid #f3f4f6; padding-top:1rem;">
                <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50 rounded-xl cursor-pointer">Batal</button>
                <button type="submit" id="submitBtn" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>

<script>
const form = document.getElementById('mainForm');
const modal = document.getElementById('modal');
const kategori = "{{ $kategori }}";

document.getElementById('fieldVolunteer').style.display = (kategori === 'Eco-Volunteer') ? 'grid' : 'none';
document.getElementById('fieldSharing').style.display = (kategori === 'Eco-Sharing') ? 'block' : 'none';

function openModal() {
    document.getElementById('modalTitle').textContent = 'Tambah ' + kategori;
    document.getElementById('submitBtn').textContent = 'Simpan ' + kategori;
    form.action = window.location.pathname + '/store';
    form.querySelector('input[name="_method"]').value = 'POST';
    form.reset();
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

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
            }
            if(kategori === 'Eco-Sharing') {
                document.getElementById('f_link').value = data.link_kontak || '';
            }
        });

    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    modal.style.display = 'none';
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
