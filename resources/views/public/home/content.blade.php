{{-- CONTENT SECTIONS | Variabel: $terbatas, $terbaru, $jenjang, $terpopuler, $kategori --}}

{{-- ═══ EDISI TERBATAS & TERBARU ═══ --}}
<section id="koleksi" class="bg-[#F8FAFF] py-16">
    <div class="max-w-6xl mx-auto px-6 lg:px-10">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="section-label bg-green-50 text-green-600">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                Koleksi Spesial & Terbaru
            </span>
            <h2 class="section-title text-3xl lg:text-4xl">Majalah Edisi Khusus & Terbaru</h2>
            <div class="section-divider"></div>
            <p class="text-gray-500 mt-4 text-sm font-normal max-w-lg mx-auto">Koleksi majalah terhangat yang baru saja hadir di perpustakaan digital kami.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 lg:gap-6">
            @forelse($terbaru->take(8) as $index => $book)
            <div class="book-card group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 80 }}">
                <div class="relative aspect-[5/7] bg-gradient-to-br from-slate-50 to-blue-50 overflow-hidden">
                    <div class="absolute top-2.5 left-2.5 bg-brand-green text-white text-[9px] font-semibold px-2.5 py-1 rounded-md shadow z-10 tracking-wide">
                    MAJALAH BARU
                    </div>

                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                             alt="{{ $book->title }}">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-200 gap-2">
                            <i class="bi bi-book text-5xl"></i>
                            <span class="text-xs text-gray-300 font-medium">Tanpa Cover</span>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                        <a href="{{ route('book.show', $book->slug ?? $book->id) }}"
                           class="w-full py-2.5 bg-white text-brand-navy font-semibold text-xs rounded-xl text-center shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            Baca Sekarang
                        </a>
                    </div>
                </div>

                <div class="p-4 flex-1 flex flex-col">
                    <h3 class="font-semibold text-gray-900 text-sm leading-snug line-clamp-2 mb-1.5" title="{{ $book->title }}">
                        {{ $book->title }}
                    </h3>
                    <p class="text-[11px] text-gray-400 font-normal">{{ $book->readingLevel->name ?? 'Semua Kalangan' }}</p>
                    <div class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between mt-3">
                        <span class="flex items-center gap-1.5 text-[11px] text-gray-400">
                            <i class="bi bi-eye"></i> {{ $book->stat->views_count ?? '0' }}
                        </span>
                        <span class="bg-blue-50 text-brand-blue text-[10px] font-medium px-2 py-0.5 rounded-md">PDF</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-20">
                <i class="bi bi-inbox text-5xl text-gray-200"></i>
                <p class="text-gray-400 font-normal mt-3">Belum ada majalah yang tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</section>




