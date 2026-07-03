@extends('layouts.app')

@section('content')
<div class="bg-white rounded-2xl shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold">
            Aktivitas Saya
        </h2>

        <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
            + Buat Aksi
        </button>
    </div>

    <div class="space-y-4">

        <div class="border rounded-xl p-5 flex justify-between items-center">

            <div>
                <h3 class="font-bold">
                    Penanaman Pohon
                </h3>

                <p class="text-gray-500">
                    2 Juli 2026
                </p>
            </div>

            <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full">
                Dipublikasikan
            </span>

        </div>

        <div class="border rounded-xl p-5 flex justify-between items-center">

            <div>
                <h3 class="font-bold">
                    Bersih Sungai
                </h3>

                <p class="text-gray-500">
                    20 Juni 2026
                </p>
            </div>

            <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full">
                Menunggu
            </span>

        </div>

    </div>

</div>
@endsection