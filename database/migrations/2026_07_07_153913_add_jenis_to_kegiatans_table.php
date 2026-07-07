<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('jenis')->nullable()->after('kategori');
        });

        // Isi otomatis kolom jenis untuk data lama berdasarkan kategori yang masih ada
        DB::statement("UPDATE kegiatans SET jenis = CASE
            WHEN kategori = 'Eco-Volunteer' THEN 'Volunteer'
            WHEN kategori = 'Eco-Sharing' THEN 'Sharing'
            WHEN kategori = 'Eco-Information' THEN 'Informasi'
            ELSE 'Informasi'
        END");

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('jenis')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
};