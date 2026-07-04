@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow p-8 text-center">

    <h2 class="text-3xl font-bold mb-4">
        Logout
    </h2>

    <p class="text-gray-500">
        Apakah Anda yakin ingin keluar?
    </p>

    <div class="mt-8 flex justify-center gap-4">

        <button
            class="bg-gray-300 px-6 py-3 rounded-lg">

            Batal

        </button>

        <button
            class="bg-red-600 text-white px-6 py-3 rounded-lg">

            Logout

        </button>

    </div>

</div>

@endsection