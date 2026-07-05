<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sharing extends Model
{
    use HasFactory;

    // Paksa model menggunakan nama tabel tunggal/jamak yang sesuai di database
    protected $table = 'sharings';

    protected $fillable = ['judul', 'kategori', 'deskripsi', 'pembuat'];
}
