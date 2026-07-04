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

    <main>
        @yield('content')
    </main>

</body>
</html>