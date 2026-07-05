@extends('layouts.admin')

@section('content')

@if(session('success'))
<div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-2xl shadow-xl border-l-4 border-green-500 transform transition-all duration-300 translate-y-0" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-50 rounded-lg">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
    </div>
    <div class="ms-3 text-sm font-medium text-gray-700">{{ session('success') }}</div>
    <button onclick="document.getElementById('toast-success').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
    </button>
</div>
<script>setTimeout(() => { document.getElementById('toast-success')?.remove(); }, 4000);</script>
@endif

<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between pb-6 mb-6 border-b border-gray-100 gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen Kegiatan</h1>
        <p class="text-sm text-gray-500 mt-1">Pantau, tambah, dan modifikasi seluruh data parameter aksi lingkungan.</p>
    </div>
    <button onclick="toggleModal(true)" class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 group text-base self-start lg:self-auto">
        <svg class="w-5 h-5 mr-2 stroke-current text-white transform group-hover:rotate-90 transition-transform duration-200" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Kegiatan Baru
    </button>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Kegiatan</p>
            <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ $kegiatan->total() }}</h3>
        </div>
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
            <svg class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori Eco-Volunteer</p>
            <h3 class="text-2xl font-extrabold text-blue-600 mt-1">
                {{ $kegiatan->where('kategori', 'Eco-Volunteer')->count() }}
            </h3>
        </div>
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Aktif</p>
            <h3 class="text-2xl font-extrabold text-emerald-600 mt-1">
                {{ $kegiatan->where('status', 'aktif')->count() }}
            </h3>
        </div>
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
            <svg class="w-6 h-6 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
</div>

