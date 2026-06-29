<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    // Nama tabel
    protected $table = 'kegiatans';

    // Primary key sesuai migration
    protected $primaryKey = 'id_kegiatan';

    // Primary key bertipe integer dan auto increment
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'deskripsi',
        'lokasi',
        'tanggal_kejadian',
        'kuota_relawan',
        'link_kontak',
        'gambar',
        'status',
    ];

    /**
     * Relasi ke User
     * Satu kegiatan dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Pendaftaran
     * Satu kegiatan memiliki banyak pendaftaran relawan.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'kegiatan_id', 'id_kegiatan');
    }
}