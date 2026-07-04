@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <section class="bg-green-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold">
                Dashboard
            </h1>

            <p class="mt-2 text-green-100">
                Selamat datang kembali 👋
            </p>
        </div>
    </section>

    <!-- Statistik -->
    <section class="max-w-7xl mx-auto px-6 -mt-8">

        <div class="grid md:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-gray-500">Total Aksi</h3>
                <h2 class="text-4xl font-bold text-green-600 mt-3">12</h2>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-gray-500">Volunteer</h3>
                <h2 class="text-4xl font-bold text-blue-600 mt-3">8</h2>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-gray-500">Artikel</h3>
                <h2 class="text-4xl font-bold text-yellow-500 mt-3">15</h2>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-gray-500">Sharing</h3>
                <h2 class="text-4xl font-bold text-purple-600 mt-3">5</h2>
            </div>

        </div>

    </section>

    <!-- Aktivitas -->
    <section class="max-w-7xl mx-auto px-6 mt-10">

        <div class="bg-white rounded-2xl shadow-lg">

            <div class="p-6 border-b">

                <h2 class="text-2xl font-bold">

                    Aktivitas Terbaru

                </h2>

            </div>

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left p-4">Judul</th>

                        <th>Status</th>

                        <th>Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                    @for($i=1;$i<=6;$i++)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4">

                            Gerakan Bersih Sungai

                        </td>

                        <td>

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                Selesai

                            </span>

                        </td>

                        <td>

                            10 Juni 2026

                        </td>

                    </tr>

                    @endfor

                </tbody>

            </table>

        </div>

    </section>

</div>

@endsection