{{-- ═══ TERPOPULER ═══ --}}
<section class="bg-[#EEF6FF] py-16">
    <div class="max-w-6xl mx-auto px-6 lg:px-10">
        <div class="flex items-end justify-between mb-12" data-aos="fade-right">
            <div>
                <span class="section-label bg-brand-yellow/10 text-brand-yellow">
                    <span class="w-1.5 h-1.5 bg-brand-yellow rounded-full"></span>
                    Paling Banyak Dibaca
                </span>
                <h2 class="section-title text-3xl lg:text-4xl">Koleksi Populer</h2>
            </div>
            <a href="{{ route('book.list', ['sort' => 'populer']) }}" class="hidden md:flex items-center gap-1.5 text-brand-blue font-medium text-sm hover:underline underline-offset-4 flex-shrink-0 mb-1">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($terpopuler->take(6) as $popular)
            <div class="flex bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md hover:-translate-y-1 transition-all duration-200 group">
                <div class="w-24 h-32 flex-shrink-0 overflow-hidden bg-gradient-to-br from-slate-100 to-blue-50">
                    @if($popular->cover_image)
                        <img src="{{ asset('storage/' . $popular->cover_image) }}" class="w-full h-full object-cover" alt="{{ $popular->title }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="bi bi-book text-3xl text-gray-200"></i>
                        </div>
                    @endif
                </div>
                <div class="p-4 flex flex-col justify-between flex-1 min-w-0">
                    <div>
                        <span class="inline-block bg-blue-50 text-brand-blue text-[10px] font-medium px-2 py-0.5 rounded tracking-wide mb-2">Populer</span>
                        <h4 class="font-semibold text-gray-900 text-sm leading-snug line-clamp-2 group-hover:text-brand-blue transition mb-1">{{ $popular->title }}</h4>
                        <p class="text-[11px] text-gray-400 font-normal">{{ $popular->readingLevel->name ?? 'Semua Kalangan' }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center gap-3 text-[11px] text-gray-400">
                            <span class="flex items-center gap-1"><i class="bi bi-eye"></i> {{ $popular->stat->views_count ?? 0 }}</span>
                            <span class="flex items-center gap-1"><i class="bi bi-heart"></i> {{ $popular->stat->likes_count ?? 0 }}</span>
                        </div>
                        <a href="{{ route('book.show', $popular->slug ?? $popular->id) }}"
                           class="text-xs font-medium text-white bg-brand-blue px-3 py-1.5 rounded-lg hover:bg-brand-darkblue transition flex-shrink-0">
                            Baca
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══ KATEGORI ═══ --}}
<section id="kategori" class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6 lg:px-10">
        <div class="text-center mb-12">
            <span class="section-label bg-green-50 text-green-600">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                Semua Topik
            </span>
            <h2 class="section-title text-3xl lg:text-4xl">Jelajahi Kategori</h2>
            <div class="section-divider"></div>
            <p class="text-gray-400 mt-4 text-sm font-normal">Temukan majalah berdasarkan topik yang Anda minati.</p>
        </div>

        @php
            $catStyles = [
                ['bg' => 'bg-red-50',     'text' => 'text-red-600',    'border' => 'border-red-100',   'hover' => 'hover:bg-red-500'],
                ['bg' => 'bg-orange-50',  'text' => 'text-orange-600', 'border' => 'border-orange-100','hover' => 'hover:bg-orange-500'],
                ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',  'border' => 'border-amber-100', 'hover' => 'hover:bg-amber-500'],
                ['bg' => 'bg-green-50',   'text' => 'text-green-600',  'border' => 'border-green-100', 'hover' => 'hover:bg-green-500'],
                ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',   'border' => 'border-blue-100',  'hover' => 'hover:bg-blue-500'],
                ['bg' => 'bg-indigo-50',  'text' => 'text-indigo-600', 'border' => 'border-indigo-100','hover' => 'hover:bg-indigo-500'],
                ['bg' => 'bg-purple-50',  'text' => 'text-purple-600', 'border' => 'border-purple-100','hover' => 'hover:bg-purple-500'],
            ];
        @endphp

        <div class="flex flex-wrap justify-center gap-3">
            @foreach($kategori ?? [] as $index => $cat)
            @php $s = $catStyles[$index % count($catStyles)]; @endphp
            <a href="{{ route('book.list', ['kategori' => $cat->id]) }}"
               class="cat-pill flex items-center gap-2.5 px-5 py-2.5 rounded-xl border font-medium text-sm transition-all hover:text-white hover:shadow-md {{ $s['bg'] }} {{ $s['text'] }} {{ $s['border'] }} {{ $s['hover'] }}">
                {{ $cat->name }}
                <span class="text-[11px] opacity-60 bg-black/8 px-2 py-0.5 rounded-full">{{ $cat->books_count }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══ CTA BANNER ═══ --}}
<section class="py-16 bg-brand-navy relative overflow-hidden">
    {{-- Decorative rings --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full border border-white/5"></div>
        <div class="absolute -bottom-20 -left-20 w-96 h-96 rounded-full border border-white/5"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full border border-white/3"></div>
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>

    <div class="max-w-2xl mx-auto px-6 lg:px-10 text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-white/8 text-white/70 px-4 py-2 rounded-full text-xs font-medium tracking-widest uppercase mb-6 border border-white/10">
            <span class="w-1.5 h-1.5 bg-brand-yellow rounded-full animate-pulse"></span>
            Perpustakaan Digital Gratis
        </div>
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4 leading-tight" style="font-family: 'Playfair Display', serif;">
            Mulai Perjalanan Literasi<br>Bersama Serindit
        </h2>
        <p class="text-white/50 text-base mb-8 font-normal leading-relaxed">
            Ribuan edisi majalah menunggu Anda. Gratis, mudah diakses, dan hadir untuk semua kalangan.
        </p>
        <a href="#koleksi"
           class="inline-flex items-center gap-2.5 px-8 py-3.5 bg-brand-yellow text-white font-semibold text-sm rounded-xl shadow-xl badge-pulse hover:bg-yellow-400 hover:-translate-y-0.5 transition-all duration-200">
            <i class="bi bi-book"></i>
            Jelajahi Koleksi Sekarang
        </a>
    </div>
</section>
