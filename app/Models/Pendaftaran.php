<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    // Menghubungkan ke tabel 'pendaftarans' yang ada di phpMyAdmin Anda
    protected $table = 'pendaftarans';

    // Sesuaikan field ini dengan struktur kolom yang ada di tabel pendaftarans kelompok Anda
    protected $fillable = [
        'nama_program',
        'kategori',
        'lokasi',
        'kuota',
        'deskripsi',
        'syarat'
    ];
}
