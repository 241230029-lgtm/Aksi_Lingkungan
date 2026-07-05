<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aksi Lingkungan') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- Navbar Guest --}}
    @include('layouts.partials.guest-navbar')

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Login Modal --}}
    @include('components.login-modal')

    {{-- Footer --}}
    @include('layouts.partials.footer')

    {{-- Javascript Modal Login --}}
    <script>

        function openLoginModal() {

            const modal = document.getElementById('loginModal');

            modal.classList.remove('hidden');

            modal.classList.add('flex');

        }

        function closeLoginModal() {

            const modal = document.getElementById('loginModal');

            modal.classList.remove('flex');

            modal.classList.add('hidden');

        }

    </script>

</body>

</html>
