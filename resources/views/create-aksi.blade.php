@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-br from-green-600 to-green-700 py-20">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white">Buat Aksi Baru</h1>
        <p class="text-green-100 mt-4">Pilih kategori terlebih dahulu, lalu isi form yang tersedia.</p>
    </div>
</section>

<section class="py-16 bg-gray-50">
<div class="max-w-5xl mx-auto px-6">
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10">

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl font-semibold flex items-center gap-2 text-sm">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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
                <label class="text-sm font-semibold text-gray-700">Judul Aksi</label>
                <input type="text" name="judul" required placeholder="Masukkan judul aksi" class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700">Kategori</label>
                <select name="kategori" id="kategoriSelect" required class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" onchange="toggleFormFields()">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Eco-Volunteer">Eco-Volunteer (Relawan)</option>
                    <option value="Eco-Sharing">Eco-Sharing (Berbagi Barang)</option>
                    <option value="Eco-Information">Eco-Information (Edukasi)</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <label class="text-sm font-semibold text-gray-700">Lokasi</label>
            <input type="text" name="lokasi" required placeholder="Contoh : Bandung" class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
        </div>

        <div id="volunteerFields" style="display:none;">
            <div class="mt-6 grid md:grid-cols-2 gap-6 bg-amber-50 border border-amber-100 rounded-xl p-5">
                <div>
                    <label class="text-sm font-semibold text-gray-700">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kejadian" class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Kuota Relawan</label>
                    <input type="number" name="kuota_relawan" min="1" placeholder="Contoh: 50" class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                </div>
                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Link WhatsApp Panitia</label>
                    <input type="text" name="link_kontak" placeholder="Contoh: https://wa.me/6281234567890" class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                    <p class="text-xs text-gray-400 mt-1">Relawan yang mendaftar akan langsung diarahkan ke nomor ini.</p>
                </div>
            </div>
        </div>

        <div id="sharingFields" style="display:none;">
            <div class="mt-6 bg-purple-50 border border-purple-100 rounded-xl p-5">
                <label class="text-sm font-semibold text-gray-700">Link Kontak (WhatsApp)</label>
                <input type="text" name="link_kontak" placeholder="Contoh: https://wa.me/6281234567890" class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition">
            </div>
        </div>

        <div class="mt-6">
            <label class="text-sm font-semibold text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" rows="6" required placeholder="Tuliskan deskripsi kegiatan..." class="mt-2 w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"></textarea>
        </div>

        <div class="mt-6">
            <label class="text-sm font-semibold text-gray-700">Upload Foto</label>
            <input type="file" name="gambar" accept="image/*" class="mt-2 w-full text-sm text-gray-500 border border-gray-200 rounded-xl p-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700">
        </div>

        <div class="mt-10 flex justify-end gap-4 border-t border-gray-100 pt-6">
            <a href="{{ route('katalog') }}" class="px-8 py-3 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-semibold text-sm">Batal</a>
            <button type="submit" class="px-8 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700 transition font-semibold text-sm shadow-sm">Publikasikan</button>
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