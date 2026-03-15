<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LamanMelayu extends Model
{
    protected $table = 'laman_melayu';

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
