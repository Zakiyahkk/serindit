{{-- ═══════════════════════════════════════════
    NAVBAR — Layout Global
    Digunakan oleh semua halaman publik.
    ⚠️  Stat bar ada di: public/home/statsbar.blade.php
        (tidak diletakkan di sini karena hanya muncul di halaman Home)
══════════════════════════════════════════════ --}}
<nav class="bg-brand-darkblue navbar-glow sticky top-0 z-50">
    <div class="w-full max-w-[1300px] mx-auto px-4 lg:px-6 h-20 flex items-center justify-between">

        {{-- Logo Balai Bahasa --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0 group">
            <img src="{{ asset('img/logo/logobalai.png') }}" alt="Logo Balai Bahasa Provinsi Riau"
                 class="h-12 w-auto object-contain"
                 style="max-height: 48px; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.35)) drop-shadow(0 0 12px rgba(255,255,255,0.25));"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            {{-- Fallback teks jika gambar tidak ditemukan --}}
            <div style="display:none" class="flex items-center gap-2.5">
                <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="bi bi-book text-white text-base"></i>
                </div>
                <div>
                    <span class="text-white font-bold text-lg tracking-wide" style="font-family: 'Playfair Display', serif;">Serindit</span>
                </div>
            </div>
        </a>

        {{-- Menu Desktop --}}
        <div class="hidden lg:flex items-center gap-0.5 font-bold text-[13px] text-white/90">
            <a href="{{ route('home') }}"
               class="px-2 py-2 rounded-full flex items-center gap-1.5 transition {{ Route::is('home') ? 'text-white bg-white/15' : 'hover:text-white hover:bg-white/10' }}">
                <i class="bi bi-house-door"></i>
                Beranda
            </a>

            <a href="{{ route('home') }}#tentang"
               class="px-2 py-2 rounded-full transition flex items-center gap-1.5 hover:text-white hover:bg-white/10">
                <i class="bi bi-info-circle"></i>
                Tentang
            </a>

            <!-- Dropdown Jejak Pena -->
            <div class="relative group">
                <button class="px-2 py-2 rounded-full transition flex items-center gap-1.5 {{ request()->routeIs('static.puisi') || request()->routeIs('static.cerpen') || request()->routeIs('static.pantun') ? 'text-white bg-white/15' : 'hover:text-white hover:bg-white/10' }}">
                    <i class="bi bi-feather"></i> Jejak Pena <i class="bi bi-chevron-down text-[9px] ml-0.5"></i>
                </button>
                <div class="absolute top-full left-0 mt-2 w-52 bg-white rounded-xl shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 text-gray-800 flex flex-col border border-gray-100">
                    <a href="{{ route('static.puisi') }}" class="px-4 py-2 hover:bg-brand-sky/10 text-sm hover:text-brand-green transition font-medium flex items-center gap-2">
                        <i class="bi bi-journal-text text-brand-green/70"></i> Puisi
                    </a>
                    <a href="{{ route('static.cerpen') }}" class="px-4 py-2 hover:bg-brand-sky/10 text-sm hover:text-brand-green transition font-medium flex items-center gap-2">
                        <i class="bi bi-book text-brand-green/70"></i> Cerpen
                    </a>
                    <a href="{{ route('static.pantun') }}" class="px-4 py-2 hover:bg-brand-sky/10 text-sm hover:text-brand-green transition font-medium flex items-center gap-2">
                        <i class="bi bi-music-note-beamed text-brand-green/70"></i> Pantun & Syair
                    </a>
                </div>
            </div>

            <a href="{{ route('static.laman_melayu') }}" class="px-2 py-2 rounded-full transition flex items-center gap-1.5 {{ request()->routeIs('static.laman_melayu') ? 'text-white bg-white/15' : 'hover:text-white hover:bg-white/10' }}">
                <i class="bi bi-globe"></i>
                Laman Melayu
            </a>

            <a href="{{ route('static.warta_basa') }}" class="px-2 py-2 rounded-full transition flex items-center gap-1.5 {{ request()->routeIs('static.warta_basa') ? 'text-white bg-white/15' : 'hover:text-white hover:bg-white/10' }}">
                <i class="bi bi-newspaper"></i>
                Warta Basa
            </a>

            <!-- Dropdown Kanal Naskah -->
            <div class="relative group">
                <button class="px-2 py-2 rounded-full transition flex items-center gap-1.5 {{ request()->routeIs('static.panduan_penulisan') || request()->routeIs('static.kontak') ? 'text-white bg-white/15' : 'hover:text-white hover:bg-white/10' }}">
                    <i class="bi bi-envelope-paper"></i> Kanal Naskah <i class="bi bi-chevron-down text-[9px] ml-0.5"></i>
                </button>
                <div class="absolute top-full right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 text-gray-800 flex flex-col border border-gray-100">
                    <a href="{{ route('static.panduan_penulisan') }}" class="px-4 py-2 text-sm hover:bg-brand-sky/10 hover:text-brand-green transition font-medium flex items-center gap-2">
                        <i class="bi bi-journal-bookmark text-brand-green/70"></i> Panduan Penulisan
                    </a>
                    <a href="{{ route('static.kontak') }}" class="px-4 py-2 text-sm hover:bg-brand-sky/10 hover:text-brand-green transition font-medium flex items-center gap-2">
                        <i class="bi bi-telephone text-brand-green/70"></i> Kontak Redaksi
                    </a>
                </div>
            </div>
        </div>

        {{-- Search Bar --}}
        <form action="{{ route('book.list') }}" method="GET" class="relative hidden lg:block">
            <input type="text" name="q" placeholder="Cari buku..."
                   value="{{ request('q') }}"
                   class="pl-11 pr-4 py-2.5 rounded-full text-sm font-medium text-gray-700
                          bg-white/95 border-0 focus:ring-2 focus:ring-brand-yellow w-56
                          shadow-inner transition-all duration-300 focus:w-72 outline-none">
            <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>

        {{-- Mobile Hamburger --}}
        <button class="md:hidden text-white p-2">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

    </div>
</nav>
