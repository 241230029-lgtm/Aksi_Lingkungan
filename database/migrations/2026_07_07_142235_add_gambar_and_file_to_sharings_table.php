<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sharings', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('pembuat');
            $table->string('file')->nullable()->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('sharings', function (Blueprint $table) {
            $table->dropColumn(['gambar', 'file']);
        });
    }
};