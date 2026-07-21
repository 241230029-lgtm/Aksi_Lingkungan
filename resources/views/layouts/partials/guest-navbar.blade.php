<nav class="bg-white/95 backdrop-blur shadow-sm sticky top-0 z-50 border-b border-slate-100">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center justify-between h-16 sm:h-20">
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
        <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl hover:bg-slate-50 hover:text-emerald-600 transition">Beranda</a>
        <a href="#tentang" class="px-4 py-2 rounded-xl hover:bg-slate-50 hover:text-emerald-600 transition">Tentang</a>
    </div>
    <div class="flex items-center gap-2">
        <button type="button" onclick="openLoginModal()" class="hidden sm:inline-flex bg-emerald-600 hover:bg-emerald-700 text-white px-5 lg:px-6 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm">
            Masuk
        </button>
        <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-xl hover:bg-slate-50 text-slate-600 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
</div>
<div id="mobileMenu" class="hidden lg:hidden pb-4 space-y-1 border-t border-slate-100 pt-3">
    <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50">Beranda</a>
    <a href="#tentang" class="block px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50">Tentang</a>
    <button type="button" onclick="openLoginModal()" class="w-full mt-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition">
        Masuk
    </button>
</div>
</div>
</nav>
<script>
function toggleMobileMenu() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
}
</script>