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
        'jenis',
        'deskripsi',
        'lokasi',
        'tanggal_kejadian',
        'kuota_relawan',
        'link_kontak',
        'gambar',
        'file',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'kegiatan_id', 'id_kegiatan');
    }
    public function detailRoute()
    {
        return route('katalog.show', $this->id_kegiatan);
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