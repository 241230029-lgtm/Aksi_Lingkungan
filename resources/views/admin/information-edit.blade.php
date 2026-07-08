@extends('layouts.admin')

@section('page-title', 'Edit Information')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-neutral-100 p-6 md:p-8">
        <form method="POST" action="{{ route('admin.information.update', $information->id) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="form-label">Judul Artikel *</label>
                <input type="text" name="judul" value="{{ old('judul', $information->judul) }}" required class="form-input">
                @error('judul')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Deskripsi *</label>
                <textarea name="deskripsi" rows="8" required class="form-input">{{ old('deskripsi', $information->deskripsi) }}</textarea>
                @error('deskripsi')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Gambar</label>
                @if($information->gambar)
                <div class="mb-2"><img src="{{ Storage::url($information->gambar) }}" class="w-40 h-28 object-cover rounded-lg"></div>
                @endif
                <input type="file" name="gambar" accept="image/*" class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                <p class="text-xs text-neutral-400 mt-1">Kosongkan jika tidak ingin mengubah</p>
                @error('gambar')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.information.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
