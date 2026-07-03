@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-100 to-green-50">

    <div class="bg-white shadow-2xl rounded-3xl overflow-hidden max-w-5xl w-full grid md:grid-cols-2">

        <!-- Kiri -->
        <div class="bg-green-600 text-white p-10 flex flex-col justify-center">

            <h1 class="text-4xl font-bold mb-4">
                Selamat Datang 👋
            </h1>

            <p class="text-green-100 leading-8">
                Masuk untuk mengakses Dashboard Aksi Lingkungan dan ikut berkontribusi menjaga lingkungan.
            </p>

            <img src="https://images.unsplash.com/photo-1492496913980-501348b61469?w=900"
                class="mt-10 rounded-2xl">

        </div>

        <!-- Kanan -->
        <div class="p-10">

            <h2 class="text-3xl font-bold mb-8 text-center">
                Login
            </h2>

            <form method="POST" action="#">
                @csrf

                <div class="mb-5">
                    <label class="font-semibold">Email</label>

                    <input
                        type="email"
                        class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500"
                        placeholder="email@gmail.com">
                </div>

                <div class="mb-5">

                    <label class="font-semibold">

                        Password

                    </label>

                    <input
                        type="password"
                        class="mt-2 w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500"
                        placeholder="********">

                </div>

                <button
                    class="w-full bg-green-600 text-white py-3 rounded-xl hover:bg-green-700">

                    Login

                </button>

            </form>

            <p class="text-center mt-6">

                Belum punya akun?

                <a href="{{ route('register') }}"
                    class="text-green-600 font-semibold">

                    Register

                </a>

            </p>

        </div>

    </div>

</div>

@endsection