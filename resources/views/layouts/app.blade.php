<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aksi Lingkungan') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.4/dist/turbo.es2017-umd.min.js"></script>

    <style>
        body { opacity: 0; }
        body.page-ready { opacity: 1; animation: pageFadeIn .3s ease forwards; }
        @keyframes pageFadeIn { from { opacity:0; transform: translateY(6px); } to { opacity:1; transform: translateY(0); } }
    </style>
    <script>
        // jalan tiap kali Turbo selesai render halaman (termasuk navigasi awal)
        document.addEventListener('turbo:load', () => {
            document.body.classList.add('page-ready');
        });
    </script>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @stack('scripts')

</body>
</html>