@extends('layouts.app')
@section('content')

<section class="bg-gradient-to-br from-emerald-700 to-slate-900 py-14 sm:py-24">
<div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
    <span class="bg-white/15 text-white px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase">Tentang Kami</span>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mt-5">Tentang Aksi Lingkungan</h1>
    <p class="text-emerald-100 mt-5 max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">
        Platform digital yang menghubungkan masyarakat untuk menjaga lingkungan melalui aksi nyata, edukasi, dan kolaborasi.
    </p>
</div>
</section>

<section class="py-12 sm:py-20 bg-slate-50">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid lg:grid-cols-2 gap-6 sm:gap-8">

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 sm:p-10">
        <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Visi</h2>
        <p class="mt-4 text-slate-600 leading-7 sm:leading-8">
            Mewujudkan masyarakat yang peduli terhadap lingkungan melalui teknologi digital.
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 sm:p-10">
        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-6">
            <svg class="w-7 h-7 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Misi</h2>
        <ul class="mt-5 space-y-3 text-slate-600">
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Edukasi lingkungan.
            </li>
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Mempermudah aksi sosial.
            </li>
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Menghubungkan relawan.
            </li>
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Menyediakan informasi lingkungan.
            </li>
        </ul>
    </div>

</div>
</div>
</section>
@endsection