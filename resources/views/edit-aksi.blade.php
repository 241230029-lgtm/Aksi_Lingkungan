@extends('layouts.app')

@section('title', 'Edit Aksi')

@section('content')
<section class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card p-6 md:p-8">
            <h1 class="text-2xl font-bold text-neutral-900 mb-6">Edit Aksi</h1>

            <form method="POST" action="{{ route('aksi.update', $kegiatan->id) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="form-label">Judul Aksi *</label>
                    <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" required class="form-input">
                    @error('judul')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Kategori Aksi *</label>
                        <select name="kategori" required class="form-input" id="kategori-select">
                            <option value="Eco-Sharing" {{ old('kategori', $kegiatan->kategori) == 'Eco-Sharing' ? 'selected' : '' }}>Eco-Sharing</option>
                            <option value="Eco-Information" {{ old('kategori', $kegiatan->kategori) == 'Eco-Information' ? 'selected' : '' }}>Eco-Information</option>
                            <option value="Eco-Volunteer" {{ old('kategori', $kegiatan->kategori) == 'Eco-Volunteer' ? 'selected' : '' }}>Eco-Volunteer</option>
                        </select>
                    </div>
                    <div id="kuota-field" class="{{ $kegiatan->kategori !== 'Eco-Volunteer' ? 'hidden' : '' }}">
                        <label class="form-label">Kuota Relawan</label>
                        <input type="number" name="kuota" value="{{ old('kuota', $kegiatan->kuota) }}" min="1" class="form-input">
                    </div>
                </div>

                <div>
                    <label class="form-label">Deskripsi *</label>
                    <textarea name="deskripsi" rows="5" required class="form-input">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Lokasi *</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" required class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Tanggal & Waktu *</label>
                        <input type="datetime-local" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal ? $kegiatan->tanggal->format('Y-m-d\TH:i') : '') }}" required class="form-input">
                    </div>
                </div>

                <div id="wa-field" class="{{ $kegiatan->kategori !== 'Eco-Sharing' ? 'hidden' : '' }}">
                    <label class="form-label">No. WhatsApp</label>
                    <input type="text" name="kontak_wa" value="{{ old('kontak_wa', $kegiatan->kontak_wa) }}" class="form-input">
                </div>

                <div>
                    <label class="form-label">Gambar Aksi</label>
                    @if($kegiatan->gambar)
                    <div class="mb-2">
                        <img src="{{ Storage::url($kegiatan->gambar) }}" class="w-32 h-24 object-cover rounded-lg">
                    </div>
                    @endif
                    <input type="file" name="gambar" accept="image/*" class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="text-xs text-neutral-400 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('profile') }}" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    const kat = document.getElementById('kategori-select').value;
    if(kat === 'Eco-Volunteer') document.getElementById('kuota-field').classList.remove('hidden');
    if(kat === 'Eco-Sharing') document.getElementById('wa-field').classList.remove('hidden');

    document.getElementById('kategori-select').addEventListener('change', function() {
        const kuota = document.getElementById('kuota-field');
        const wa = document.getElementById('wa-field');
        if (this.value === 'Eco-Volunteer') { kuota.classList.remove('hidden'); wa.classList.add('hidden'); }
        else if (this.value === 'Eco-Sharing') { kuota.classList.add('hidden'); wa.classList.remove('hidden'); }
        else { kuota.classList.add('hidden'); wa.classList.add('hidden'); }
    });
</script>
@endpush
@endsection