<div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-col sm:flex-row items-center gap-4 justify-between">
    <form action="{{ route('admin.kegiatan') }}" method="GET" class="w-full sm:w-80 relative">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul kegiatan..." class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
            <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
    </form>
    <div class="flex items-center gap-2 self-end sm:self-auto text-xs text-gray-400 font-medium">
        <span>Menampilkan {{ $kegiatan->count() }} dari {{ $kegiatan->total() }} Data</span>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    @if($kegiatan->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="py-4 px-6">Informasi Kegiatan</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6">Lokasi / Kontak</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @foreach($kegiatan as $item)
                    <tr class="hover:bg-gray-50/70 transition duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-11 h-11 rounded-lg object-cover shadow-sm bg-gray-100 flex-shrink-0">
                                @else
                                    <div class="w-11 h-11 rounded-lg bg-green-50 flex items-center justify-center text-green-600 font-bold flex-shrink-0 text-base">
                                        {{ strtoupper(substr($item->judul, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-gray-900 text-base">{{ $item->judul }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">
                                        {{ $item->tanggal_kejadian ? \Carbon\Carbon::parse($item->tanggal_kejadian)->translatedFormat('d F Y') : 'Tanggal belum diatur' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-gray-600">
                            <div class="font-semibold text-gray-800">{{ $item->lokasi }}</div>
                            <div class="text-xs text-gray-400 truncate max-w-[150px]">{{ $item->link_kontak ?? '-' }}</div>
                        </td>
                        <td class="py-4 px-6">
                            @if($item->status == 'aktif')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Selesai
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.kegiatan', ['search' => $item->judul]) }}" class="text-gray-500 hover:text-gray-900 p-2 hover:bg-gray-100 rounded-lg transition" title="Detail">
                                    <svg class="w-5 h-5 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <form action="#" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-5 h-5 fill-none stroke-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="py-16 px-6 text-center max-w-xl mx-auto flex flex-col items-center justify-center">
            <div class="w-20 h-20 bg-green-50 rounded-3xl flex items-center justify-center text-green-600 mb-5 shadow-sm border border-green-100/50">
                <svg class="w-10 h-10 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 tracking-tight">Belum Ada Agenda Kegiatan</h3>
            <p class="text-sm text-gray-500 mt-2 max-w-sm leading-relaxed">
                Halaman manajemen ini masih kosong karena tidak ada data di database. Mari isi modul aktivitas pertama Anda sekarang.
            </p>
            <button onclick="toggleModal(true)" class="mt-6 inline-flex items-center bg-white hover:bg-gray-50 border border-gray-200 text-gray-800 font-bold text-sm px-5 py-3 rounded-xl shadow-sm transition">
                Mulai Buat Kegiatan Pertama
            </button>
        </div>
    @endif
</div>

<div class="mt-6">
    {{ $kegiatan->links() }}
</div>

<div id="kegiatanModal" class="fixed inset-0 bg-slate-900/25 backdrop-blur-[2px] hidden items-center justify-center z-50 transition-all duration-200">
    <div class="bg-slate-50 rounded-2xl shadow-2xl w-full max-w-5xl mx-6 overflow-hidden transform transition-all flex flex-col max-h-[92vh]">

        <div class="px-8 py-5 bg-white border-b border-gray-200 flex justify-between items-center flex-shrink-0">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Form Pembuatan Kegiatan Baru</h3>
                <p class="text-sm text-gray-500 mt-1">Silakan lengkapi data parameter di bawah ini secara teliti.</p>
            </div>
            <button onclick="toggleModal(false)" class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-xl transition text-2xl leading-none">&times;</button>
        </div>

        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-grow overflow-hidden">
            @csrf

            <div class="p-8 space-y-6 overflow-y-auto flex-grow text-gray-700">

                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Judul Kegiatan <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" placeholder="Contoh: Gerakan Penanaman Mangrove Bersama di Wilayah Pesisir" class="w-full border border-gray-300 px-4 py-3 rounded-xl text-base focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all shadow-sm" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Kategori Kegiatan <span class="text-red-500">*</span></label>
                        <select name="kategori" class="w-full border border-gray-300 px-4 py-3 rounded-xl text-base focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all bg-white shadow-sm" required>
                            <option value="Eco-Volunteer">Eco-Volunteer (Relawan)</option>
                            <option value="Eco-Sharing">Eco-Sharing (Berbagi Berkas)</option>
                            <option value="Eco-Information">Eco-Information (Mading Informasi)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Status Publikasi Awal <span class="text-red-500">*</span></label>
                        <select name="status" class="w-full border border-gray-300 px-4 py-3 rounded-xl text-base focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all bg-white shadow-sm" required>
                            <option value="aktif">Aktif / Berjalan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Lokasi Pelaksanaan <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" placeholder="Masukkan alamat lengkap atau platform daring" class="w-full border border-gray-300 px-4 py-3 rounded-xl text-base focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Tanggal Pelaksanaan Agenda</label>
                        <input type="date" name="tanggal_kejadian" class="w-full border border-gray-300 px-4 py-3 rounded-xl text-base focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all bg-white shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Kuota Batas Relawan</label>
                        <input type="number" name="kuota_relawan" min="1" placeholder="Kosongkan jika terbuka umum tanpa batas" class="w-full border border-gray-300 px-4 py-3 rounded-xl text-base focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Tautan Kontak Informasi (WhatsApp / External Link)</label>
                        <input type="text" name="link_kontak" placeholder="https://wa.me/62xxxxxxxx" class="w-full border border-gray-300 px-4 py-3 rounded-xl text-base focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all shadow-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Deskripsi Lengkap Kegiatan <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="6" placeholder="Tulis rincian deskripsi, persyaratan kerja bakti, aturan, serta poin pendaftaran secara komprehensif di sini..." class="w-full border border-gray-300 px-4 py-3 rounded-xl text-base focus:border-green-500 focus:ring-4 focus:ring-green-500/10 focus:outline-none transition-all resize-none shadow-sm font-sans" required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Gambar Cover / Banner Pamflet</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-white hover:bg-gray-50/50 transition duration-150 shadow-sm">
                            <div class="flex flex-col items-center justify-center pt-3 pb-4">
                                <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-sm text-gray-500"><span class="font-bold text-green-600">Klik untuk upload gambar</span> (Format: PNG, JPG maksimal 2MB)</p>
                            </div>
                            <input type="file" name="gambar" accept="image/*" class="hidden">
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-8 py-5 bg-white border-t border-gray-200 flex justify-end space-x-4 flex-shrink-0">
                <button type="button" onclick="toggleModal(false)" class="bg-white hover:bg-gray-100 border border-gray-300 text-gray-700 font-bold px-6 py-3.5 rounded-xl text-base transition shadow-sm">
                    Batal
                </button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-3.5 rounded-xl text-base shadow-md hover:shadow-lg transition">
                    Simpan & Daftarkan Kegiatan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(show) {
        const modal = document.getElementById('kegiatanModal');
        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
</script>

@endsection
