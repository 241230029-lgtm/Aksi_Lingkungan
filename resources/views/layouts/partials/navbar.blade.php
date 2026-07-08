<nav class="bg-white/95 backdrop-blur shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 bg-gradient-to-br from-green-500 to-green-700 rounded-full flex items-center justify-center text-white text-xl shadow-sm group-hover:scale-105 transition">
                    🌿
                </div>
                <div>
                    <h1 class="font-extrabold text-lg text-green-700 leading-none">AKSI</h1>
                    <p class="text-[10px] text-gray-400 tracking-[0.2em] mt-0.5">LINGKUNGAN</p>
                </div>
            </a>

            <!-- Menu -->
            <div class="hidden lg:flex items-center gap-1 text-gray-600 font-medium text-sm">

                @if(session('role') == 'admin')

                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.users') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Pengguna</a>
                    <a href="{{ route('admin.kegiatan') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.kegiatan') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Kegiatan</a>
                    <a href="{{ route('admin.information') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.information') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Informasi</a>
                    <a href="{{ route('admin.sharing') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.sharing') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Sharing</a>
                    <a href="{{ route('admin.volunteer') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.volunteer') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Relawan</a>

                @else

                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('dashboard') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Dashboard</a>
                    <a href="{{ route('katalog') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('katalog') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Katalog</a>
                    <a href="{{ route('buat-aksi') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('buat-aksi') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Buat Aksi</a>
                    <a href="{{ route('tentang') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('tentang') ? 'bg-green-50 text-green-700 font-semibold' : 'hover:bg-gray-50 hover:text-green-600' }}">Tentang</a>

                @endif

            </div>

            <!-- Right -->
            <div class="flex items-center gap-4">

                @if(session('role') == 'user')
                <button class="relative p-2 rounded-full hover:bg-gray-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0h6z" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 bg-red-500 w-2.5 h-2.5 rounded-full ring-2 ring-white"></span>
                </button>
                @endif

                <!-- Profile -->
                <div class="flex items-center gap-3 pl-3 border-l border-gray-100">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(session('name')) }}&background=16a34a&color=fff" class="w-10 h-10 rounded-full ring-2 ring-green-100">
                    <div class="hidden md:block">
                        <h3 class="font-semibold text-sm text-gray-800 leading-tight">{{ session('name') }}</h3>
                        <p class="text-xs text-gray-400">{{ auth()->check() ? auth()->user()->name : 'Pengguna' }}</p>
                    </div>
                </div>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-red-50 hover:bg-red-500 text-red-500 hover:text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>