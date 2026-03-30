<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tulisan extends Model
{
    protected $table = 'tulisans';

    protected $fillable = [
    'judul',
    'slug',
    'isi',
    'gambar',
    'kategori'
];

protected $casts = [
    'created_at' => 'datetime'
];

}