@extends('public.layout.app')

@section('title', $pantun->judul.' — Pantun Melayu — Serindit')
@section('description', $pantun->deskripsi)

@section('styles')
<style>
    .detail-hero { background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 60%, #27AE60 100%); position: relative; overflow: hidden; }
    .detail-hero::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 28px 28px; pointer-events: none; }
    .breadcrumb-chip { background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); }
    .pantun-display { background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #bbf7d0; position: relative; overflow: hidden; }
    .pantun-display::before { content: '\201C'; position: absolute; top: -10px; left: 24px; font-size: 120px; color: rgba(30,123,28,0.08); font-family: 'Playfair Display', serif; line-height: 1; pointer-events: none; }
    .baris-sampiran { color: #1e7b1c; font-style: italic; font-weight: 600; position: relative; padding-left: 16px; }
    .baris-sampiran::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 4px; height: 100%; background: #27AE60; border-radius: 2px; }
    .baris-isi { color: #1e293b; font-weight: 700; padding-left: 16px; position: relative; }
    .baris-isi::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 4px; height: 100%; background: #1e7b1c; border-radius: 2px; }
    .label-sampiran { background: #dcfce7; color: #1e7b1c; }
    .label-isi { background: #fef3c7; color: #92400e; }
    .related-card { transition: all .3s ease; }
    .related-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(30,123,28,.1); }
</style>
@endsection

@section('content')

<section class="detail-hero pt-20 pb-0">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10 pb-14 relative z-10">
        <div class="flex flex-wrap items-center gap-2 mb-8" data-aos="fade-right">
            <a href="{{ route('pantun_syair.index') }}" class="breadcrumb-chip px-3 py-1.5 rounded-full text-white/70 text-xs font-medium hover:text-white transition flex items-center gap-1.5">
                <i class="bi bi-music-note-beamed"></i> Pantun & Syair
            </a>
            <i class="bi bi-chevron-right text-white/30 text-xs"></i>
            <span class="text-white/90 text-xs font-bold px-3 py-1.5 bg-white/15 rounded-full">Pantun</span>
            <i class="bi bi-chevron-right text-white/30 text-xs"></i>
            <span class="text-white/70 text-xs px-3 py-1.5 truncate max-w-[180px]">{{ $pantun->judul }}</span>
        </div>
        <div class="max-w-2xl">
            <span class="inline-flex items-center gap-2 bg-green-400/20 border border-green-400/30 text-green-200 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-5" data-aos="fade-up">
                <i class="bi bi-music-note-beamed"></i> Pantun{{ $pantun->tema ? ' · '.$pantun->tema : '' }}
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight" style="font-family:'Playfair Display',serif;" data-aos="fade-up" data-aos-delay="100">{{ $pantun->judul }}</h1>
            <p class="text-white/60 text-sm font-medium" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-person mr-1"></i> {{ $pantun->penulis }}
            </p>
        </div>
    </div>
    <div class="overflow-hidden" style="line-height:0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,0 1080,80 1440,30 L1440,60 L0,60 Z" fill="white"/>
        </svg>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="pantun-display rounded-3xl p-10 mb-8 shadow-sm" data-aos="fade-up">
                    <div class="flex gap-3 mb-8">
                        <span class="label-sampiran text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1.5">
                            <span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span> Sampiran (Baris 1–2)
                        </span>
                        <span class="label-isi text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1.5">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full inline-block"></span> Isi (Baris 3–4)
                        </span>
                    </div>
                    <div class="space-y-4" style="font-family:'Playfair Display',serif; font-size: 1.25rem; line-height: 2.2;">
                        @foreach($pantun->konten as $idx => $baris)
                            @if($idx < 2)
                                <div class="baris-sampiran">{{ $baris }}</div>
                            @else
                                <div class="baris-isi">{{ $baris }}</div>
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-8 pt-6 border-t border-green-100 flex flex-wrap gap-3">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="bi bi-soundwave text-brand-green"></i>
                            <span>Rima: <strong class="text-green-700">a-b-a-b</strong></span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="bi bi-list-ol text-brand-green"></i>
                            <span>Jumlah baris: <strong class="text-green-700">4 baris</strong></span>
                        </div>
                        @if($pantun->tema)
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="bi bi-tag text-brand-green"></i>
                            <span>Tema: <strong class="text-green-700">{{ $pantun->tema }}</strong></span>
                        </div>
                        @endif
                    </div>
                </div>

                @if($pantun->makna)
                <div class="bg-gradient-to-r from-green-50 to-white rounded-2xl p-8 border border-green-100 shadow-sm mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-lg">
                        <i class="bi bi-lightbulb text-brand-green"></i> Makna & Pesan
                    </h3>
                    <p class="text-gray-600 leading-relaxed">{{ $pantun->makna }}</p>
                </div>
                @endif

                <a href="{{ route('pantun_syair.index') }}" class="inline-flex items-center gap-2 text-brand-green font-bold text-sm hover:gap-3 transition-all" data-aos="fade-up">
                    <i class="bi bi-arrow-left"></i> Kembali ke Pantun & Syair
                </a>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm mb-6" data-aos="fade-left">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-info-circle text-brand-green"></i> Tentang Pantun
                    </h3>
                    <ul class="space-y-3">
                        @foreach(['Terdiri dari <strong>4 baris</strong> dalam satu bait','Baris 1–2 = <strong>Sampiran</strong> (pengantar dari alam)','Baris 3–4 = <strong>Isi</strong> (pesan/maksud sebenarnya)','Rima akhir: <strong>a-b-a-b</strong>','Setiap baris 8–12 suku kata'] as $ciri)
                        <li class="flex items-start gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"><i class="bi bi-check2 text-brand-green text-xs"></i></div>
                            {!! $ciri !!}
                        </li>
                        @endforeach
                    </ul>
                </div>

                @if($related->count() > 0)
                <div data-aos="fade-left" data-aos-delay="100">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-grid text-brand-green"></i> Pantun Lainnya
                    </h3>
                    <div class="space-y-3">
                        @foreach($related as $rel)
                        <a href="{{ route('pantun.show', $rel->slug) }}"
                           class="related-card flex gap-4 bg-white rounded-xl p-4 border border-gray-100 shadow-sm group no-underline">
                            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-music-note-beamed text-brand-green text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-brand-green mb-0.5">{{ $rel->tema }}</p>
                                <h4 class="text-sm font-bold text-gray-800 group-hover:text-brand-green transition leading-snug line-clamp-2">{{ $rel->judul }}</h4>
                            </div>
                            <i class="bi bi-chevron-right text-gray-300 group-hover:text-brand-green transition text-sm flex-shrink-0 mt-1"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
