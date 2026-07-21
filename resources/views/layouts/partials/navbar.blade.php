<nav class="bg-white/95 backdrop-blur shadow-sm sticky top-0 z-50 border-b border-slate-100">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center justify-between h-16 sm:h-20">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group min-w-0">
        <div class="w-9 h-9 sm:w-11 sm:h-11 shrink-0 bg-gradient-to-br from-emerald-500 to-slate-800 rounded-full flex items-center justify-center text-white shadow-sm group-hover:scale-105 transition">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3C6 3 3 7 3 11c0 5 4 9 9 10 1-5 1-9 5-13 2-2 4-3 4-3s-1 6-5 8c-2 1-3 1-3 1"/>
            </svg>
        </div>
        <div class="min-w-0">
            <h1 class="font-extrabold text-base sm:text-lg text-slate-800 leading-none">AKSI</h1>
            <p class="text-[9px] sm:text-[10px] text-emerald-600 tracking-[0.2em] mt-0.5 font-semibold">LINGKUNGAN</p>
        </div>
    </a>
    <div class="hidden lg:flex items-center gap-1 text-slate-600 font-medium text-sm">
        @if(session('role') == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Dashboard</a>
            <a href="{{ route('admin.users') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.users') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Pengguna</a>
            <a href="{{ route('admin.kegiatan') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.kegiatan') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Kegiatan</a>
            <a href="{{ route('admin.information') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.information') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Informasi</a>
            <a href="{{ route('admin.sharing') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.sharing') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Sharing</a>
            <a href="{{ route('admin.volunteer') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('admin.volunteer') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Relawan</a>
        @else
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Dashboard</a>
            <a href="{{ route('katalog') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('katalog') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Katalog</a>
            <a href="{{ route('buat-aksi') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('buat-aksi') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Buat Aksi</a>
            <a href="{{ route('tentang') }}" class="px-4 py-2 rounded-xl transition {{ request()->routeIs('tentang') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'hover:bg-slate-50 hover:text-emerald-600' }}">Tentang</a>
        @endif
    </div>
    <div class="flex items-center gap-1.5 sm:gap-2 lg:gap-4">
        @if(session('role') == 'user')
        <button class="relative p-2 rounded-full hover:bg-slate-50 transition hidden sm:block">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-500 hover:text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0h6z" />
            </svg>
            <span class="absolute top-1.5 right-1.5 bg-red-500 w-2.5 h-2.5 rounded-full ring-2 ring-white"></span>
        </button>
        @endif
        <a href="{{ route('profile.index') }}" class="flex items-center gap-2 sm:gap-3 pl-0 sm:pl-3 sm:border-l border-slate-100 hover:opacity-85 transition group">
            @if(auth()->check() && auth()->user()->photo)
                <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full object-cover ring-2 ring-emerald-100 group-hover:scale-105 transition">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(session('name')) }}&background=10b981&color=fff" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full ring-2 ring-emerald-100 group-hover:scale-105 transition">
            @endif
            <div class="hidden md:block">
                <h3 class="font-semibold text-sm text-slate-800 leading-tight group-hover:text-emerald-600 transition">{{ session('name') }}</h3>
                <p class="text-xs text-slate-400">{{ session('role') == 'admin' ? 'Administrator' : 'Pengguna' }}</p>
            </div>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="hidden sm:block" data-turbo="false">
            @csrf
            <button class="bg-red-50 hover:bg-red-500 text-red-500 hover:text-white px-3 lg:px-4 py-2.5 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span class="hidden lg:inline">Logout</span>
            </button>
        </form>
        <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-xl hover:bg-slate-50 text-slate-600 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
</div>
<div id="mobileMenu" class="hidden lg:hidden pb-4 space-y-1 border-t border-slate-100 pt-3">
    @if(session('role') == 'admin')
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Dashboard</a>
        <a href="{{ route('admin.users') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.users') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Pengguna</a>
        <a href="{{ route('admin.kegiatan') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.kegiatan') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Kegiatan</a>
        <a href="{{ route('admin.information') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.information') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Informasi</a>
        <a href="{{ route('admin.sharing') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.sharing') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Sharing</a>
        <a href="{{ route('admin.volunteer') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.volunteer') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Relawan</a>
    @else
        <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Dashboard</a>
        <a href="{{ route('katalog') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('katalog') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Katalog</a>
        <a href="{{ route('buat-aksi') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('buat-aksi') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Buat Aksi</a>
        <a href="{{ route('tentang') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('tentang') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Tentang</a>
    @endif
    <form action="{{ route('logout') }}" method="POST" class="sm:hidden pt-2" data-turbo="false">
        @csrf
        <button class="w-full bg-red-50 hover:bg-red-500 text-red-500 hover:text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Logout
        </button>
    </form>
</div>
</div>
</nav>
<script>
function toggleMobileMenu() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
}
</script>