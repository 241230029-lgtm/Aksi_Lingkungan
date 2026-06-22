<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('kegiatans', function (Blueprint $table) {
        // Menggunakan id_kegiatan sebagai Primary Key sesuai ERD
        $table->id('id_kegiatan');

        // Foreign Key menghubungkan ke tabel users (id_masyarakat diganti user_id agar aman dengan Auth bawaan Laravel)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        $table->string('judul');
        $table->enum('kategori', ['Eco-Sharing', 'Eco-Information', 'Eco-Volunteer']);
        $table->text('deskripsi');
        $table->string('lokasi');

        // REVISI BARU: Menambahkan kolom penampung kuota dan tanggal
        $table->dateTime('tanggal_kejadian')->nullable();
        $table->integer('kuota_relawan')->nullable();

        $table->string('link_kontak')->nullable(); // Untuk link WA Eco-Sharing
        $table->string('gambar')->nullable();
        $table->enum('status', ['aktif', 'selesai'])->default('aktif');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
