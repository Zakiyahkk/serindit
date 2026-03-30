<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Naskah extends Model
{
    use HasFactory;

    protected $table = 'naskah';

    protected $fillable = [
        'judul',
        'penulis',
        'email',
        'jenis',
        'status',
        'sinopsis',
        'isi_naskah',
        'file_naskah',
        'jumlah_halaman',
        'catatan_penolakan',
        'catatan_admin',
        'tanggal_kirim',
        'tanggal_review',
    ];

    protected $casts = [
        'tanggal_kirim'  => 'datetime',
        'tanggal_review' => 'datetime',
    ];

    // ─── Scopes ───────────────────────────────────────────────────────────────

    public function scopeMenunggu($query)
    {
        return $query->where('status', 'Menunggu');
    }

    public function scopeDisetujui($query)
    {
        return $query->where('status', 'Disetujui');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'Ditolak');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    public function getBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'Disetujui' => 'success',
            'Ditolak'   => 'danger',
            default     => 'warning',
        };
    }

    public function getJenisBadgeColorAttribute(): string
    {
        return match ($this->jenis) {
            'Cerpen'  => 'red',
            'Puisi'   => 'purple',
            'Pantun'  => 'blue',
            'Esai'    => 'indigo',
            'Novel'   => 'pink',
            'Artikel' => 'teal',
            default   => 'gray',
        };
    }

    public function getTanggalKirimFormatAttribute(): string
    {
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $tgl = $this->tanggal_kirim;

        return $tgl->day . ' ' . $bulan[$tgl->month] . ' ' . $tgl->year;
    }
}