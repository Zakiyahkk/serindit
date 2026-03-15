@extends('public.layout.app')

@section('title', 'Pantun & Syair — Serindit')
@section('description', 'Jelajahi koleksi pantun dan syair Melayu Riau pilihan — warisan lisan yang kaya makna dan nilai budaya.')

@section('styles')
<style>
    /* ── Hero ── */
    .ps-hero {
        background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 55%, #27AE60 100%);
        position: relative; overflow: hidden;
    }
    .ps-hero::before {
        content: ''; position: absolute; inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 32px 32px; pointer-events: none;
    }

    /* ── Filter Tabs ── */
    .filter-tab { transition: all .25s ease; cursor: pointer; }
    .filter-tab.active {
        background: #1e7b1c; color: #fff;
        box-shadow: 0 4px 14px rgba(30,123,28,.35);
    }
    .filter-tab:not(.active):hover { background: #dcfce7; color: #1e7b1c; }

    /* ── Card Berita ── */
    .ps-card {
        transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        overflow: hidden;
    }
    .ps-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(30,123,28,.12); }
    .ps-card .card-img { transition: transform 0.5s ease; }
    .ps-card:hover .card-img { transform: scale(1.07); }
    .ps-card .read-more { transition: gap 0.3s ease; }
    .ps-card:hover .read-more { gap: 10px; }

    /* Badge warna per kategori */
    .badge-pantun { background: #dcfce7; color: #1e7b1c; }
    .badge-syair  { background: #d1fae5; color: #065f46; }

    /* Accent bottom card */
    .ps-card .card-accent-pantun { background: #1e7b1c; }
    .ps-card .card-accent-syair  { background: #27AE60; }
</style>
@endsection

@section('content')

{{-- ══ HERO ══ --}}
<section class="ps-hero py-24 relative">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10 relative z-10">
        <div class="max-w-2xl">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white/80 text-xs font-bold uppercase tracking-widest mb-8" data-aos="fade-right">
                <i class="bi bi-feather text-brand-yellow"></i>
                Warisan Lisan Melayu
            </div>
            <h1 class="text-white font-bold leading-tight mb-6 text-5xl md:text-6xl" style="font-family:'Playfair Display',serif;" data-aos="fade-up" data-aos-delay="100">
                Pantun <span class="text-brand-yellow">&</span> Syair
            </h1>
            <p class="text-white/70 text-lg leading-relaxed mb-8 max-w-xl" data-aos="fade-up" data-aos-delay="200">
                Dua warisan sastra Melayu yang telah diwariskan turun-temurun — pantun dengan kecerdikan sampirannya, syair dengan narasi panjang penuh hikmah.
            </p>
            <div class="flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white/10 border border-white/20 px-4 py-2 rounded-full text-white text-sm font-medium flex items-center gap-2">
                    <i class="bi bi-music-note-beamed text-green-300"></i> {{ $pantuns->count() }} Pantun
                </div>
                <div class="bg-white/10 border border-white/20 px-4 py-2 rounded-full text-white text-sm font-medium flex items-center gap-2">
                    <i class="bi bi-stars text-green-300"></i> {{ $syairs->count() }} Syair
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-hidden absolute bottom-0 left-0 right-0" style="line-height:0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,0 1080,80 1440,30 L1440,60 L0,60 Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- ══ KONTEN ══ --}}
<section class="py-16 bg-white">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10">

        {{-- Filter Tabs --}}
        <div class="flex flex-wrap items-center gap-3 mb-12" data-aos="fade-up">
            <button class="filter-tab active px-5 py-2.5 rounded-full text-sm font-bold border border-green-200 text-green-700" id="btn-semua" onclick="filterKarya('semua')">
                <i class="bi bi-grid mr-1"></i> Semua
            </button>
            <button class="filter-tab px-5 py-2.5 rounded-full text-sm font-bold border border-green-200 text-green-700 bg-white" id="btn-pantun" onclick="filterKarya('pantun')">
                <i class="bi bi-music-note-beamed mr-1"></i> Pantun
            </button>
            <button class="filter-tab px-5 py-2.5 rounded-full text-sm font-bold border border-green-200 text-green-700 bg-white" id="btn-syair" onclick="filterKarya('syair')">
                <i class="bi bi-stars mr-1"></i> Syair
            </button>
        </div>

        {{-- ── PANTUN SECTION ── --}}
        <div id="section-pantun">
            <div class="flex items-center gap-4 mb-8" data-aos="fade-up">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-music-note-beamed text-brand-green text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900" style="font-family:'Playfair Display',serif;">Pantun</h2>
                    <p class="text-sm text-gray-500 mt-0.5">4 baris, rima a-b-a-b, ada sampiran dan isi</p>
                </div>
                <div class="ml-auto hidden sm:flex items-center gap-2 text-xs font-bold text-brand-green bg-green-50 px-3 py-1.5 rounded-full border border-green-100">
                    {{ $pantuns->count() }} Karya
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
                @foreach($pantuns as $i => $pantun)
                <a href="{{ route('pantun.show', $pantun->slug) }}"
                   class="ps-card pantun-item bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col group no-underline"
                   data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}">
                    <div class="relative h-48 overflow-hidden rounded-t-2xl bg-gradient-to-br from-green-100 to-emerald-50">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center px-6">
                                <i class="bi bi-music-note-beamed text-green-300 text-5xl mb-3 block"></i>
                                <p class="text-green-500/70 text-xs font-serif italic leading-relaxed" style="font-family:'Playfair Display',serif;">
                                    "{{ $pantun->konten[0] ?? '' }}"
                                </p>
                            </div>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="badge-pantun text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1">
                                <i class="bi bi-music-note text-[10px]"></i> Pantun
                            </span>
                        </div>
                        @if($pantun->tema)
                        <div class="absolute top-3 right-3">
                            <span class="bg-white/80 text-green-800 text-[10px] font-bold px-2.5 py-1 rounded-full">{{ $pantun->tema }}</span>
                        </div>
                        @endif
                        <div class="card-accent-pantun absolute bottom-0 left-0 right-0 h-1"></div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-gray-900 text-base mb-2 group-hover:text-brand-green transition leading-snug" style="font-family:'Playfair Display',serif;">{{ $pantun->judul }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-grow line-clamp-2">{{ $pantun->deskripsi }}</p>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-400 font-medium">{{ $pantun->penulis }}</span>
                            <div class="read-more flex items-center gap-2 text-xs font-bold text-brand-green">Baca <i class="bi bi-arrow-right"></i></div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- ── SYAIR SECTION ── --}}
        <div id="section-syair">
            <div class="flex items-center gap-4 mb-8" data-aos="fade-up">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-stars text-brand-green text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900" style="font-family:'Playfair Display',serif;">Syair</h2>
                    <p class="text-sm text-gray-500 mt-0.5">4 baris per bait, rima a-a-a-a, semua baris = isi</p>
                </div>
                <div class="ml-auto hidden sm:flex items-center gap-2 text-xs font-bold text-brand-green bg-green-50 px-3 py-1.5 rounded-full border border-green-100">
                    {{ $syairs->count() }} Karya
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($syairs as $i => $syair)
                <a href="{{ route('syair.show', $syair->slug) }}"
                   class="ps-card syair-item bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col group no-underline"
                   data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 80 }}">
                    <div class="relative h-44 overflow-hidden rounded-t-2xl bg-gradient-to-br from-green-100 to-teal-50">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center px-5">
                                <i class="bi bi-stars text-green-300 text-4xl mb-3 block"></i>
                                <p class="text-green-500/70 text-xs font-serif italic leading-relaxed" style="font-family:'Playfair Display',serif;">
                                    "{{ isset($syair->konten[0]) ? (is_array($syair->konten[0]) ? ($syair->konten[0][0] ?? '') : $syair->konten[0]) : '' }}"
                                </p>
                            </div>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="badge-syair text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1"><i class="bi bi-stars text-[10px]"></i> Syair</span>
                        </div>
                        @if($syair->tema)
                        <div class="absolute top-3 right-3">
                            <span class="bg-white/80 text-green-800 text-[10px] font-bold px-2.5 py-1 rounded-full">{{ $syair->tema }}</span>
                        </div>
                        @endif
                        <div class="card-accent-syair absolute bottom-0 left-0 right-0 h-1"></div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-gray-900 text-sm mb-2 group-hover:text-brand-green transition leading-snug" style="font-family:'Playfair Display',serif;">{{ $syair->judul }}</h3>
                        <p class="text-gray-500 text-xs leading-relaxed mb-4 flex-grow line-clamp-2">{{ $syair->deskripsi }}</p>
                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-100">
                            <span class="text-[10px] text-gray-400 font-medium">{{ $syair->penulis }}</span>
                            <div class="read-more flex items-center gap-2 text-[11px] font-bold text-brand-green">Baca <i class="bi bi-arrow-right"></i></div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script>
function filterKarya(tipe) {
    const pantunSection = document.getElementById('section-pantun');
    const syairSection  = document.getElementById('section-syair');
    const btnSemua  = document.getElementById('btn-semua');
    const btnPantun = document.getElementById('btn-pantun');
    const btnSyair  = document.getElementById('btn-syair');

    // Reset all tabs
    [btnSemua, btnPantun, btnSyair].forEach(b => {
        b.classList.remove('active');
        b.style.background = '';
        b.style.color = '';
    });

    if (tipe === 'semua') {
        btnSemua.classList.add('active');
        pantunSection.style.display = '';
        syairSection.style.display  = '';
    } else if (tipe === 'pantun') {
        btnPantun.classList.add('active');
        btnPantun.style.background = '#1e7b1c';
        btnPantun.style.color = '#fff';
        pantunSection.style.display = '';
        syairSection.style.display  = 'none';
    } else if (tipe === 'syair') {
        btnSyair.classList.add('active');
        btnSyair.style.background = '#27AE60';
        btnSyair.style.color = '#fff';
        pantunSection.style.display = 'none';
        syairSection.style.display  = '';
    }
}
</script>
@endsection
