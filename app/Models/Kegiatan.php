<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    // Mengunci nama tabel di database agar sinkron
    protected $table = 'kegiatans';

    // Mendaftarkan kolom-kolom yang boleh diisi data (Mass Assignment)
    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'deskripsi',
        'lokasi',
        'tanggal',
        'kuota',
        'status'
    ];

    /**
     * RELASI ELOQUENT: Belongs To (Kebalikan dari One to Many)
     * Artinya: 1 Kegiatan/Aksi ini dibuat atau dimiliki oleh 1 User/Masyarakat.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * RELASI ELOQUENT: One to Many
     * Artinya: 1 Kegiatan (khusus kategori Eco-Volunteer) bisa memiliki BANYAK pendaftar relawan.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'kegiatan_id');
    }
}
