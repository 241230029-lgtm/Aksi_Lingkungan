@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-green-50">

<div class="bg-white rounded-3xl shadow-2xl p-10 w-full max-w-xl">

<h1 class="text-3xl font-bold text-center mb-8">

Daftar Akun

</h1>

<form>

<div class="mb-5">

<label>Nama Lengkap</label>

<input
type="text"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<div class="mb-5">

<label>Email</label>

<input
type="email"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<div class="mb-5">

<label>Password</label>

<input
type="password"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<div class="mb-5">

<label>Konfirmasi Password</label>

<input
type="password"
class="mt-2 w-full border rounded-xl px-4 py-3">

</div>

<button
class="w-full bg-green-600 text-white py-3 rounded-xl">

Daftar

</button>

</form>

<p class="text-center mt-6">

Sudah punya akun?

<a href="{{ route('login') }}"
class="text-green-600">

Login

</a>

</p>

</div>

</div>

@endsection