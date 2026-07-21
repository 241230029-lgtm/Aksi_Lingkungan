<div id="sidebarOverlay" onclick="toggleSidebar()" class="hidden fixed inset-0 bg-slate-950/50 z-30 lg:hidden"></div>
<aside id="adminSidebar" class="w-72 bg-gradient-to-b from-slate-900 to-slate-800 text-white min-h-screen flex flex-col fixed lg:static inset-y-0 left-0 z-40 -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="p-8 border-b border-white/10 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold flex items-center gap-2">
                <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3C6 3 3 7 3 11c0 5 4 9 9 10 1-5 1-9 5-13 2-2 4-3 4-3s-1 6-5 8c-2 1-3 1-3 1"/>
                </svg>
                Admin
            </h2>
            <p class="text-emerald-300 text-sm mt-1">Aksi Lingkungan</p>
        </div>
        <button onclick="toggleSidebar()" class="lg:hidden p-1.5 rounded-lg hover:bg-white/10 text-slate-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <nav class="flex-1 py-4 px-3 space-y-1 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-5 py-3 rounded-xl text-base font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500/20 text-emerald-300 shadow-sm border border-emerald-400/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h4v8H3v-8zm7-7h4v15h-4V6zm7 4h4v11h-4V10z"/></svg>
            Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-5 py-3 rounded-xl text-base font-medium transition {{ request()->routeIs('admin.users') ? 'bg-emerald-500/20 text-emerald-300 shadow-sm border border-emerald-400/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            User
        </a>
        <a href="{{ route('admin.kegiatan') }}" class="flex items-center gap-3 px-5 py-3 rounded-xl text-base font-medium transition {{ request()->routeIs('admin.kegiatan') ? 'bg-emerald-500/20 text-emerald-300 shadow-sm border border-emerald-400/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            Kegiatan
        </a>
        <a href="{{ route('admin.information') }}" class="flex items-center gap-3 px-5 py-3 rounded-xl text-base font-medium transition {{ request()->routeIs('admin.information') ? 'bg-emerald-500/20 text-emerald-300 shadow-sm border border-emerald-400/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Informasi
        </a>
        <a href="{{ route('admin.sharing') }}" class="flex items-center gap-3 px-5 py-3 rounded-xl text-base font-medium transition {{ request()->routeIs('admin.sharing') ? 'bg-emerald-500/20 text-emerald-300 shadow-sm border border-emerald-400/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            Sharing
        </a>
        <a href="{{ route('admin.volunteer') }}" class="flex items-center gap-3 px-5 py-3 rounded-xl text-base font-medium transition {{ request()->routeIs('admin.volunteer') ? 'bg-emerald-500/20 text-emerald-300 shadow-sm border border-emerald-400/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/></svg>
            Volunteer
        </a>
    </nav>
</aside>
<script>
function toggleSidebar() {
    document.getElementById('adminSidebar').classList.toggle('-translate-x-full');
    document.getElementById('sidebarOverlay').classList.toggle('hidden');
}
</script>