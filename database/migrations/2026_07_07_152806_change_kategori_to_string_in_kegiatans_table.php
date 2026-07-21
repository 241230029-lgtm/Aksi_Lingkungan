<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE kegiatans MODIFY COLUMN kategori VARCHAR(255) NOT NULL");
        }
        // SQLite tidak punya tipe ENUM sungguhan (kolom disimpan sebagai teks tanpa
        // constraint), jadi kolom kategori sudah otomatis berperilaku seperti string.
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE kegiatans MODIFY COLUMN kategori ENUM('Eco-Sharing', 'Eco-Information', 'Eco-Volunteer') NOT NULL");
        }
    }
};