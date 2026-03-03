{{-- HERO SECTION | Variabel: $stats --}}
<header class="hero-bg pt-14 pb-2 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-20">

            {{-- Teks Kiri --}}
            <div class="lg:w-1/2 text-center lg:text-left">

                {{-- Label Kecil --}}
                <div class="inline-flex items-center gap-2 bg-brand-blue/10 text-brand-blue px-4 py-2 rounded-full text-xs font-semibold tracking-widest uppercase mb-6" data-aos="fade-up">
                    <span class="w-1.5 h-1.5 bg-brand-blue rounded-full"></span>
                    Perpustakaan Digital Balai Bahasa Riau
                </div>

                <h1 class="text-4xl lg:text-5xl xl:text-[56px] font-bold leading-[1.15] text-brand-navy mb-6" data-aos="fade-up" data-aos-delay="50"
                    style="font-family: 'Playfair Display', serif;">
                    Temukan Dunia<br>
                    Melalui <span class="text-brand-blue relative inline-block">
                        Buku
                        <svg class="absolute -bottom-1.5 left-0 w-full" viewBox="0 0 160 8" fill="none">
                            <path d="M0 6 Q 40 1 80 5 Q 120 9 160 3" stroke="#F5A623" stroke-width="3" stroke-linecap="round" fill="none"/>
                        </svg>
                    </span>
                </h1>

                <p class="text-gray-500 text-base lg:text-lg leading-8 mb-8 max-w-md mx-auto lg:mx-0 font-normal" data-aos="fade-up" data-aos-delay="100">
                    Platform literasi digital dari <strong class="text-gray-700 font-semibold">Balai Bahasa Provinsi Riau</strong>.
                    Ribuan buku untuk semua kalangan — dari karya sastra Melayu hingga ilmu pengetahuan, semua hadir di sini.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="200">
                    <a href="#koleksi"
                       class="w-full sm:w-auto flex items-center justify-center gap-2.5 px-7 py-3.5 bg-brand-blue text-white font-semibold text-sm rounded-xl shadow-lg hover:bg-brand-darkblue hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Jelajahi Koleksi
                    </a>
                    <a href="{{ route('book.list') }}"
                       class="w-full sm:w-auto flex items-center justify-center gap-2.5 px-7 py-3.5 bg-white text-brand-navy font-semibold text-sm rounded-xl shadow-sm border border-gray-200 hover:border-brand-blue hover:text-brand-blue hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari Buku
                    </a>
                </div>

                {{-- Trust Badges --}}
                <div class="mt-10 flex flex-wrap items-center gap-3 justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="300">
                    <span class="flex items-center gap-2 bg-white text-gray-600 text-xs font-medium px-4 py-2 rounded-full border border-gray-200 shadow-sm">
                        <svg class="w-3.5 h-3.5 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Akses Gratis
                    </span>
                    <span class="flex items-center gap-2 bg-white text-gray-600 text-xs font-medium px-4 py-2 rounded-full border border-gray-200 shadow-sm">
                        <svg class="w-3.5 h-3.5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Tanpa Login
                    </span>
                    <span class="flex items-center gap-2 bg-white text-gray-600 text-xs font-medium px-4 py-2 rounded-full border border-gray-200 shadow-sm">
                        <svg class="w-3.5 h-3.5 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Untuk Semua Kalangan
                    </span>
                </div>
            </div>

            {{-- Ilustrasi / Visual Kanan --}}
            <div class="lg:w-1/2 relative flex justify-center items-center py-10 lg:py-0" data-aos="fade-left" data-aos-delay="200">
                <div class="relative w-full max-w-sm">

                    {{-- Lingkaran dekoratif --}}
                    <div class="absolute inset-0 flex items-center justify-center -z-10">
                        <div class="w-72 h-72 rounded-full bg-gradient-to-br from-brand-blue/10 to-brand-sky/5 blur-2xl"></div>
                    </div>
                    <div class="absolute -top-8 -left-8 w-48 h-48 rounded-full border border-brand-blue/10 -z-10"></div>
                    <div class="absolute -bottom-8 -right-8 w-32 h-32 rounded-full border border-brand-yellow/20 -z-10"></div>

                    {{-- Logo / Gambar utama --}}
                    <img src="{{ asset('img/logo/sembari.png') }}" alt="Serindit"
                         class="relative z-10 w-full h-auto object-contain animate-float"
                         style="filter: drop-shadow(0 32px 64px rgba(7,102,210,0.15)) drop-shadow(0 8px 16px rgba(7,102,210,0.10));"
                         onerror="this.style.display='none'; this.nextElementSibling.style.removeProperty('display');">

                    {{-- Fallback visual elegan jika gambar tidak ada --}}
                    <div style="display:none" class="relative z-10 w-full h-72 flex flex-col items-center justify-center">
                        <div class="w-32 h-40 bg-gradient-to-br from-brand-blue to-brand-darkblue rounded-2xl shadow-2xl flex items-center justify-center animate-float">
                            <i class="bi bi-book text-white text-6xl opacity-90"></i>
                        </div>
                    </div>

                    {{-- Floating chip: Total Buku --}}
                    <div class="absolute top-2 -right-4 z-20 bg-white rounded-2xl px-4 py-3 shadow-xl border border-gray-100 flex items-center gap-3 animate-float" style="animation-delay: 0.4s;">
                        <div class="w-9 h-9 bg-brand-blue/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400 font-medium leading-none mb-1">Total Koleksi</div>
                            <div class="text-brand-navy font-bold text-base leading-none">99+ Buku</div>
                        </div>
                    </div>

                    {{-- Floating chip: Gratis --}}
                    <div class="absolute bottom-10 -left-6 z-20 bg-white rounded-2xl px-4 py-3 shadow-xl border border-gray-100 flex items-center gap-3 animate-float" style="animation-delay: 1s;">
                        <div class="w-9 h-9 bg-brand-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400 font-medium leading-none mb-1">Selalu</div>
                            <div class="text-brand-green font-bold text-base leading-none">Gratis 100%</div>
                        </div>
                    </div>

                    {{-- Dekorasi dot --}}
                    <div class="absolute -top-4 left-10 w-3 h-3 bg-brand-yellow rounded-full opacity-60 animate-float" style="animation-delay:0.3s;"></div>
                    <div class="absolute top-1/3 -right-6 w-2 h-2 bg-brand-green rounded-full opacity-50 animate-float" style="animation-delay:0.9s;"></div>
                </div>
            </div>

        </div>
    </div>

    {{-- Wave Divider --}}
    <div class="relative mt-6">
        <div class="wave-divider">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 30C360 60 720 0 1080 35C1260 52 1380 20 1440 30V60H0Z" fill="#F8FAFF"/>
            </svg>
        </div>
    </div>
</header>
