<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Aksi Lingkungan</title>
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
    @stack('styles')
</head>
<body class="bg-slate-50">
    <div class="flex min-h-screen">
        @include('layouts.partials.sidebar')
        <div class="flex-1 flex flex-col min-w-0">
<header class="bg-white shadow-sm px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between sticky top-0 z-10 border-b border-slate-100">
    <div class="flex items-center gap-3 min-w-0">
        <button onclick="toggleSidebar()" class="lg:hidden shrink-0 p-2 rounded-lg hover:bg-slate-100 text-slate-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div class="min-w-0">
            <p class="text-sm text-slate-400 hidden sm:block">Selamat datang,</p>
            <h2 class="text-sm font-bold text-slate-800 truncate">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</h2>
        </div>
    </div>
    <div class="flex items-center gap-2 sm:gap-4 shrink-0">
        <div class="text-right hidden sm:block">
            <p class="text-xs font-bold text-slate-800">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</p>
            <p class="text-[10px] text-slate-400">Administrator</p>
        </div>
        <div class="w-9 h-9 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 text-sm font-bold ring-2 ring-emerald-500/20 shrink-0">
            {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'A' }}
        </div>
        <form action="{{ route('logout') }}" method="POST" class="inline" data-turbo="false">
            @csrf
            <button type="submit" class="text-xs font-semibold text-red-500 hover:text-red-700 cursor-pointer whitespace-nowrap">Logout</button>
        </form>
    </div>
</header>            <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>