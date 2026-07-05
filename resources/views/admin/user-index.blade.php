@extends('layouts.admin')

@section('content')

@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2 text-sm shadow-sm animate-fade-in">
    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span>{{ session('success') }}</span>
</div>
@endif

<div class="pb-6 mb-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen User</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola, pantau, dan verifikasi seluruh hak akses pengguna aplikasi Aksi Lingkungan.</p>
    </div>
    <div>
        <button onclick="openModal('modalTambahUser')" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition duration-150 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah User Baru
        </button>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pengguna</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ count($users ?? []) ?: 10 }}</h3>
        </div>
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">User Aktif</p>
            <h3 class="text-3xl font-extrabold text-emerald-600 mt-1">{{ count($users ?? []) ?: 10 }}</h3>
        </div>
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Sesi Hari Ini</p>
            <h3 class="text-3xl font-extrabold text-blue-600 mt-1">1</h3>
        </div>
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
    </div>
</div>

<div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
    <div class="w-full md:w-80 relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </span>
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama user..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 focus:border-green-500 focus:bg-white text-sm rounded-xl focus:outline-none transition duration-150">
    </div>
    <div class="flex items-center gap-2 text-xs font-medium text-gray-400 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
        <span>Menampilkan seluruh pengguna dengan Role: Masyarakat (Klik nama untuk melihat detail)</span>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap" id="userTable">
            <thead>
                <tr class="bg-gray-50/70 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3.5 px-6 w-16 text-center">No</th>
                    <th class="py-3.5 px-6">Identitas Pengguna</th>
                    <th class="py-3.5 px-6">Role</th>
                    <th class="py-3.5 px-6 text-center">Status</th>
                    <th class="py-3.5 px-6 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @php $nomorNyata = 1; @endphp

                @if(isset($users) && count($users) > 0)
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50/50 transition duration-150 table-row-data">
                            <td class="py-4 px-6 text-center font-medium text-gray-400 target-no">{{ $nomorNyata++ }}</td>

                            <td class="py-4 px-6 font-bold text-gray-900 target-name">
                                <div onclick="openDetailModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->phone ?? 'Belum diisi' }}', '{{ $user->alamat ?? 'Belum diisi' }}')" class="flex items-center gap-3 cursor-pointer group">
                                    <div class="w-8 h-8 bg-gray-100 group-hover:bg-green-100 group-hover:text-green-700 rounded-full flex items-center justify-center font-bold text-gray-600 uppercase text-xs transition">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span class="group-hover:text-green-600 group-hover:underline decoration-2 transition">{{ $user->name }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                    Masyarakat
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span> Aktif
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->phone ?? '' }}', '{{ $user->alamat ?? '' }}')" title="Edit User" class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition duration-150 cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button onclick="triggerDeleteData('{{ $user->id }}')" title="Hapus User" class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg flex items-center justify-center transition duration-150 cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($nomorNyata == 1)
                    @for ($i = 1; $i <= 3; $i++)
                    <tr id="dummy-row-{{ $i }}" class="hover:bg-gray-50/50 transition duration-150 table-row-data">
                        <td class="py-4 px-6 text-center font-medium text-gray-400 target-no">{{ $i }}</td>
                        <td class="py-4 px-6 font-bold text-gray-900 target-name">
                            <div onclick="openDetailModal('dummy-{{ $i }}', 'Budi Santoso {{ $i }}', '0812345678{{ $i }}', 'Jl. Contoh Tiruan No. {{ $i }}')" class="flex items-center gap-3 cursor-pointer group">
                                <div class="w-8 h-8 bg-green-50 group-hover:bg-green-100 group-hover:text-green-700 text-green-700 rounded-full flex items-center justify-center font-bold text-xs transition">BS</div>
                                <span class="group-hover:text-green-600 group-hover:underline decoration-2 transition">Budi Santoso {{ $i }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6"><span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">Masyarakat</span></td>
                        <td class="py-4 px-6 text-center"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700"><span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span> Aktif</span></td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEditModal('dummy-{{ $i }}', 'Budi Santoso {{ $i }}', '0812345678{{ $i }}', 'Jl. Contoh Tiruan No. {{ $i }}')" class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition duration-150 cursor-pointer"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                <button onclick="deleteDummyRow('dummy-row-{{ $i }}')" class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg flex items-center justify-center transition duration-150 cursor-pointer"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                @endif
            </tbody>
        </table>
    </div>
</div>

<div id="modalDetailUser" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl relative transform transition duration-200 scale-95">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
            <h3 class="text-xl font-bold text-gray-900">Detail Informasi Pengguna</h3>
            <button onclick="closeModal('modalDetailUser')" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="space-y-4">
            <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                <div id="detailAvatar" class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg uppercase">--</div>
                <div>
                    <h4 id="detailTextName" class="font-bold text-gray-900 text-base">--</h4>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100">Masyarakat / Relawan</span>
                </div>
            </div>

            <div class="space-y-3 pt-2">
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">No. WhatsApp / HP</span>
                    <p id="detailTextPhone" class="text-sm font-semibold text-gray-800 mt-0.5">--</p>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Alamat Domisili / Tinggal</span>
                    <p id="detailTextAlamat" class="text-sm font-semibold text-gray-800 mt-0.5">--</p>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Status Hak Akses</span>
                    <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 mt-1">
                        <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span> Terverifikasi Aktif
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
            <button type="button" onclick="closeModal('modalDetailUser')" class="px-4 py-2 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition cursor-pointer">Tutup</button>
            <button type="button" id="btnDetailToEdit" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow transition cursor-pointer">Ubah Data</button>
        </div>
    </div>
</div>

<div id="modalTambahUser" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl relative transform transition duration-200 scale-95">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Tambah User Baru</h3>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Masukkan nama warganya..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">No. WhatsApp / HP</label>
                    <input type="tel" name="phone" required placeholder="Contoh: 08123456789" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat Tinggal</label>
                    <input type="text" name="alamat" required placeholder="Contoh: Jl. Ahmad Yani No. 45" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" onclick="closeModal('modalTambahUser')" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50 rounded-xl transition cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 rounded-xl shadow transition cursor-pointer">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditUser" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl relative transform transition duration-200 scale-95">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Ubah Informasi Pengguna</h3>

        <form id="formEditUser" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="editUserName" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">No. WhatsApp / HP</label>
                    <input type="tel" name="phone" id="editUserPhone" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat Tinggal</label>
                    <input type="text" name="alamat" id="editUserAlamat" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" onclick="closeModal('modalEditUser')" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50 rounded-xl transition cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow transition cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<form id="deleteRealUserForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Penanganan khusus tutup modal agar aman jika user memakai dummy data
    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function openDetailModal(id, name, phone, alamat) {
        document.getElementById('detailAvatar').innerText = name.substring(0, 2).toUpperCase();
        document.getElementById('detailTextName').innerText = name;
        document.getElementById('detailTextPhone').innerText = phone;
        document.getElementById('detailTextAlamat').innerText = alamat;

        document.getElementById('btnDetailToEdit').onclick = function() {
            closeModal('modalDetailUser');
            openEditModal(id, name, phone, alamat);
        };
        openModal('modalDetailUser');
    }

    // FIX: Fungsi ini sekarang mengatur action URL form secara dinamis mengarah ke ID user target
    function openEditModal(id, name, phone, alamat) {
        document.getElementById('editUserName').value = name;
        document.getElementById('editUserPhone').value = phone;
        document.getElementById('editUserAlamat').value = alamat;

        if(id.startsWith('dummy')) {
            document.getElementById('formEditUser').onsubmit = function(e) {
                e.preventDefault();
                closeModal('modalEditUser');
                alert('Simulasi Sukses! Perubahan data tiruan disimpan.');
            };
        } else {
            document.getElementById('formEditUser').removeAttribute('onsubmit');
            document.getElementById('formEditUser').action = `/admin/users/update/${id}`;
        }
        openModal('modalEditUser');
    }

    function deleteDummyRow(rowId) {
        if(confirm('Yakin ingin menghapus pengguna simulasi ini?')) {
            document.getElementById(rowId).remove();
            reorderTableNumbers();
        }
    }

    function triggerDeleteData(id) {
        if(confirm('Peringatan: Yakin ingin menghapus user asli ini secara permanen dari database?')) {
            const form = document.getElementById('deleteRealUserForm');
            form.action = `/admin/users/${id}`;
            form.submit();
        }
    }

    function reorderTableNumbers() {
        document.querySelectorAll('.target-no').forEach((td, index) => {
            td.innerText = index + 1;
        });
    }

    function filterTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('.table-row-data').forEach(row => {
            const name = row.querySelector('.target-name').innerText.toLowerCase();
            row.style.display = name.includes(input) ? '' : 'none';
        });
    }
</script>

@endsection
