# Aplikasi "Aksi Lingkungan"

Aplikasi **Aksi Lingkungan** adalah platform mading digital terpusat berbasis kecamatan yang dirancang untuk mengatasi kendala koordinasi dan penyebaran informasi gerakan pelestarian lingkungan lokal. Proyek ini dikembangkan menggunakan framework **Laravel** dan **Tailwind CSS** sebagai bagian dari pemenuhan tugas Project-Based Learning (PjBL).

---

## 3 Fitur Utama (Core Features)

1. ** Eco-Sharing (Manajemen Logistik Hijau)** Fasilitas bagi warga untuk mengunggah dan mencari logistik ramah lingkungan secara gratis (seperti bibit tanaman, pupuk organik, pot bekas) yang terhubung langsung ke kontak penyedia (WhatsApp/Telegram) untuk sistem COD di luar aplikasi.

2. ** Eco-Information (Papan Informasi Agenda)** Mading digital satu arah khusus untuk publikasi pengumuman valid dari pengurus lingkungan (jadwal kerja bakti, pengumuman fogging, sosialisasi pilah sampah) agar informasi penting tidak tenggelam di grup chat warga.

3. ** Eco-Volunteer (Mobilisasi Relawan)** Fitur pembuatan event lingkungan yang dilengkapi dengan tombol pendaftaran dinamis untuk membantu komunitas hijau mendata warga yang berkomitmen menjadi relawan aksi nyata di lapangan tanpa kertas.

---

##  Ruang Lingkup Sistem (Scope)
* **Skala Wilayah:** Pembatasan akses data inputan dikunci pada tingkat **Kecamatan** agar informasi tetap relevan bagi warga lokal.
* **Autentikasi Akun:** Sistem membedakan hak akses halaman publik (Katalog & Detail) dengan halaman privat input data (**Dashboard Warga**).

---

##  Struktur Tim & Pembagian Tugas
* **Product Manager (PM):** Mengelola arsitektur data, *user flow*, dan struktur repositori.
* **Frontend Team:** Melakukan *slicing* UI responsive menggunakan Tailwind CSS berdasarkan spesifikasi komponen halaman katalog, detail, dan form input.
* **Backend Team:** Mengimplementasikan database relasional MySQL (Tabel `users`, `posts`, dan *pivot* `registrations`) serta mengurus logika fungsi CRUD pada framework Laravel.

---
*Proyek ini dikembangkan secara kolaboratif demi mewujudkan lingkungan tingkat lokal yang lebih hijau, bersih, dan terorganisir.*
