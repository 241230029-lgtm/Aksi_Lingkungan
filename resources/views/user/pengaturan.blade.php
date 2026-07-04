@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow p-6">

    <h2 class="text-3xl font-bold mb-6">
        Pengaturan Akun
    </h2>

    <form class="space-y-5">

        <div>

            <label>Password Baru</label>

            <input
                type="password"
                class="w-full border rounded-lg p-3 mt-2">

        </div>

        <div>

            <label>Konfirmasi Password</label>

            <input
                type="password"
                class="w-full border rounded-lg p-3 mt-2">

        </div>

        <button
            class="bg-green-600 text-white px-6 py-3 rounded-lg">

            Simpan

        </button>

    </form>

</div>

@endsection