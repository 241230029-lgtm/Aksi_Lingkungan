<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Perluas enum dulu supaya nilai lama & baru bisa hidup berdampingan sementara
        DB::statement("ALTER TABLE kegiatans MODIFY COLUMN status ENUM('aktif', 'selesai', 'akan_datang', 'terlaksana') NOT NULL DEFAULT 'aktif'");

        // 2. Migrasikan data lama: 'aktif' -> 'akan_datang'
        DB::table('kegiatans')->where('status', 'aktif')->update(['status' => 'akan_datang']);

        // 3. Baru persempit enum ke daftar final
        DB::statement("ALTER TABLE kegiatans MODIFY COLUMN status ENUM('akan_datang', 'terlaksana', 'selesai') NOT NULL DEFAULT 'akan_datang'");

        // 4. Tambah kolom file dokumen (opsional, di samping kolom gambar yang sudah ada)
        Schema::table('kegiatans', function ($table) {
            $table->string('file')->nullable()->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function ($table) {
            $table->dropColumn('file');
        });

        DB::statement("ALTER TABLE kegiatans MODIFY COLUMN status ENUM('aktif', 'selesai', 'akan_datang', 'terlaksana') NOT NULL DEFAULT 'aktif'");
        DB::table('kegiatans')->where('status', 'akan_datang')->update(['status' => 'aktif']);
        DB::table('kegiatans')->where('status', 'terlaksana')->update(['status' => 'aktif']);
        DB::statement("ALTER TABLE kegiatans MODIFY COLUMN status ENUM('aktif', 'selesai') NOT NULL DEFAULT 'aktif'");
    }
};