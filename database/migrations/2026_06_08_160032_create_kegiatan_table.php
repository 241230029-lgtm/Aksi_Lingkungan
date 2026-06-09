<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            // Menampung kategori: barang (sharing), informasi (mading), event (relawan)
            $table->enum('type', ['barang', 'informasi', 'event']);
            $table->text('description');
            $table->string('location'); // Skala Kecamatan
            $table->text('contact_link'); // Link WA/Telegram
            $table->string('image')->nullable();
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
