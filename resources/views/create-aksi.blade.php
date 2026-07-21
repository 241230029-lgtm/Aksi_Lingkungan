@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-br from-emerald-700 to-slate-900 py-14 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">Buat Aksi Baru</h1>
        <p class="text-emerald-100 mt-4 text-sm sm:text-base">Pilih kategori terlebih dahulu, lalu isi form yang tersedia.</p>
    </div>
</section>

<section class="py-10 sm:py-16 bg-slate-50">
<div class="max-w-5xl mx-auto px-4 sm:px-6">
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-5 sm:p-10">

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl font-semibold flex items-center gap-2 text-sm">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
            <p class="font-bold mb-1">Data gagal disimpan, periksa kembali:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.aksi.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="text-sm font-semibold text-slate-700">Judul Aksi</label>
                <input type="text" name="judul" required placeholder="Masukkan judul aksi" class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Kategori</label>
                <select name="kategori" id="kategoriSelect" required class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition" onchange="toggleFormFields()">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Eco-Volunteer">Eco-Volunteer (Relawan)</option>
                    <option value="Eco-Sharing">Eco-Sharing (Berbagi Barang)</option>
                    <option value="Eco-Information">Eco-Information (Edukasi)</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <label class="text-sm font-semibold text-slate-700">Lokasi</label>
            <input type="text" name="lokasi" required placeholder="Contoh : Bandung" class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
        </div>

        <div id="volunteerFields" style="display:none;">
            <div class="mt-6 grid md:grid-cols-2 gap-6 bg-amber-50 border border-amber-100 rounded-xl p-4 sm:p-5">
                <div>
                    <label class="text-sm font-semibold text-slate-700">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kejadian" class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Kuota Relawan</label>
                    <input type="number" name="kuota_relawan" min="1" placeholder="Contoh: 50" class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                </div>
                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700">Link WhatsApp Panitia</label>
                    <input type="text" name="link_kontak" placeholder="Contoh: https://wa.me/6281234567890" class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                    <p class="text-xs text-slate-400 mt-1">Relawan yang mendaftar akan langsung diarahkan ke nomor ini.</p>
                </div>
            </div>
        </div>

        <div id="sharingFields" style="display:none;">
            <div class="mt-6 bg-purple-50 border border-purple-100 rounded-xl p-4 sm:p-5">
                <label class="text-sm font-semibold text-slate-700">Link Kontak (WhatsApp)</label>
                <input type="text" name="link_kontak" placeholder="Contoh: https://wa.me/6281234567890" class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition">
            </div>
        </div>

        <div class="mt-6">
            <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
            <textarea name="deskripsi" rows="6" required placeholder="Tuliskan deskripsi kegiatan..." class="mt-2 w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"></textarea>
        </div>

        <div class="mt-6">
            <label class="text-sm font-semibold text-slate-700">Upload Foto</label>
            <input type="file" name="gambar" accept="image/*" class="mt-2 w-full text-sm text-slate-500 border border-slate-200 rounded-xl p-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
        </div>

        <div class="mt-10 flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 border-t border-slate-100 pt-6">
            <a href="{{ route('katalog') }}" class="text-center px-8 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition font-semibold text-sm">Batal</a>
            <button type="submit" class="px-8 py-3 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition font-semibold text-sm shadow-sm">Publikasikan</button>
        </div>
    </form>

</div>
</div>
</section>

@push('scripts')
<script>
function toggleFormFields() {
    const kategori = document.getElementById('kategoriSelect').value;
    const isVolunteer = (kategori === 'Eco-Volunteer');
    const isSharing = (kategori === 'Eco-Sharing');

    document.getElementById('volunteerFields').style.display = isVolunteer ? 'block' : 'none';
    document.getElementById('sharingFields').style.display = isSharing ? 'block' : 'none';

    document.querySelectorAll('#volunteerFields input').forEach(el => el.disabled = !isVolunteer);
    document.querySelectorAll('#sharingFields input').forEach(el => el.disabled = !isSharing);
}
</script>
@endpush

@endsection