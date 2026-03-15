<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karya_sastra', function (Blueprint $table) {
            $table->id();

            // Jenis karya: puisi | cerpen | pantun | syair
            $table->enum('tipe', ['puisi', 'cerpen', 'pantun', 'syair']);

            // Info dasar
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('penulis')->default('Penulis Riau');
            $table->text('deskripsi')->nullable();

            // Metadata tergantung tipe
            // Puisi  : jenis (Puisi Lirik, Naratif, dll)
            // Cerpen : genre (Tradisi & Budaya, Keluarga, dll), durasi_baca
            // Pantun : tema (Nasihat, Cinta, dsb)
            // Syair  : tema (Nasihat, Patriotik, dsb)
            $table->string('jenis')->nullable();   // untuk puisi & cerpen
            $table->string('tema')->nullable();     // untuk pantun & syair
            $table->string('durasi_baca')->nullable(); // untuk cerpen

            // Konten utama (struktur berbeda per tipe, stored as JSON):
            // Puisi  : [["Baris 1", "Baris 2"], ["Baris 3", "Baris 4"], ...]  (array of bait)
            // Cerpen : ["Paragraf 1", "Paragraf 2", ...]
            // Pantun : ["Baris 1", "Baris 2", "Baris 3", "Baris 4"]
            // Syair  : [["Baris 1","Baris 2","Baris 3","Baris 4"], [...]] (array of bait)
            $table->json('konten');

            // Penjelasan / makna / pesan moral
            $table->text('makna')->nullable();

            // Metadata tambahan (JSON):
            // Puisi  : {"majas": ["Personifikasi", "Metafora"]}
            // Cerpen : {"tema": ["Keluarga", "Tradisi"]}
            // Pantun : {}
            // Syair  : {}
            $table->json('metadata')->nullable();

            // Status & urutan
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya_sastra');
    }
};
