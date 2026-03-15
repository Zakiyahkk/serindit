@extends('public.layout.app')

@section('title', 'Koleksi Puisi — Serindit')
@section('description', 'Jelajahi koleksi puisi Melayu Riau pilihan — bait-bait indah yang mengalir dari jiwa para penyair Riau.')

@section('styles')
<style>
    .ps-hero {
        background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 55%, #27AE60 100%);
        position: relative; overflow: hidden;
    }
    .ps-hero::before {
        content: ''; position: absolute; inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 32px 32px; pointer-events: none;
    }
    .ps-card { transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94); overflow: hidden; }
    .ps-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(30,123,28,.14); }
    .ps-card .card-img-wrap { transition: transform 0.5s ease; }
    .ps-card:hover .card-img-wrap { transform: scale(1.06); }
    .ps-card .read-more { gap: 6px; transition: gap 0.3s ease; display: flex; align-items: center; }
    .ps-card:hover .read-more { gap: 10px; }
    .badge-puisi { background: #dcfce7; color: #1e7b1c; }
    .accent-green { background: #1e7b1c; }
</style>
@endsection

@section('content')

<section class="ps-hero py-24 relative">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10 relative z-10">
        <div class="max-w-2xl">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white/80 text-xs font-bold uppercase tracking-widest mb-8" data-aos="fade-right">
                <i class="bi bi-journal-text text-brand-yellow"></i> Jejak Pena · Puisi
            </div>
            <h1 class="text-white font-bold leading-tight mb-5 text-5xl md:text-6xl" style="font-family:'Playfair Display',serif;" data-aos="fade-up" data-aos-delay="100">
                Koleksi <span class="text-brand-yellow">Puisi</span>
            </h1>
            <p class="text-white/70 text-lg leading-relaxed mb-8 max-w-xl" data-aos="fade-up" data-aos-delay="200">
                Bait-bait puisi yang lahir dari jiwa para penyair Riau — mengalun bebas, penuh metafora, dan sarat keindahan bahasa Melayu.
            </p>
            <div class="flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white/10 border border-white/20 px-4 py-2 rounded-full text-white text-sm font-medium flex items-center gap-2">
                    <i class="bi bi-journal-text text-green-300"></i> {{ $puisis->count() }} Karya Puisi
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

<section class="py-16 bg-white">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10">
        <div class="flex items-center gap-4 mb-10" data-aos="fade-up">
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="bi bi-journal-text text-brand-green text-lg"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'Playfair Display',serif;">Daftar Puisi</h2>
                <p class="text-sm text-gray-500 mt-0.5">Klik kartu untuk membaca puisi lengkap beserta maknanya</p>
            </div>
            <div class="ml-auto hidden sm:block text-xs font-bold text-brand-green bg-green-50 px-3 py-1.5 rounded-full border border-green-100">
                {{ $puisis->count() }} Karya
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($puisis as $i => $puisi)
            <a href="{{ route('puisi.show', $puisi->slug) }}"
               class="ps-card bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col group no-underline"
               data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}">
                <div class="relative h-48 overflow-hidden rounded-t-2xl bg-gradient-to-br from-green-100 to-emerald-50">
                    <div class="card-img-wrap absolute inset-0 flex items-center justify-center">
                        <div class="text-center px-6">
                            <i class="bi bi-journal-text text-green-300 text-5xl mb-3 block"></i>
                            @if(isset($puisi->konten[0]))
                            <p class="text-green-500/70 text-xs font-serif italic leading-relaxed line-clamp-2" style="font-family:'Playfair Display',serif;">
                                "{{ is_array($puisi->konten[0]) ? ($puisi->konten[0][0] ?? '') : $puisi->konten[0] }}"
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="absolute top-3 left-3">
                        <span class="badge-puisi text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="bi bi-journal-text text-[10px]"></i> Puisi
                        </span>
                    </div>
                    @if($puisi->jenis)
                    <div class="absolute top-3 right-3">
                        <span class="bg-white/80 text-green-800 text-[10px] font-bold px-2.5 py-1 rounded-full">{{ $puisi->jenis }}</span>
                    </div>
                    @endif
                    <div class="accent-green absolute bottom-0 left-0 right-0 h-1"></div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="font-bold text-gray-900 text-base mb-2 group-hover:text-brand-green transition leading-snug" style="font-family:'Playfair Display',serif;">
                        {{ $puisi->judul }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-grow line-clamp-2">{{ $puisi->deskripsi }}</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-400 font-medium"><i class="bi bi-person mr-1 text-[10px]"></i>{{ $puisi->penulis }}</span>
                        <div class="read-more text-xs font-bold text-brand-green">Baca <i class="bi bi-arrow-right"></i></div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
