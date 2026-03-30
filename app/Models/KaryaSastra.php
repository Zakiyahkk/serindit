<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KaryaSastra extends Model
{
    protected $table = 'karya_sastra';

    protected $fillable = [
        'tipe', 'judul', 'slug', 'penulis', 'deskripsi',
        'jenis', 'tema', 'durasi_baca',
        'konten', 'makna', 'metadata',
        'is_published', 'sort_order',
    ];

    protected $casts = [
        'konten'       => 'array',
        'metadata'     => 'array',
        'is_published' => 'boolean',
    ];

    // ── Scopes ──────────────────────────────────
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('sort_order')->orderBy('id');
    }

    public function scopeOfType($query, string $tipe)
    {
        return $query->where('tipe', $tipe);
    }

    // ── Accessors ───────────────────────────────
    /** Ambil majas dari metadata (khusus puisi) */
    public function getMajasAttribute(): array
    {
        return $this->metadata['majas'] ?? [];
    }

    /** Ambil tema tags dari metadata (khusus cerpen) */
    public function getTemaTagsAttribute(): array
    {
        return $this->metadata['tema'] ?? [];
    }

    // ── Auto-slug ───────────────────────────────
    protected static function booted(): void
    {
        static::creating(function ($karya) {
            if (empty($karya->slug)) {
                $karya->slug = Str::slug($karya->judul);
            }
        });
    }
}
