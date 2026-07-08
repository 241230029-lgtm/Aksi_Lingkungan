@extends('layouts.admin')

@section('page-title', 'Tambah Information')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-neutral-100 p-6 md:p-8">
        <form method="POST" action="{{ route('admin.information.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="form-label">Judul Artikel *</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required class="form-input" placeholder="Judul artikel edukasi">
                @error('judul')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Deskripsi *</label>
                <textarea name="deskripsi" rows="8" required class="form-input" placeholder="Isi artikel edukasi...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Gambar *</label>
                <input type="file" name="gambar" accept="image/*" required class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                @error('gambar')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Publikasikan</button>
                <a href="{{ route('admin.information.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
