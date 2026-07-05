<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $blueprint) {
            // Menambahkan kolom role dengan nilai bawaan 'user' (Masyarakat)
            $blueprint->string('role')->default('user')->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $blueprint) {
            $blueprint->dropColumn('role');
        });
    }
};
