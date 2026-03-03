@extends('public.layout.app')

@section('title', 'Tentang Serindit — Perpustakaan Digital BBPR')

@section('description', 'Pelajari lebih lanjut tentang Serindit, platform membaca buku digital gratis dari Balai Bahasa Provinsi Riau untuk seluruh masyarakat Indonesia.')

@push('styles')
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
    @keyframes float-slow {
        0%, 100% { transform: translateY(0) rotate(0); }
        50% { transform: translateY(-15px) rotate(-5deg); }
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-float-slow {
        animation: float-slow 8s ease-in-out infinite;
    }
</style>
@endpush

@section('content')
{{-- ══ HERO SECTION ══ --}}
<div class="bg-gradient-to-br from-[#1E40AF] via-[#2563EB] to-[#1D4ED8] py-20 lg:py-32 relative overflow-hidden">
    {{-- Floating Decorative Icons --}}
    <div class="absolute top-1/4 left-10 lg:left-20 animate-float opacity-50 pointer-events-none">
        <i class="bi bi-book-fill text-6xl text-white"></i>
    </div>
    <div class="absolute bottom-1/4 right-10 lg:right-24 animate-float-slow opacity-50 pointer-events-none">
        <i class="bi bi-feather text-5xl text-brand-yellow2"></i>
    </div>
    <div class="absolute top-1/3 right-15 lg:right-40 animate-float opacity-50 pointer-events-none">
        <i class="bi bi-journals text-7xl text-white"></i>
    </div>
    <div class="absolute bottom-10 left-1/4 animate-float-slow opacity-50 pointer-events-none">
        <i class="bi bi-stars text-4xl text-white"></i>
    </div>
    <div class="absolute top-10 right-1/4 animate-float opacity-50 pointer-events-none hidden lg:block">
        <i class="bi bi-pen-fill text-6xl text-brand-yellow2"></i>
    </div>

    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-white/5 backdrop-blur-sm border border-white/10 px-6 py-2 rounded-full mb-8">
            <span class="text-xs font-black uppercase tracking-[0.3em] text-blue-200">Platform Literasi Digital</span>
        </div>
        <h1 class="text-5xl lg:text-7xl font-black text-white mb-6 leading-tight tracking-tight">
            Tentang <span class="text-brand-yellow">Serindit</span>
        </h1>
        <p class="text-lg lg:text-xl text-blue-100/80 font-medium leading-relaxed max-w-2xl mx-auto">
            Mengenal lebih dekat Serindit — platform perpustakaan digital yang hadir untuk memajukan budaya literasi di Provinsi Riau dan seluruh Indonesia.
        </p>
    </div>
</div>

<div class="bg-[#F8FAFF] pt-24 pb-0 -mt-10 rounded-t-[3rem] relative z-20">
    <div class="max-w-6xl mx-auto px-6">
        
        {{-- ══ PENJELASAN APLIKASI ══ --}}
        <div class="grid lg:grid-cols-12 gap-12 items-center mb-32">
            <div class="lg:col-span-7 relative">
                <div class="absolute inset-0 bg-brand-blue/5 rounded-[3rem] -rotate-2 scale-105"></div>
                <div class="relative bg-white p-10 lg:p-14 rounded-[3rem] shadow-xl border border-blue-50">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-4 bg-brand-blue/10 rounded-2xl text-3xl">
                            <i class="bi bi-journal-text text-brand-blue"></i>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-brand-navy">Apa itu Serindit?</h2>
                    </div>
                    
                    <div class="space-y-6 text-gray-600 text-lg leading-relaxed font-medium">
                        <p>
                            <span class="text-brand-blue font-bold">Serindit</span> adalah platform perpustakaan digital yang dikembangkan oleh <span class="text-brand-navy font-bold">Balai Bahasa Provinsi Riau</span> untuk mendukung pertumbuhan literasi masyarakat di era digital.
                        </p>
                        <p>
                            Serindit hadir sebagai jembatan yang mempermudah akses ke ribuan koleksi buku digital, mulai dari karya sastra lokal, ensiklopedia, hingga buku pengetahuan umum yang dapat dinikmati oleh semua kalangan.
                        </p>
                        <p class="text-sm border-l-4 border-brand-yellow pl-5 py-1 italic text-gray-400">
                            Nama "Serindit" terinspirasi dari burung Serindit, burung ikonik Provinsi Riau yang mencerminkan keanggunan dan kearifan lokal Melayu.
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-all group">
                    <div class="bg-green-100 p-4 rounded-2xl text-2xl group-hover:scale-110 transition-transform">🦜</div>
                    <div>
                        <h4 class="font-black text-brand-navy mb-1 text-lg">Kearifan Lokal</h4>
                        <p class="text-sm font-medium text-gray-400">Merayakan budaya dan sastra Melayu Riau.</p>
                    </div>
                </div>
                <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-all group">
                    <div class="bg-yellow-100 p-4 rounded-2xl text-2xl group-hover:scale-110 transition-transform">📚</div>
                    <div>
                        <h4 class="font-black text-brand-navy mb-1 text-lg">Koleksi Lengkap</h4>
                        <p class="text-sm font-medium text-gray-400">Ribuan judul buku untuk semua kalangan.</p>
                    </div>
                </div>
                <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-all group">
                    <div class="bg-purple-100 p-4 rounded-2xl text-2xl group-hover:scale-110 transition-transform">🌐</div>
                    <div>
                        <h4 class="font-black text-brand-navy mb-1 text-lg">Akses Gratis</h4>
                        <p class="text-sm font-medium text-gray-400">Dedikasi penuh untuk kemajuan literasi.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ VISI MISI ══ --}}
        <div class="mb-32">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-black text-brand-navy mb-4">Visi &amp; Misi <span class="text-brand-blue">Serindit</span></h2>
                <p class="text-gray-500 font-bold">Landasan kami dalam membangun ekosistem literasi digital.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Visi --}}
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-blue-50 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-brand-blue/[0.03] rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-brand-blue/10 rounded-2xl text-2xl">
                            <i class="bi bi-eye-fill text-brand-blue"></i>
                        </div>
                        <h3 class="text-2xl font-black text-brand-navy">Visi</h3>
                    </div>
                    <p class="text-gray-600 font-medium leading-relaxed">
                        Menjadi platform literasi digital terdepan yang menghubungkan masyarakat Riau dan Indonesia dengan kekayaan pengetahuan, budaya, dan sastra Melayu secara mudah dan merata.
                    </p>
                </div>

                {{-- Misi --}}
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-yellow-50 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-brand-yellow2/[0.03] rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-yellow-100 rounded-2xl text-2xl">
                            <i class="bi bi-bullseye text-brand-yellow2"></i>
                        </div>
                        <h3 class="text-2xl font-black text-brand-navy">Misi</h3>
                    </div>
                    <ul class="space-y-3 text-gray-600 font-medium">
                        <li class="flex items-start gap-3">
                            <span class="w-2 h-2 bg-brand-yellow2 rounded-full mt-2 flex-shrink-0"></span>
                            Menyediakan koleksi buku digital berkualitas secara gratis dan terbuka.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-2 h-2 bg-brand-yellow2 rounded-full mt-2 flex-shrink-0"></span>
                            Melestarikan dan mempromosikan budaya serta sastra Melayu Riau.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-2 h-2 bg-brand-yellow2 rounded-full mt-2 flex-shrink-0"></span>
                            Mendorong kebiasaan membaca pada seluruh lapisan masyarakat.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- ══ DEVELOPER SECTION ══ --}}
        <div class="max-w-5xl mx-auto mt-8 mb-12">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 bg-blue-50 text-brand-blue px-5 py-2 rounded-full mb-4">
                    <span class="animate-pulse">💻</span>
                    <span class="text-[11px] font-black uppercase tracking-[0.2em]">Tim Pengembang Sistem</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-brand-navy tracking-tight">Tim <span class="text-brand-blue">Serindit</span></h2>
                <p class="text-gray-500 font-medium mt-4 max-w-xl mx-auto">Orang-orang berdedikasi di balik pengembangan platform Serindit.</p>
            </div>

            {{-- Developer Cards Grid --}}
            <div class="grid md:grid-cols-3 gap-8">

                {{-- Developer 1: Si A --}}
                <div class="group bg-white rounded-[2.5rem] shadow-sm border border-blue-50 p-8 text-center hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-blue/[0.03] rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    {{-- Avatar Inisial --}}
                    <div class="w-24 h-24 mx-auto mb-6 rounded-[1.5rem] bg-gradient-to-br from-brand-blue to-blue-700 flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform">
                        <span class="text-3xl font-black text-white">A</span>
                    </div>
                    <h3 class="text-xl font-black text-brand-navy mb-1">Si A</h3>
                    <p class="text-brand-blue font-extrabold text-sm mb-5">Pengembang Sistem</p>
                    <div class="bg-gray-50 rounded-2xl p-5 text-left relative">
                        <i class="bi bi-quote text-3xl text-brand-blue/10 absolute top-2 left-2"></i>
                        <p class="text-gray-500 font-medium leading-relaxed text-sm italic relative z-10 px-2">
                            "Berkontribusi dalam pengembangan platform Serindit untuk menghadirkan pengalaman membaca digital yang modern dan mudah diakses oleh seluruh masyarakat."
                        </p>
                    </div>
                </div>

                {{-- Developer 2: Si B --}}
                <div class="group bg-white rounded-[2.5rem] shadow-sm border border-yellow-50 p-8 text-center hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-yellow2/[0.05] rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    {{-- Avatar Inisial --}}
                    <div class="w-24 h-24 mx-auto mb-6 rounded-[1.5rem] bg-gradient-to-br from-brand-yellow2 to-yellow-500 flex items-center justify-center shadow-lg shadow-yellow-500/20 group-hover:scale-105 transition-transform">
                        <span class="text-3xl font-black text-white">B</span>
                    </div>
                    <h3 class="text-xl font-black text-brand-navy mb-1">Si B</h3>
                    <p class="text-brand-yellow2 font-extrabold text-sm mb-5">Desainer & Frontend</p>
                    <div class="bg-gray-50 rounded-2xl p-5 text-left relative">
                        <i class="bi bi-quote text-3xl text-brand-yellow2/10 absolute top-2 left-2"></i>
                        <p class="text-gray-500 font-medium leading-relaxed text-sm italic relative z-10 px-2">
                            "Merancang tampilan Serindit agar terasa elegan, nyaman, dan menarik bagi semua pengguna dari berbagai kalangan usia."
                        </p>
                    </div>
                </div>

                {{-- Developer 3: Si C --}}
                <div class="group bg-white rounded-[2.5rem] shadow-sm border border-green-50 p-8 text-center hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/[0.03] rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    {{-- Avatar Inisial --}}
                    <div class="w-24 h-24 mx-auto mb-6 rounded-[1.5rem] bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-green-500/20 group-hover:scale-105 transition-transform">
                        <span class="text-3xl font-black text-white">C</span>
                    </div>
                    <h3 class="text-xl font-black text-brand-navy mb-1">Si C</h3>
                    <p class="text-green-600 font-extrabold text-sm mb-5">Backend & Database</p>
                    <div class="bg-gray-50 rounded-2xl p-5 text-left relative">
                        <i class="bi bi-quote text-3xl text-green-500/10 absolute top-2 left-2"></i>
                        <p class="text-gray-500 font-medium leading-relaxed text-sm italic relative z-10 px-2">
                            "Memastikan seluruh sistem Serindit berjalan lancar, aman, dan mampu melayani ribuan pengguna dengan performa terbaik."
                        </p>
                    </div>
                </div>

            </div>
        </div>

        
    </div> {{-- Close max-w-6xl --}}

    {{-- ══ FULL-WIDTH CTA SECTION ══ --}}
    <div class="relative mt-24">
        <div class="bg-gradient-to-br from-[#1E40AF] via-[#1D4ED8] to-[#1E3A8A] rounded-t-[4rem] rounded-b-none p-12 lg:p-20 text-center text-white relative overflow-hidden shadow-2xl">
            {{-- Decorative circles --}}
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-brand-yellow2/5 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto">
                <div class="inline-block p-4 bg-white/10 backdrop-blur-md rounded-3xl mb-8 animate-float">
                    <i class="bi bi-book-fill text-4xl text-brand-yellow2"></i>
                </div>
                <h3 class="text-3xl lg:text-5xl font-black mb-6 leading-tight tracking-tight">
                    Mulai Petualangan <br> <span class="text-brand-yellow2">Literasi Bersamamu!</span>
                </h3>
                <p class="text-blue-100/80 text-lg font-medium mb-12 max-w-2xl mx-auto leading-relaxed">
                    Serindit menyediakan ribuan koleksi buku digital yang siap menemanimu belajar dan berkembang. Jelajahi sekarang, gratis untuk semua!
                </p>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="{{ route('book.list') }}" class="group bg-brand-yellow2 text-brand-navy font-black px-10 py-4 rounded-2xl shadow-xl shadow-yellow-600/30 hover:scale-105 hover:-translate-y-1 transition-all flex items-center gap-3 text-base">
                        Jelajahi Koleksi
                        <i class="bi bi-arrow-right-circle-fill text-xl group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('home') }}" class="group bg-white/10 backdrop-blur-md text-white font-black px-10 py-4 rounded-2xl border border-white/20 hover:bg-white/20 transition-all flex items-center gap-3 text-base">
                        <i class="bi bi-house-door-fill text-lg"></i>
                        Kembali Ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> {{-- Close bg-[#F8FAFF] --}}
@endsection
