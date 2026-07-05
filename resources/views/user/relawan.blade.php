@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow p-6">

    <h2 class="text-3xl font-bold mb-6">
        Relawan Saya
    </h2>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="border rounded-xl p-5">

            <h3 class="font-bold text-xl">
                Bersih Pantai
            </h3>

            <p class="text-gray-500">
                Status : Terdaftar
            </p>

            <button class="mt-5 bg-green-600 text-white px-5 py-2 rounded-lg">
                Detail
            </button>

        </div>

        <div class="border rounded-xl p-5">

            <h3 class="font-bold text-xl">
                Penanaman Mangrove
            </h3>

            <p class="text-gray-500">
                Status : Terdaftar
            </p>

            <button class="mt-5 bg-green-600 text-white px-5 py-2 rounded-lg">
                Detail
            </button>

        </div>

    </div>

</div>

@endsection