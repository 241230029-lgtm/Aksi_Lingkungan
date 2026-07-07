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
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 w-60 shadow-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </form>
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
                    <th class="p-4 px-6">Tanggal</th>
                    <th class="p-4 px-6">Status</th>
                    <th class="p-4 px-6 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse($kegiatan as $item)
                <tr class="hover:bg-gray-50/40 transition">
                    <td class="p-4 px-6">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-12 h-12 object-cover rounded-xl border border-gray-100 cursor-pointer" onclick="openImagePreview('{{ asset('storage/' . $item->gambar) }}')">
                        @else
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 text-xs font-bold">-</div>
                        @endif
                    </td>
                    <td class="p-4 px-6 font-bold text-gray-900 max-w-xs truncate" title="{{ $item->judul }}">{{ $item->judul }}</td>
                    <td class="p-4 px-6"><span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">{{ $item->kategori }}</span></td>
                    <td class="p-4 px-6 text-gray-500">{{ $item->lokasi }}</td>
                    <td class="p-4 px-6 text-xs text-gray-500">
                        {{ $item->tanggal_kejadian ? \Carbon\Carbon::parse($item->tanggal_kejadian)->translatedFormat('d M Y') : '-' }}
                    </td>
                    <td class="p-4 px-6">
                        @php
                            $statusColor = match($item->status) {
                                'akan_datang' => 'bg-amber-50 text-amber-700 border-amber-100',
                                'terlaksana'  => 'bg-blue-50 text-blue-700 border-blue-100',
                                'selesai'     => 'bg-gray-100 text-gray-600 border-gray-200',
                                default       => 'bg-gray-100 text-gray-600 border-gray-200',
                            };
                            $statusLabel = match($item->status) {
                                'akan_datang' => 'Akan Datang',
                                'terlaksana'  => 'Terlaksana',
                                'selesai'     => 'Selesai',
                                default       => $item->status,
                            };
                        @endphp
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusColor }}">
                            {{ $statusLabel }}
                        </span>
                    </td>
                    <td class="p-4 px-6">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openModal('edit', {{ $item->id_kegiatan }})" class="p-2 rounded-lg transition cursor-pointer bg-amber-50 hover:bg-amber-100 text-amber-700" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 20H8v-3L19.586 4.353z"/></svg>
                            </button>
                            <button onclick="deleteItem({{ $item->id_kegiatan }})" class="p-2 rounded-lg transition cursor-pointer bg-red-50 hover:bg-red-100 text-red-600" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="p-8 text-center text-gray-400 italic">Belum ada data kegiatan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($kegiatan->hasPages())
        <div class="p-4 bg-gray-50/50 border-t border-gray-100">{{ $kegiatan->links() }}</div>
    @endif
</div>

{{-- MODAL PREVIEW GAMBAR --}}
<div id="imagePreviewModal" style="display: none; position: fixed; inset: 0; z-index: 60; background-color: rgba(0,0,0,0.8); align-items: center; justify-content: center; padding: 1rem;" onclick="closeImagePreview()">
    <img id="imagePreviewImg" src="" style="max-width: 90%; max-height: 90%; border-radius: 0.75rem;">
</div>

