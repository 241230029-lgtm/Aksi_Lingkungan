<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    // Mengunci nama tabel di database agar sinkron
    protected $table = 'pendaftarans';

    // Mendaftarkan kolom-kolom yang boleh diisi data
    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'alasan_bergabung',
        'status_konfirmasi'
    ];

    /**
     * RELASI ELOQUENT: Belongs To
     * Artinya: 1 lembar data pendaftaran ini mutlak milik 1 User (Masyarakat yang mendaftar).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * RELASI ELOQUENT: Belongs To
     * Artinya: 1 lembar data pendaftaran ini ditujukan untuk 1 Kegiatan/Aksi lingkungan tertentu.
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
