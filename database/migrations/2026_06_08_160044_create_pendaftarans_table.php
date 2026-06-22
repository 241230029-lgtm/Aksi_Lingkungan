<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('pendaftarans', function (Blueprint $table) {
        $table->id('id_pendaftaran');

        // Menghubungkan pendaftaran ke ID Kegiatan terkait
        $table->foreignId('id_kegiatan')->constrained('kegiatans', 'id_kegiatan')->onDelete('cascade');

        // KUNCI PENGAMAN: Menghubungkan ke ID User yang mendaftar
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        // REVISI BARU: Kolom penampung alasan bergabung sesuai instruksi dosen
        $table->text('alasan_bergabung');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
