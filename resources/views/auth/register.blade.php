@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full slide-up">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/25">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-neutral-900">Buat Akun Baru</h2>
            <p class="mt-2 text-neutral-500">Bergabung untuk melestarikan lingkungan</p>
        </div>

        <div class="card p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="form-input" placeholder="Masukkan nama lengkap">
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="contoh@email.com">
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="form-label">Password</label>
                        <input type="password" name="password" required class="form-input" placeholder="Min. 8 karakter">
                        @error('password')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">Ulangi Password</label>
                        <input type="password" name="password_confirmation" required class="form-input" placeholder="Ulangi">
                    </div>
                </div>

                <div>
                    <label class="form-label">No. Handphone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required class="form-input" placeholder="08xxxxxxxxxx">
                    @error('phone')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="2" required class="form-input" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                    @error('alamat')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn-primary w-full">Daftar Sekarang</button>
            </form>
        </div>

        <p class="text-center text-sm text-neutral-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-500 transition-colors">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection
