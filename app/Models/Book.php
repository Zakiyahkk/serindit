<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',

        'volume',
        'nomor',
        'terbitan',
        'issn',

        'cover_image',
        'pdf_file',

        'table_of_contents',
        'page_offset',
    ];

    /**
     * Cast JSON column
     */
    protected $casts = [
        'table_of_contents' => 'array',
    ];

    /**
     * Statistik buku (views, likes, reads).
     */
    public function stat(): HasOne
    {
        return $this->hasOne(BookStat::class);
    }

    /**
     * Kategori buku (many-to-many).
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    /**
     * Jenis buku (many-to-many).
     */
    public function bookTypes(): BelongsToMany
    {
        return $this->belongsToMany(BookType::class, 'book_book_type');
    }

    /**
     * URL cover image.
     */
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : null;
    }

    /**
     * URL file PDF.
     */
    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf_file
            ? asset('storage/' . $this->pdf_file)
            : null;
    }
}
