@extends('public.layout.app')

@section('title', 'Jejak Pena — Serindit')
@section('description', 'Eksplorasi karya sastra Melayu Riau: Puisi, Cerpen, Pantun, dan Syair terbaik dari para penulis Riau.')

@section('styles')
<style>
    /* ── Hero Gradient ── */
    .jp-hero {
        background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 55%, #27AE60 100%);
        position: relative;
        overflow: hidden;
    }
    .jp-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 36px 36px;
        pointer-events: none;
    }
    .jp-hero::after {
        content: '';
        position: absolute;
        top: -200px; right: -200px;
        width: 700px; height: 700px;
        background: radial-gradient(circle, rgba(245,166,35,0.08) 0%, transparent 65%);
        border-radius: 50%;
        pointer-events: none;
    }
    .jp-hero-blob {
        position: absolute;
        bottom: -150px; left: -100px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(102,234,128,0.07) 0%, transparent 60%);
        border-radius: 50%;
        pointer-events: none;
    }

    /* ── Feather Floating ── */
    .feather-float {
        animation: featherFloat 6s ease-in-out infinite;
    }
    @keyframes featherFloat {
        0%, 100% { transform: translateY(0px) rotate(-5deg); }
        33%       { transform: translateY(-18px) rotate(2deg); }
        66%       { transform: translateY(-8px) rotate(-8deg); }
    }

    /* ── Card Category ── */
    .cat-card {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        cursor: pointer;
    }
    .cat-card::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 0;
    }
    .cat-card:hover {
        transform: translateY(-10px) scale(1.01);
        box-shadow: 0 28px 56px rgba(11,61,10,0.18), 0 0 0 1px rgba(30,123,28,0.12);
    }
    .cat-card:hover::before { opacity: 1; }

    .cat-card .card-icon-wrap {
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .cat-card:hover .card-icon-wrap {
        transform: scale(1.15) rotate(-5deg);
    }
    .cat-card .card-arrow {
        transition: transform 0.3s ease, opacity 0.3s ease;
        opacity: 0;
        transform: translateX(-8px);
    }
    .cat-card:hover .card-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    /* Card accent lines */
    .cat-card .card-accent {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
        border-radius: 0 0 20px 20px;
    }
    .cat-card:hover .card-accent { transform: scaleX(1); }

    /* ── Shimmer badge ── */
    .shimmer-badge {
        background: linear-gradient(90deg, #F5A623 0%, #ffd500 50%, #F5A623 100%);
        background-size: 200%;
        animation: shimmer 2.5s linear infinite;
    }
    @keyframes shimmer {
        0%   { background-position: 200% center; }
        100% { background-position: -200% center; }
    }

    /* ── Quote block ── */
    .jp-quote {
        border-left: 4px solid #1e7b1c;
        background: linear-gradient(90deg, rgba(30,123,28,0.06), transparent);
    }

    /* ── Stats pill ── */
    .stat-pill {
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.2);
    }

    /* card colors */
    .card-puisi   { --card-color: #1e7b1c; --card-light: #dcfce7; --card-mid: rgba(30,123,28,0.1); }
    .card-cerpen  { --card-color: #0e6db5; --card-light: #dbeafe; --card-mid: rgba(14,109,181,0.1); }
    .card-pantun  { --card-color: #9333ea; --card-light: #f3e8ff; --card-mid: rgba(147,51,234,0.1); }
    .card-syair   { --card-color: #e8621e; --card-light: #ffedd5; --card-mid: rgba(232,98,30,0.1); }

    .cat-card::before { background: var(--card-mid); }
    .cat-card .card-accent { background: var(--card-color); }
    .cat-card .card-tag { background: var(--card-light); color: var(--card-color); }
    .cat-card .card-badge { border-color: var(--card-color); color: var(--card-color); }
    .cat-card .card-btn { background: var(--card-color); }
    .cat-card .card-icon-bg { background: linear-gradient(135deg, var(--card-light), rgba(255,255,255,0.5)); }
    .cat-card .card-icon { color: var(--card-color); }
</style>
@endsection

@section('content')

{{-- ══════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════ --}}
<section class="jp-hero py-24 md:py-32 relative">
    <div class="jp-hero-blob"></div>
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10 relative z-10">
        <div class="max-w-2xl">
            {{-- Label --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white/80 text-xs font-bold uppercase tracking-widest mb-8" data-aos="fade-right">
                <i class="bi bi-feather text-brand-yellow"></i>
                Karya Sastra Melayu Riau
            </div>

            {{-- Heading --}}
            <h1 class="text-white font-serif font-bold leading-tight mb-6 text-5xl md:text-6xl" style="font-family:'Playfair Display',serif;" data-aos="fade-right" data-aos-delay="100">
                Jejak <span class="text-brand-yellow">Pena</span>
            </h1>

            <p class="text-white/70 text-lg leading-relaxed mb-10 max-w-xl" data-aos="fade-right" data-aos-delay="200">
                Temukan keindahan karya sastra Melayu — dari lirik puisi yang mengalun, kisah cerpen yang menyentuh, hingga rangkaian pantun dan syair yang sarat makna.
            </p>

            {{-- Stats pills --}}
            <div class="flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-pill px-4 py-2 rounded-full flex items-center gap-2 text-white text-sm font-medium">
                    <i class="bi bi-book-half text-brand-yellow"></i>
                    4 Genre Sastra
                </div>
                <div class="stat-pill px-4 py-2 rounded-full flex items-center gap-2 text-white text-sm font-medium">
                    <i class="bi bi-people text-brand-yellow"></i>
                    Karya Penulis Riau
                </div>
                <div class="stat-pill px-4 py-2 rounded-full flex items-center gap-2 text-white text-sm font-medium">
                    <i class="bi bi-stars text-brand-yellow"></i>
                    Sastra Melayu Asli
                </div>
            </div>
        </div>

        {{-- Floating feather icon --}}
        <div class="absolute right-10 top-8 hidden lg:block feather-float" data-aos="zoom-in" data-aos-delay="400">
            <div class="relative">
                <div class="w-48 h-48 rounded-full bg-white/5 border border-white/10 flex items-center justify-center">
                    <div class="w-32 h-32 rounded-full bg-white/8 border border-white/15 flex items-center justify-center">
                        <i class="bi bi-feather text-7xl text-white/30"></i>
                    </div>
                </div>
                <div class="absolute -top-3 -right-3 w-12 h-12 rounded-full shimmer-badge flex items-center justify-center shadow-lg">
                    <i class="bi bi-stars text-white text-base"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave bottom --}}
    <div class="wave-divider absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,0 1080,80 1440,30 L1440,60 L0,60 Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- ══════════════════════════════════════════
     CARD SECTION
══════════════════════════════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10">

        {{-- Heading --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="section-label bg-green-50 text-brand-blue mx-auto">
                <i class="bi bi-grid-3x2-gap"></i> Pilih Genre
            </div>
            <h2 class="section-title text-3xl md:text-4xl mt-3">Jelajahi Karya Sastra</h2>
            <div class="section-divider mx-auto mt-3"></div>
            <p class="text-gray-500 mt-5 max-w-xl mx-auto">Pilih genre yang ingin Anda baca dan pelajari. Setiap genre memiliki keunikan dan keindahan tersendiri.</p>
        </div>

        {{-- 4 Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Card 1: Puisi --}}
            <a href="{{ route('static.puisi') }}" class="cat-card card-puisi bg-white rounded-[22px] border border-gray-100 shadow-sm p-7 flex flex-col h-full group no-underline" data-aos="fade-up" data-aos-delay="0">
                <div class="card-accent"></div>

                {{-- Icon --}}
                <div class="card-icon-wrap w-16 h-16 card-icon-bg rounded-2xl flex items-center justify-center mb-5 shadow-sm">
                    <i class="bi bi-journal-text card-icon text-3xl"></i>
                </div>

                {{-- Tag --}}
                <span class="card-tag text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full self-start mb-4">Puisi</span>

                {{-- Title --}}
                <h3 class="text-gray-900 font-bold text-xl font-serif mb-3" style="font-family:'Playfair Display',serif;">Koleksi Puisi</h3>

                <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                    Bait-bait puisi yang penuh metafora, rasa, dan keindahan bahasa. Ungkapan jiwa para penyair Riau yang mengalir bebas.
                </p>

                {{-- Format Guide Preview --}}
                <div class="bg-gray-50 rounded-xl p-3 mb-5 border border-gray-100">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Struktur Dasar</p>
                    <p class="text-xs text-gray-600 font-mono leading-relaxed">Baris bebas · Rima bebas<br>Imaji · Diksi · Metafora</p>
                </div>

                {{-- CTA --}}
                <div class="flex items-center gap-2 text-sm font-bold mt-auto" style="color: var(--card-color)">
                    Baca Selengkapnya
                    <i class="bi bi-arrow-right card-arrow"></i>
                </div>
            </a>

            {{-- Card 2: Cerpen --}}
            <a href="{{ route('static.cerpen') }}" class="cat-card card-cerpen bg-white rounded-[22px] border border-gray-100 shadow-sm p-7 flex flex-col h-full group no-underline" data-aos="fade-up" data-aos-delay="100">
                <div class="card-accent"></div>

                {{-- Icon --}}
                <div class="card-icon-wrap w-16 h-16 card-icon-bg rounded-2xl flex items-center justify-center mb-5 shadow-sm">
                    <i class="bi bi-book card-icon text-3xl"></i>
                </div>

                {{-- Tag --}}
                <span class="card-tag text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full self-start mb-4">Cerpen</span>

                {{-- Title --}}
                <h3 class="text-gray-900 font-bold text-xl font-serif mb-3" style="font-family:'Playfair Display',serif;">Cerita Pendek</h3>

                <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                    Kisah-kisah pendek yang kaya makna, berlatar budaya Melayu. Satu cerita, seribu kesan yang tak terlupakan.
                </p>

                {{-- Format Guide Preview --}}
                <div class="bg-gray-50 rounded-xl p-3 mb-5 border border-gray-100">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Struktur Dasar</p>
                    <p class="text-xs text-gray-600 font-mono leading-relaxed">Tokoh · Alur · Setting<br>Konflik · Resolusi</p>
                </div>

                {{-- CTA --}}
                <div class="flex items-center gap-2 text-sm font-bold mt-auto" style="color: var(--card-color)">
                    Baca Selengkapnya
                    <i class="bi bi-arrow-right card-arrow"></i>
                </div>
            </a>

            {{-- Card 3: Pantun --}}
            <a href="{{ route('static.pantun') }}" class="cat-card card-pantun bg-white rounded-[22px] border border-gray-100 shadow-sm p-7 flex flex-col h-full group no-underline" data-aos="fade-up" data-aos-delay="200">
                <div class="card-accent"></div>

                {{-- Icon --}}
                <div class="card-icon-wrap w-16 h-16 card-icon-bg rounded-2xl flex items-center justify-center mb-5 shadow-sm">
                    <i class="bi bi-music-note-beamed card-icon text-3xl"></i>
                </div>

                {{-- Tag --}}
                <span class="card-tag text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full self-start mb-4">Pantun</span>

                {{-- Title --}}
                <h3 class="text-gray-900 font-bold text-xl font-serif mb-3" style="font-family:'Playfair Display',serif;">Pantun Melayu</h3>

                <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                    Warisan lisan yang telah diwariskan turun-temurun. 4 baris yang menyimpan hikmah dan kedalaman makna.
                </p>

                {{-- Format Guide Preview --}}
                <div class="bg-gray-50 rounded-xl p-3 mb-5 border border-gray-100">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Struktur Dasar</p>
                    <p class="text-xs text-gray-600 font-mono leading-relaxed">4 baris · Rima a-b-a-b<br>Sampiran · Isi</p>
                </div>

                {{-- CTA --}}
                <div class="flex items-center gap-2 text-sm font-bold mt-auto" style="color: var(--card-color)">
                    Baca Selengkapnya
                    <i class="bi bi-arrow-right card-arrow"></i>
                </div>
            </a>

            {{-- Card 4: Syair --}}
            <a href="{{ route('static.syair') }}" class="cat-card card-syair bg-white rounded-[22px] border border-gray-100 shadow-sm p-7 flex flex-col h-full group no-underline" data-aos="fade-up" data-aos-delay="300">
                <div class="card-accent"></div>

                {{-- Icon --}}
                <div class="card-icon-wrap w-16 h-16 card-icon-bg rounded-2xl flex items-center justify-center mb-5 shadow-sm">
                    <i class="bi bi-stars card-icon text-3xl"></i>
                </div>

                {{-- Tag --}}
                <span class="card-tag text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full self-start mb-4">Syair</span>

                {{-- Title --}}
                <h3 class="text-gray-900 font-bold text-xl font-serif mb-3" style="font-family:'Playfair Display',serif;">Syair Melayu</h3>

                <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                    Puisi lama berangkai yang sarat nilai religius dan kepahlawanan. Keindahan diksi dalam narasi yang mengalun panjang.
                </p>

                {{-- Format Guide Preview --}}
                <div class="bg-gray-50 rounded-xl p-3 mb-5 border border-gray-100">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Struktur Dasar</p>
                    <p class="text-xs text-gray-600 font-mono leading-relaxed">4 baris · Rima a-a-a-a<br>Semua baris = isi</p>
                </div>

                {{-- CTA --}}
                <div class="flex items-center gap-2 text-sm font-bold mt-auto" style="color: var(--card-color)">
                    Baca Selengkapnya
                    <i class="bi bi-arrow-right card-arrow"></i>
                </div>
            </a>

        </div>{{-- /grid --}}
    </div>
</section>

{{-- ══════════════════════════════════════════
     QUOTE BANNER
══════════════════════════════════════════ --}}
<section class="py-16 bg-gradient-to-br from-[#f0fdf4] to-[#dcfce7]">
    <div class="max-w-3xl mx-auto px-6 text-center" data-aos="fade-up">
        <div class="jp-quote rounded-2xl p-10">
            <i class="bi bi-quote text-5xl text-brand-blue/30 mb-4 block"></i>
            <blockquote class="text-2xl font-serif font-bold text-brand-navy leading-relaxed mb-4" style="font-family:'Playfair Display',serif;">
                "Bahasa menunjukkan bangsa, pena mengukir peradaban."
            </blockquote>
            <p class="text-gray-500 text-sm font-medium">— Pepatah Melayu Riau</p>
        </div>
    </div>
</section>

@endsection
