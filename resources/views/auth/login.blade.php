@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-100 to-green-50">

    <div class="bg-white shadow-2xl rounded-3xl overflow-hidden max-w-5xl w-full grid md:grid-cols-2">

        <!-- Bagian Kiri -->
        <div class="bg-green-600 text-white p-10 flex flex-col justify-center">

            <h1 class="text-4xl font-bold mb-4">
                Selamat Datang 👋
            </h1>

            <p class="text-green-100 leading-8">
                Masuk untuk mengakses Dashboard Aksi Lingkungan dan ikut berkontribusi menjaga lingkungan.
            </p>

            <img
                src="https://images.unsplash.com/photo-1492496913980-501348b61469?w=900"
                alt="Aksi Lingkungan"
                class="mt-10 rounded-2xl object-cover h-72">

        </div>

        <!-- Bagian Kanan -->
        <div class="p-10 flex flex-col justify-center">

            <h2 class="text-3xl font-bold text-center text-green-700 mb-8">
                Login
            </h2>

            @if(session('success'))
                <div class="mb-5 p-4 bg-green-100 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 p-4 bg-red-100 text-red-700 rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">

                    <label for="email" class="block font-semibold mb-2">
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="Masukkan email"
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">

                </div>

                <!-- Password -->
                <div class="mb-5">

                    <label for="password" class="block font-semibold mb-2">
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder="Masukkan password"
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">

                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">

                    <label class="flex items-center">

                        <input
                            type="checkbox"
                            name="remember"
                            class="mr-2">

                        Ingat Saya

                    </label>

                    <a href="#" class="text-green-600 hover:underline">
                        Lupa Password?
                    </a>

                </div>

                <!-- Tombol Login -->
                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl transition">

                    Login

                </button>

            </form>

            <p class="text-center mt-6">

                Belum punya akun?

                <a href="{{ route('register') }}"
                    class="text-green-600 font-semibold hover:underline">

                    Register

                </a>

            </p>

        </div>

    </div>

</div>

@endsection
