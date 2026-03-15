<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WartaBasa extends Model
{
    protected $table = 'warta_basa';

    protected $fillable = [
        'judul',
        'slug',
        'penulis',
        'konten',
        'foto',
        'is_published',
        'views',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'views' => 'integer',
    ];
}
