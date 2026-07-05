<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';
    protected $primaryKey = 'id_kegiatan';
    public $incrementing = true;
    protected $keyType = 'int';

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'kegiatan_id', 'id_kegiatan');
    }

    public function detailRoute()
    {
        return match($this->kategori) {
            'Eco-Volunteer' => route('volunteer.show', $this->id_kegiatan),
            'Eco-Sharing' => route('sharing.show', $this->id_kegiatan),
            'Eco-Information' => route('information.show', $this->id_kegiatan),
            default => '#',
        };
    }

    public function getKategoriLabelAttribute()
    {
        return match($this->kategori) {
            'Eco-Volunteer' => 'Relawan',
            'Eco-Sharing' => 'Sharing',
            'Eco-Information' => 'Informasi',
            default => $this->kategori,
        };
    }
}