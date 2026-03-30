@extends('public.layout.app')

@section('title', $puisi->judul.' — Puisi Melayu — Serindit')
@section('description', $puisi->deskripsi)

@section('styles')
<style>
    .detail-hero { background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 60%, #27AE60 100%); position: relative; overflow: hidden; }
    .detail-hero::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 28px 28px; pointer-events: none; }
    .breadcrumb-chip { background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); }
    .puisi-display { background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #bbf7d0; position: relative; overflow: hidden; }
    .puisi-display::before { content: '\201C'; position: absolute; top: -10px; left: 24px; font-size: 120px; color: rgba(30,123,28,0.07); font-family: 'Playfair Display', serif; line-height: 1; pointer-events: none; }
    .puisi-bait { font-family: 'Playfair Display', serif; font-size: 1.15rem; line-height: 2.3; color: #1e293b; font-style: italic; padding-left: 16px; border-left: 3px solid #1e7b1c; }
    .bait-separator { height: 1px; background: linear-gradient(90deg, #bbf7d0, transparent); margin: 20px 0; }
    .related-card { transition: all .3s ease; }
    .related-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(30,123,28,.1); }
    .tag-green { background: #dcfce7; color: #1e7b1c; }
</style>
@endsection

@section('content')

<section class="detail-hero pt-20 pb-0">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10 pb-14 relative z-10">
        <div class="flex flex-wrap items-center gap-2 mb-8" data-aos="fade-right">
            <a href="{{ route('static.puisi') }}" class="breadcrumb-chip px-3 py-1.5 rounded-full text-white/70 text-xs font-medium hover:text-white transition flex items-center gap-1.5">
                <i class="bi bi-journal-text"></i> Puisi
            </a>
            <i class="bi bi-chevron-right text-white/30 text-xs"></i>
            <span class="text-white/80 text-xs px-3 py-1.5 bg-white/10 rounded-full truncate max-w-[200px]">{{ $puisi->judul }}</span>
        </div>
        <div class="max-w-2xl">
            @if($puisi->jenis)
            <span class="inline-flex items-center gap-2 bg-green-400/20 border border-green-400/30 text-green-200 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-5" data-aos="fade-up">
                <i class="bi bi-journal-text"></i> {{ $puisi->jenis }}
            </span>
            @endif
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 leading-tight" style="font-family:'Playfair Display',serif;" data-aos="fade-up" data-aos-delay="100">{{ $puisi->judul }}</h1>
            <p class="text-white/60 text-sm font-medium flex items-center gap-3" data-aos="fade-up" data-aos-delay="200">
                <span><i class="bi bi-person mr-1"></i>{{ $puisi->penulis }}</span>
                <span class="text-white/30">·</span>
                <span><i class="bi bi-align-left mr-1"></i>{{ count($puisi->konten) }} bait</span>
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
                <div class="puisi-display rounded-3xl p-10 mb-8 shadow-sm" data-aos="fade-up">
                    @if($puisi->jenis)
                    <div class="flex items-center gap-3 mb-8">
                        <span class="tag-green text-[11px] font-bold px-3 py-1 rounded-full">{{ $puisi->jenis }}</span>
                        <span class="tag-green text-[11px] font-bold px-3 py-1 rounded-full">{{ count($puisi->konten) }} bait</span>
                    </div>
                    @endif
                    <div class="space-y-1">
                        @foreach($puisi->konten as $idx => $bait)
                            @if($idx > 0)<div class="bait-separator"></div>@endif
                            <div class="puisi-bait">
                                @if(is_array($bait))
                                    @foreach($bait as $baris){{ $baris }}<br>@endforeach
                                @else
                                    {{ $bait }}<br>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if($puisi->majas)
                    <div class="mt-8 pt-6 border-t border-green-100 flex flex-wrap gap-3">
                        @foreach($puisi->majas as $m)
                        <span class="tag-green text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="bi bi-bookmark text-[10px]"></i> {{ $m }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>

                @if($puisi->makna)
                <div class="bg-gradient-to-r from-green-50 to-white rounded-2xl p-8 border border-green-100 shadow-sm mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-lg">
                        <i class="bi bi-lightbulb text-brand-green"></i> Makna & Interpretasi
                    </h3>
                    <p class="text-gray-600 leading-relaxed">{{ $puisi->makna }}</p>
                </div>
                @endif

                <a href="{{ route('static.puisi') }}" class="inline-flex items-center gap-2 text-brand-green font-bold text-sm hover:gap-3 transition-all" data-aos="fade-up">
                    <i class="bi bi-arrow-left"></i> Kembali ke Koleksi Puisi
                </a>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm mb-6" data-aos="fade-left">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-info-circle text-brand-green"></i> Info Karya
                    </h3>
                    <div class="space-y-3">
                        @if($puisi->jenis)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs text-gray-500 font-medium">Jenis</span>
                            <span class="text-xs font-bold text-gray-800">{{ $puisi->jenis }}</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs text-gray-500 font-medium">Penulis</span>
                            <span class="text-xs font-bold text-gray-800">{{ $puisi->penulis }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs text-gray-500 font-medium">Jumlah Bait</span>
                            <span class="text-xs font-bold text-gray-800">{{ count($puisi->konten) }} bait</span>
                        </div>
                        @if($puisi->majas)
                        <div class="flex flex-col gap-2 py-2">
                            <span class="text-xs text-gray-500 font-medium">Majas</span>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($puisi->majas as $m)
                                <span class="tag-green text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $m }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if($related->count() > 0)
                <div data-aos="fade-left" data-aos-delay="100">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-grid text-brand-green"></i> Puisi Lainnya
                    </h3>
                    <div class="space-y-3">
                        @foreach($related as $rel)
                        <a href="{{ route('puisi.show', $rel->slug) }}"
                           class="related-card flex gap-4 bg-white rounded-xl p-4 border border-gray-100 shadow-sm group no-underline">
                            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-journal-text text-brand-green text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] font-bold text-brand-green mb-0.5">{{ $rel->jenis }}</p>
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
