<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sharing extends Model
{
    protected $table = 'sharings';

    protected $fillable = [
        'user_id',
        'judul',
        'cerita',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}