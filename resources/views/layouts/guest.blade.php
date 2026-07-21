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
        document.addEventListener('turbo:load', () => {
            document.body.classList.add('page-ready');
        });
    </script>
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

    {{-- Javascript Modal Login & Register --}}
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

        function openRegisterModal() {
            const modal = document.getElementById('registerModal');
            if(modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeRegisterModal() {
            const modal = document.getElementById('registerModal');
            if(modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>

</html>