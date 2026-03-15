@extends('public.layout.app')

@section('title', 'Koleksi Cerpen — Serindit')
@section('description', 'Cerita-cerita pendek berlatar budaya Melayu Riau. Panduan penulisan cerpen dan koleksi cerpen pilihan.')

@section('styles')
<style>
    .genre-hero {
        background: linear-gradient(135deg, #0b2d6b 0%, #0e6db5 60%, #3b82f6 100%);
        position: relative; overflow: hidden;
    }
    .genre-hero::before {
        content: ''; position: absolute; inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 32px 32px; pointer-events: none;
    }
    .genre-hero-wave { overflow: hidden; line-height: 0; }
    .genre-hero-wave svg { display: block; width: 100%; }

    .breadcrumb-chip {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
    }
    .cerpen-card {
        border-left: 4px solid #0e6db5;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .cerpen-card:hover { box-shadow: 0 12px 32px rgba(14,109,181,0.12); transform: translateY(-3px); }

    .guide-step {
        counter-increment: guide-counter;
        position: relative;
    }
    .guide-step::before {
        content: counter(guide-counter);
        position: absolute; left: 0; top: 0;
        width: 32px; height: 32px;
        background: linear-gradient(135deg, #0e6db5, #3b82f6);
        color: white; font-weight: 800; font-size: 13px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
    }
    .guide-list { counter-reset: guide-counter; }

    .tag-chip { background: #dbeafe; color: #0e6db5; }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="genre-hero pt-20 pb-0">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10 pb-16 relative z-10">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 mb-8" data-aos="fade-right">
            <a href="{{ route('static.jejak_pena') }}" class="breadcrumb-chip px-3 py-1.5 rounded-full text-white/70 text-xs font-medium hover:text-white transition flex items-center gap-1.5">
                <i class="bi bi-feather"></i> Jejak Pena
            </a>
            <i class="bi bi-chevron-right text-white/30 text-xs"></i>
            <span class="text-white/90 text-xs font-bold px-3 py-1.5 bg-white/15 rounded-full">Cerpen</span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-end gap-8">
            <div class="flex-1">
                <span class="inline-flex items-center gap-2 bg-blue-400/20 text-blue-200 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6 border border-blue-400/30" data-aos="fade-up">
                    <i class="bi bi-book"></i> Cerita Pendek
                </span>
                <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-4" style="font-family:'Playfair Display',serif;" data-aos="fade-up" data-aos-delay="100">
                    Koleksi <span class="text-brand-yellow">Cerpen</span>
                </h1>
                <p class="text-white/70 text-lg max-w-xl leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    Kisah-kisah pendek bergaya Melayu yang kaya makna, sarat budaya, dan menyentuh hati pembaca.
                </p>
            </div>
            <div class="flex gap-4 flex-shrink-0" data-aos="fade-left" data-aos-delay="200">
                <div class="text-center bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                    <div class="text-3xl font-bold text-brand-yellow">3</div>
                    <div class="text-white/60 text-xs font-medium mt-1">Contoh Karya</div>
                </div>
                <div class="text-center bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                    <div class="text-3xl font-bold text-brand-yellow">6</div>
                    <div class="text-white/60 text-xs font-medium mt-1">Panduan Menulis</div>
                </div>
            </div>
        </div>
    </div>
    <div class="genre-hero-wave">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,0 1080,80 1440,30 L1440,60 L0,60 Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- Main Content --}}
<section class="py-16 bg-white">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- LEFT: Panduan --}}
            <div class="lg:col-span-1 order-2 lg:order-1">
                <div class="sticky top-28">
                    <div class="bg-gradient-to-br from-blue-50 to-sky-50 rounded-2xl p-6 border border-blue-100 mb-6" data-aos="fade-right">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="bi bi-lightbulb text-blue-600"></i> Panduan Menulis Cerpen
                        </h3>
                        <ol class="guide-list space-y-4">
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Tentukan Premis Cerita</strong><br>
                                Satu kalimat inti yang merangkum keseluruhan cerita.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Bangun Tokoh yang Hidup</strong><br>
                                Beri tokoh utama sifat, keinginan, dan konflik internal.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Tentukan Latar dengan Jelas</strong><br>
                                Waktu, tempat, dan suasana yang mendukung cerita.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Bangun Konflik yang Menarik</strong><br>
                                Tanpa konflik tidak ada cerita. Buat yang relatable.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Tulis Opening yang Kuat</strong><br>
                                Kalimat pertama harus langsung menarik pembaca masuk.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Akhiri dengan Berkesan</strong><br>
                                Ending yang logis, mengejutkan, atau meninggalkan kesan.
                            </li>
                        </ol>
                    </div>

                    {{-- Struktur Cerpen --}}
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" data-aos="fade-right" data-aos-delay="100">
                        <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="bi bi-diagram-3 text-blue-600"></i> Struktur Cerpen
                        </h3>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl">
                                <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                                <div>
                                    <p class="text-xs font-bold text-blue-800">Orientasi</p>
                                    <p class="text-xs text-gray-500">Perkenalan tokoh & latar</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl">
                                <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                                <div>
                                    <p class="text-xs font-bold text-blue-800">Komplikasi</p>
                                    <p class="text-xs text-gray-500">Konflik mulai berkembang</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl">
                                <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                                <div>
                                    <p class="text-xs font-bold text-blue-800">Klimaks</p>
                                    <p class="text-xs text-gray-500">Puncak ketegangan</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl">
                                <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                                <div>
                                    <p class="text-xs font-bold text-blue-800">Resolusi</p>
                                    <p class="text-xs text-gray-500">Penyelesaian masalah & penutup</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Cerpen --}}
            <div class="lg:col-span-2 order-1 lg:order-2 space-y-8">
                <div data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-1 w-8 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full"></div>
                        <h2 class="text-lg font-bold text-gray-800">Contoh Karya Pilihan</h2>
                    </div>
                </div>

                {{-- Cerpen 1 --}}
                <article class="cerpen-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Perahu Kertas di Sungai Kenangan</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penulis Riau · <span class="text-blue-600">±800 kata</span></p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Budaya Melayu</span>
                    </div>
                    <div class="text-gray-700 leading-relaxed text-sm space-y-4">
                        <p>Setiap sore, Mak Cik Rohani duduk di tepi sungai itu. Tangannya yang keriput selalu memegang selembar kertas—kertas yang akan segera ia lipat menjadi perahu kecil, lalu dilepas ke arus yang tenang.</p>
                        <p>"Untuk siapa perahu itu, Mak Cik?" tanya Amir, bocah tujuh tahun yang selalu menemaninya.</p>
                        <p>Mak Cik Rohani tersenyum. Kerut di wajahnya seolah menyimpan ribuan cerita. "Untuk abangmu yang jauh di rantau, Nak. Kata orang, kalau kita kirim doa lewat air yang mengalir, ia akan sampai ke mana saja hati bermukim."</p>
                        <p>Amir memandang perahu kertas itu berlayar pelan, berputar dua kali sebelum akhirnya menepi di balik akar pohon nipah. Ia tidak mengerti sepenuhnya, tapi ada perasaan hangat yang menjalari dadanya—perasaan bahwa cinta bisa berjalan tanpa kaki, terbang tanpa sayap.</p>
                        <p class="italic text-gray-500 border-l-4 border-blue-200 pl-4">Sungai itu mengalir deras di musim hujan, tapi Mak Cik Rohani selalu datang. Karena katanya, "Air yang deras pun tak mampu menghapus rindu yang dalam."</p>
                    </div>
                    <div class="mt-5 pt-5 border-t border-gray-100 flex flex-wrap gap-2">
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Rindu</span>
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Tradisi</span>
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Melayu</span>
                    </div>
                </article>

                {{-- Cerpen 2 --}}
                <article class="cerpen-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Gelang Perak Nenek</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penulis Riau · <span class="text-blue-600">±700 kata</span></p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Kehidupan</span>
                    </div>
                    <div class="text-gray-700 leading-relaxed text-sm space-y-4">
                        <p>Gelang perak itu selalu ada di pergelangan tangan Nenek. Tidak pernah dilepas sejak hari pernikahan, lima puluh tahun yang lalu. Hingga suatu pagi yang redup, Nenek memanggilku ke sisi ranjangnya.</p>
                        <p>"Putri, gelang ini bukan sekadar perhiasan," katanya dengan suara yang sudah mulai goyah. "Di sini tersimpan janji yang paling sakral antara aku dan kakekmu—bahwa dalam susah dan senang, kita tidak akan pernah meninggalkan satu sama lain."</p>
                        <p>Aku menggenggam tangan Nenek erat. Gelang itu dingin di sentuhanku, tapi ada kehangatan yang tak bisa kujelaskan memancar dari sana.</p>
                        <p class="italic text-gray-500 border-l-4 border-blue-200 pl-4">"Sekarang giliran kamu yang menjaganya, Putri. Jadilah perempuan yang teguh seperti perak ini—dipanaskan pun tidak melebur, dihantam pun tidak retak."</p>
                    </div>
                    <div class="mt-5 pt-5 border-t border-gray-100 flex flex-wrap gap-2">
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Keluarga</span>
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Warisan</span>
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Emosional</span>
                    </div>
                </article>

                {{-- Cerpen 3 --}}
                <article class="cerpen-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Pedagang Kain di Pasar Pagi</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penulis Riau · <span class="text-blue-600">±600 kata</span></p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Sosial</span>
                    </div>
                    <div class="text-gray-700 leading-relaxed text-sm space-y-4">
                        <p>Pak Daud membuka lapaknya sebelum ayam berkokok. Kain-kain songket dan tenun Melayu ia tata dengan penuh cinta, seolah setiap lembar adalah bagian dari dirinya sendiri.</p>
                        <p>"Ini bukan sekadar kain, Bu," ujarnya kepada seorang pembeli yang menawar terlalu murah. "Di setiap benangnya ada keringat penenun dari Siak sana. Mereka bekerja berbulan-bulan untuk ini."</p>
                        <p>Pembeli itu terdiam. Lalu perlahan, ia mengulurkan uang sesuai harga yang diminta—bahkan sedikit lebih.</p>
                        <p class="italic text-gray-500 border-l-4 border-blue-200 pl-4">Ada hal-hal di dunia ini yang tidak bisa dinilai semata dengan angka. Dan Pak Daud, dengan lapak sederhana dan kata-kata yang tulus, selalu berhasil mengingatkan orang tentang itu.</p>
                    </div>
                    <div class="mt-5 pt-5 border-t border-gray-100 flex flex-wrap gap-2">
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Ekonomi</span>
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Budaya</span>
                        <span class="tag-chip text-[11px] px-2.5 py-1 rounded-full font-medium">Melayu</span>
                    </div>
                </article>

                {{-- Back Button --}}
                <div class="pt-4" data-aos="fade-up">
                    <a href="{{ route('static.jejak_pena') }}" class="inline-flex items-center gap-2 text-blue-600 font-bold text-sm hover:gap-3 transition-all">
                        <i class="bi bi-arrow-left"></i> Kembali ke Jejak Pena
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
