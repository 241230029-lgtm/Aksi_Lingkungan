@extends('layouts.app')

@section('content')

<section class="bg-green-600 py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-5xl font-bold text-white">Buat Aksi Baru</h1>
        <p class="text-green-100 mt-3">Pilih kategori terlebih dahulu, lalu isi form yang tersedia.</p>
    </div>
</section>

<section class="py-16 bg-gray-100">
<div class="max-w-5xl mx-auto px-6">
<div class="bg-white rounded-3xl shadow-lg p-10">

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl font-semibold">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('user.aksi.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="font-semibold">Judul Aksi</label>
                <input type="text" name="judul" required placeholder="Masukkan judul aksi" class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
            </div>
            <div>
                <label class="font-semibold">Kategori</label>
                <select name="kategori" id="kategoriSelect" required class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none" onchange="toggleFormFields()">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Eco-Volunteer">Eco-Volunteer (Relawan)</option>
                    <option value="Eco-Sharing">Eco-Sharing (Berbagi Barang)</option>
                    <option value="Eco-Information">Eco-Information (Edukasi)</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <label class="font-semibold">Lokasi</label>
            <input type="text" name="lokasi" required placeholder="Contoh : Bandung" class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
        </div>

        <div id="volunteerFields" style="display:none;">
            <div class="mt-6 grid md:grid-cols-2 gap-6">
                <div>
                    <label class="font-semibold">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kejadian" class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>
                <div>
                    <label class="font-semibold">Kuota Relawan</label>
                    <input type="number" name="kuota_relawan" min="1" placeholder="Contoh: 50" class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>
            </div>
        </div>

        <div id="sharingFields" style="display:none;">
            <div class="mt-6">
                <label class="font-semibold">Link Kontak (WhatsApp)</label>
                <input type="text" name="link_kontak" placeholder="Contoh: https://wa.me/6281234567890" class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
            </div>
        </div>

        <div class="mt-6">
            <label class="font-semibold">Deskripsi</label>
            <textarea name="deskripsi" rows="6" required placeholder="Tuliskan deskripsi kegiatan..." class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none"></textarea>
        </div>

        <div class="mt-6">
            <label class="font-semibold">Upload Foto</label>
            <input type="file" name="gambar" accept="image/*" class="mt-2 w-full border rounded-xl p-3">
        </div>

        <div class="mt-10 flex justify-end gap-4">
            <a href="{{ route('katalog') }}" class="px-8 py-3 rounded-xl border hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-8 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700 font-semibold">Publikasikan</button>
        </div>
    </form>

</div>
</div>
</section>

@push('scripts')
<script>
function toggleFormFields() {
    const kategori = document.getElementById('kategoriSelect').value;
    document.getElementById('volunteerFields').style.display = (kategori === 'Eco-Volunteer') ? 'block' : 'none';
    document.getElementById('sharingFields').style.display = (kategori === 'Eco-Sharing') ? 'block' : 'none';
}
</script>
@endpush

@endsection
