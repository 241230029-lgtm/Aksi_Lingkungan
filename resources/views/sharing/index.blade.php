@extends('layouts.app')

@section('content')

<div class="container">

    <div class="hero">
        <h1>🌱 Eco Sharing</h1>
        <p>Temukan berbagai kegiatan dan inspirasi menjaga lingkungan.</p>
    </div>

    <div class="search-box">

        <input type="text" placeholder="Cari kegiatan...">

        <select>
            <option>Semua Kategori</option>
            <option>Penghijauan</option>
            <option>Daur Ulang</option>
            <option>Bank Sampah</option>
        </select>

        <select>
            <option>Semua Lokasi</option>
            <option>Pontianak</option>
            <option>Kubu Raya</option>
            <option>Singkawang</option>
        </select>

        <button>Cari</button>

    </div>

</div>

@endsection