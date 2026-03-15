@extends('public.layout.app')

@section('title', $karya->judul . ' — Warta Basa')

@section('content')

<article class="bg-[#f8fafc] min-h-screen pb-20">
    <div class="pt-32 pb-40 bg-gradient-to-b from-[#eff6ff] to-[#f8fafc] relative px-4 text-center">
        <div class="max-w-4xl mx-auto" data-aos="fade-up">
            <span class="inline-block px-5 py-2 mb-8 text-xs font-bold tracking-widest text-blue-700 bg-white shadow-sm border border-blue-100 rounded-full font-mono uppercase">
                Berita Terkini
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-gray-900 mb-10 leading-tight">
                {{ $karya->judul }}
            </h1>
            
            <div class="flex flex-wrap items-center justify-center gap-6 md:gap-12 bg-white/70 backdrop-blur-md py-4 px-8 rounded-2xl shadow-sm border border-white/50 w-max mx-auto max-w-full">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-blue-600 text-lg shrink-0">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Tim Redaksi</span>
                        <span class="block text-sm font-bold text-gray-800">{{ $karya->penulis }}</span>
                    </div>
                </div>
                <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-blue-600 text-lg shrink-0">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Waktu Terbit</span>
                        <span class="block text-sm font-bold text-gray-800">{{ $karya->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                    </div>
                </div>
                <div class="hidden lg:block w-px h-10 bg-gray-200"></div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-blue-600 text-lg shrink-0">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Dilihat</span>
                        <span class="block text-sm font-bold text-gray-800">{{ $karya->views }} Kali</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-4xl relative z-10" style="margin-top: -100px;">
        @if($karya->foto)
            <div class="rounded-3xl overflow-hidden shadow-2xl mb-12 shadow-gray-200/50" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('storage/' . $karya->foto) }}" alt="{{ $karya->judul }}" class="w-full h-auto max-h-[600px] object-cover">
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/40 p-8 md:p-12 lg:p-16" data-aos="fade-up" data-aos-delay="200" style="{{ !$karya->foto ? 'margin-top: 0;' : '' }}">
            <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed font-sans prose-headings:font-serif prose-headings:font-bold prose-a:text-blue-600 prose-img:rounded-xl">
                {!! $karya->konten !!}
            </div>

            <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4 flex-wrap">
                    <span class="text-sm font-bold text-gray-500 uppercase tracking-widest">Bagikan:</span>
                    <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white hover:border-transparent transition-all"><i class="bi bi-facebook"></i></button>
                    <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white hover:border-transparent transition-all"><i class="bi bi-twitter-x"></i></button>
                    <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white hover:border-transparent transition-all"><i class="bi bi-whatsapp"></i></button>
                </div>
                <a href="{{ route('warta_basa.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-50 hover:bg-blue-600 text-gray-700 hover:text-white font-semibold rounded-full transition-all duration-300">
                    <i class="bi bi-arrow-left mr-2 block shrink-0"></i> Indeks Berita
                </a>
            </div>
        </div>
    </div>
</article>

@endsection

@section('styles')
<style>
    /* Add Tailwind Prose custom support */
    .prose-blue p { margin-bottom: 1.5rem; }
    .prose-blue h1, .prose-blue h2, .prose-blue h3 { color: #111827; margin-top: 2em; margin-bottom: 1em; }
    .prose-blue h2 { font-size: 1.875rem; }
    .prose-blue h3 { font-size: 1.5rem; }
    .prose-blue blockquote { border-left: 4px solid #3b82f6; padding-left: 1.5em; font-style: italic; color: #4b5563; background: #eff6ff; padding: 1.5rem; border-radius: 0 0.75rem 0.75rem 0; margin-bottom: 1.5rem; }
</style>
@endsection
