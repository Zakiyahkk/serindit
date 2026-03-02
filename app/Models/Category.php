<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Buku-buku dalam kategori ini (many-to-many).
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_categories');
    }
}