{{-- MODAL EDIT --}}
<div id="modal" style="display: none; position: fixed; inset: 0; z-index: 50; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; padding: 1rem; overflow-y: auto;">
    <div style="background-color: white; border-radius: 1rem; max-width: 32rem; width: 100%; padding: 1.5rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); max-height: 90vh; overflow-y: auto; margin: auto;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #f3f4f6;">
            <h3 id="modalTitle" style="font-size: 1.25rem; font-weight: 700; color: #111827;">Edit Kegiatan</h3>
            <button onclick="closeModal()" style="color: #9ca3af; cursor: pointer; background: none; border: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="kegiatanForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div style="margin-bottom: 1rem;">
                <div style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Preview Gambar</div>
                <div style="width: 100%; height: 10rem; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img id="imgPreview" src="" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                    <span id="imgPlaceholder" style="color: #9ca3af; font-size: 0.75rem; font-weight: 600;">Belum ada gambar</span>
                </div>
            </div>
            <div style="display: grid; gap: 1rem;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Judul</label>
                        <input type="text" name="judul" id="f_judul" required class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Kategori</label>
                        <select name="kategori" id="f_kategori" required class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                            <option value="Eco-Sharing">Eco-Sharing</option>
                            <option value="Eco-Information">Eco-Information</option>
                            <option value="Eco-Volunteer">Eco-Volunteer</option>
                        </select>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Lokasi</label>
                        <input type="text" name="lokasi" id="f_lokasi" required class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Tanggal</label>
                        <input type="date" name="tanggal_kejadian" id="f_tanggal" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Kuota Relawan</label>
                        <input type="number" name="kuota_relawan" id="f_kuota" min="1" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Link WA</label>
                        <input type="text" name="link_kontak" id="f_link" placeholder="https://wa.me/..." class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Deskripsi</label>
                    <textarea name="deskripsi" id="f_deskripsi" required rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Gambar</label>
                        <input type="file" name="gambar" accept="image/*" onchange="previewImage(event)" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">File Dokumen (PDF)</label>
                        <input type="file" name="file" accept="application/pdf" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Status</label>
                    <select name="status" id="f_status" required class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                        <option value="akan_datang">Akan Datang</option>
                        <option value="terlaksana">Terlaksana</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>
            <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 0.75rem; border-top: 1px solid #f3f4f6; padding-top: 1rem;">
                <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50 rounded-xl cursor-pointer">Batal</button>
                <button type="submit" id="submitBtn" style="background-color: #f59e0b;" class="px-4 py-2 text-sm font-semibold text-white rounded-xl cursor-pointer transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>
<script>
    const form = document.getElementById('kegiatanForm');
    const modal = document.getElementById('modal');
    function openModal(mode, id = null) {
        form.action = '/admin/kegiatan/update/' + id;
        fetch('/admin/kegiatan/' + id + '/edit')
            .then(r => r.json())
            .then(data => {
                document.getElementById('f_judul').value = data.judul || '';
                document.getElementById('f_kategori').value = data.kategori || '';
                document.getElementById('f_lokasi').value = data.lokasi || '';
                document.getElementById('f_tanggal').value = data.tanggal_kejadian ? data.tanggal_kejadian.substring(0,10) : '';
                document.getElementById('f_kuota').value = data.kuota_relawan || '';
                document.getElementById('f_link').value = data.link_kontak || '';
                document.getElementById('f_deskripsi').value = data.deskripsi || '';
                document.getElementById('f_status').value = data.status || '';
                if (data.gambar) {
                    document.getElementById('imgPreview').src = '{{ asset("storage/") }}/' + data.gambar;
                    document.getElementById('imgPreview').style.display = 'block';
                    document.getElementById('imgPlaceholder').style.display = 'none';
                } else {
                    resetPreview();
                }
            });
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
    function resetPreview() {
        document.getElementById('imgPreview').src = '';
        document.getElementById('imgPreview').style.display = 'none';
        document.getElementById('imgPlaceholder').style.display = 'block';
    }
    function previewImage(e) {
        const file = e.target.files && e.target.files[0];
        if (!file) return resetPreview();
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('imgPreview').src = ev.target.result;
            document.getElementById('imgPreview').style.display = 'block';
            document.getElementById('imgPlaceholder').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
    function deleteItem(id) {
        if (confirm('Hapus kegiatan ini?')) {
            const f = document.getElementById('deleteForm');
            f.action = '/admin/kegiatan/' + id;
            f.submit();
        }
    }
    function openImagePreview(src) {
        document.getElementById('imagePreviewImg').src = src;
        document.getElementById('imagePreviewModal').style.display = 'flex';
    }
    function closeImagePreview() {
        document.getElementById('imagePreviewModal').style.display = 'none';
    }
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
</script>
@endsection