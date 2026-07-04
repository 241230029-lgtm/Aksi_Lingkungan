<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    // Nama tabel
    protected $table = 'pendaftarans';

    // Primary key sesuai migration
    protected $primaryKey = 'id_pendaftaran';

    // Primary key bertipe integer dan auto increment
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'kegiatan_id',
        'user_id',
        'alasan_bergabung',
        'status_konfirmasi',
    ];

    /**
     * Relasi ke User
     * Satu pendaftaran dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Kegiatan
     * Satu pendaftaran dimiliki oleh satu kegiatan.
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id_kegiatan');
    }
}