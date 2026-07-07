<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Aksi Lingkungan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

        @include('layouts.partials.sidebar')

        <div class="flex-1 flex flex-col">

<header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between sticky top-0 z-10 border-b border-gray-100">
    <div>
        <p class="text-sm text-gray-400">Selamat datang,</p>
        <h2 class="text-sm font-bold text-gray-800">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</h2>
    </div>
    <div class="flex items-center gap-4">
        <div class="text-right hidden sm:block">
            <p class="text-xs font-bold text-gray-800">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</p>
            <p class="text-[10px] text-gray-400">Administrator</p>
        </div>
        <div class="w-9 h-9 bg-green-100 rounded-full flex items-center justify-center text-green-700 text-sm font-bold">
            {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'A' }}
        </div>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-xs font-semibold text-red-500 hover:text-red-700 cursor-pointer">Logout</button>
        </form>
    </div>
</header>            <main class="flex-1 p-8">
                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')

</body>
</html>
