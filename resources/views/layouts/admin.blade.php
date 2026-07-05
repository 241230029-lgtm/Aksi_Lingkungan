<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Aksi Lingkungan</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    @include('layouts.partials.sidebar')

    <div class="flex-1">

        <header class="bg-white shadow px-8 py-5 flex justify-between">

            <h1 class="text-2xl font-bold">

                Dashboard Admin

            </h1>

            <div class="flex items-center gap-4">

                🔔

                <div class="w-10 h-10 rounded-full bg-green-500"></div>

            </div>

        </header>

        <main class="p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>