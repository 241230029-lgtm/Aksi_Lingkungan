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
        $table->id();
        // Menghubungkan ke tabel users (warga)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        // Menghubungkan ke tabel kegiatans (acara kerja bakti)
        $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
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
