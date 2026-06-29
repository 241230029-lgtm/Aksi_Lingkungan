<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {

            $table->id('id_pendaftaran');

            // Relasi ke tabel kegiatans
            $table->foreignId('kegiatan_id')
                ->constrained('kegiatans', 'id_kegiatan')
                ->onDelete('cascade');

            // Relasi ke tabel users
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Alasan mengikuti kegiatan
            $table->text('alasan_bergabung');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};