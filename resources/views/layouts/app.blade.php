<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Aksi Lingkungan</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            🌱 EcoPlatform
        </div>

        <ul class="menu">
            <li><a href="/">Beranda</a></li>
            <li><a href="/sharing">Eco Sharing</a></li>
            <li><a href="#">Kegiatan</a></li>
            <li><a href="#">Tentang</a></li>
        </ul>
    </nav>

    <title>{{ config('app.name', 'Aksi Lingkungan') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

</body>
</html>
