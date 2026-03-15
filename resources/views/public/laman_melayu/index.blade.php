@extends('public.layout.app')

@section('title', 'Laman Melayu — Balai Bahasa Riau')

@section('content')

{{-- Hero Section --}}
<section class="relative py-20 bg-gradient-to-br from-[#f0fdf4] to-[#dcfce7] overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%2316a34a\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-wider text-green-700 bg-green-100 border border-green-200 rounded-full font-mono">
                EKSPLORASI BUDAYA
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-gray-900 mb-6 tracking-tight">Laman Melayu</h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8 leading-relaxed">
                Menyelami kekayaan khazanah kebudayaan, sastra, dan tradisi Melayu melalui kumpulan tulisan dan artikel pilihan.
            </p>
            <nav class="inline-flex bg-white px-6 py-3 rounded-full shadow-sm border border-gray-100" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-800 transition-colors">
                            <i class="bi bi-house-door-fill mr-2"></i> Beranda
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="bi bi-chevron-right text-gray-400 mx-1 text-xs"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Laman Melayu</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</section>

{{-- Content List Section --}}
<section class="py-20 bg-[#f8fafc]">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($karyas as $karya)
                <div class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-green-900/10 hover:-translate-y-2 transition-all duration-300 flex flex-col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative h-60 overflow-hidden bg-gray-100 shrink-0">
                        @if($karya->foto)
                            <img src="{{ asset('storage/' . $karya->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $karya->judul }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="bi bi-image text-5xl text-gray-300"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-green-700 text-xs font-bold px-4 py-1.5 rounded-full shadow-sm">
                            LAMAN MELAYU
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h4 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-snug group-hover:text-green-600 transition-colors">
                            <a href="{{ route('laman_melayu.show', $karya->slug) }}" class="focus:outline-none block">
                                <span class="absolute inset-0 z-0" aria-hidden="true"></span>
                                {{ $karya->judul }}
                            </a>
                        </h4>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-6 leading-relaxed flex-grow">
                            {{ Str::limit(strip_tags($karya->konten), 120) }}
                        </p>
                        <div class="flex justify-between items-center border-t border-gray-50 pt-4 mt-auto">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center mr-3 text-green-600 shrink-0">
                                    <i class="bi bi-vector-pen text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 mb-0.5">{{ Str::limit($karya->penulis ?? 'Penulis', 15) }}</p>
                                    <p class="text-xs text-gray-500 mb-0">{{ $karya->created_at->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="text-green-600 font-bold text-sm flex items-center group-hover:translate-x-1 transition-transform relative z-10 shrink-0">
                                Baca <i class="bi bi-arrow-right-short text-2xl ml-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20" data-aos="fade-in">
                    <div class="w-24 h-24 bg-white shadow-sm rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="bi bi-journal-text text-5xl text-green-500"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Belum ada artikel</h4>
                    <p class="text-gray-500 max-w-md mx-auto text-lg">Kembali lagi nanti untuk membaca tulisan terbaru kami mengenai kebudayaan dan sastra Melayu.</p>
                </div>
            @endforelse
        </div>
        
        {{-- Pagination --}}
        @if($karyas->hasPages())
        <div class="mt-16 flex justify-center">
            {{ $karyas->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</section>

@endsection
