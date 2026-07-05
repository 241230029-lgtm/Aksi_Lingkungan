@extends('layouts.app')

@section('content')

<section class="bg-green-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-5xl font-bold">Katalog Aksi Lingkungan</h1>
        <p class="mt-4 text-lg text-green-100">Temukan berbagai aksi lingkungan yang dapat kamu ikuti.</p>
    </div>
</section>

<section class="py-10 bg-gray-100">
<div class="max-w-7xl mx-auto px-6">
<div class="bg-white rounded-2xl shadow p-6">
<form method="GET" action="{{ route('katalog') }}" class="grid lg:grid-cols-4 gap-4">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari aksi..." class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
    <select name="kategori" class="border rounded-xl px-4 py-3">
        <option value="semua">Semua Kategori</option>
        <option value="Eco-Volunteer" {{ request('kategori') == 'Eco-Volunteer' ? 'selected' : '' }}>Relawan</option>
        <option value="Eco-Sharing" {{ request('kategori') == 'Eco-Sharing' ? 'selected' : '' }}>Sharing</option>
        <option value="Eco-Information" {{ request('kategori') == 'Eco-Information' ? 'selected' : '' }}>Informasi</option>
    </select>
    <select name="lokasi" class="border rounded-xl px-4 py-3">
        <option value="semua">Semua Lokasi</option>
        @foreach($lokasiList as $lokasi)
        <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>{{ $lokasi }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-green-600 text-white rounded-xl hover:bg-green-700">Cari</button>
</form>
</div>
</div>
</section>

<section class="py-16">
<div class="max-w-7xl mx-auto px-6">

@if($items->isEmpty())
    <div class="bg-white rounded-2xl shadow p-10 text-center">
        <p class="text-gray-500 text-lg">Tidak ada aksi yang ditemukan.</p>
    </div>
@else
<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">
    @foreach($items as $item)
    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">
        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=900' }}" class="h-60 w-full object-cover">
        <div class="p-6">
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">{{ $item->kategori_label }}</span>
            <h2 class="text-2xl font-bold mt-4">{{ $item->judul }}</h2>
            <p class="text-gray-500 mt-3">{{ Str::limit($item->deskripsi, 100) }}</p>
            <div class="flex justify-between items-center mt-6">
                <div>
                    <p class="text-sm text-gray-500">📍 {{ $item->lokasi }}</p>
                    <p class="text-sm text-gray-500">📅 {{ $item->created_at->format('d M Y') }}</p>
                </div>
                <a href="{{ $item->detailRoute() }}" class="bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700">Detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-10 flex justify-center">
    {{ $items->links() }}
</div>

@endif

</div>
</section>

@endsection
