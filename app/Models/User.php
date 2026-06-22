<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password', 'role'])] // Tambah 'role' untuk membedakan Admin & Masyarakat
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * RELASI ELOQUENT: One to Many
     * Artinya: 1 User (Masyarakat) bisa membuat atau memposting BANYAK Kegiatan/Aksi lingkungan.
     */
    public function kegiatans(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'user_id');
    }

    /**
     * RELASI ELOQUENT: One to Many
     * Artinya: 1 User (Masyarakat) bisa mendaftar BANYAK kali di berbagai aksi relawan yang berbeda.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'user_id');
    }
}
