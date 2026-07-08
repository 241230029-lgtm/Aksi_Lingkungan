<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aksi Lingkungan') }}</title>
    <style>body{opacity:0;transition:opacity .2s}</style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>document.addEventListener("DOMContentLoaded",()=>{document.body.style.opacity="1"})</script>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

</body>
</html>
