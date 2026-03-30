@extends('public.layout.app')

@section('title', 'Syair Melayu — Serindit')
@section('description', 'Koleksi syair Melayu pilihan beserta panduan cara menulis syair yang sarat makna dan nilai budaya.')

@section('styles')
<style>
    .genre-hero {
        background: linear-gradient(135deg, #7c1a0a 0%, #c0421a 60%, #e8621e 100%);
        position: relative; overflow: hidden;
    }
    .genre-hero::before {
        content: ''; position: absolute; inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 32px 32px; pointer-events: none;
    }
    .genre-hero-wave { overflow: hidden; line-height: 0; }
    .genre-hero-wave svg { display: block; width: 100%; }

    .breadcrumb-chip {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
    }
    .syair-card {
        border-left: 4px solid #e8621e;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .syair-card:hover { box-shadow: 0 12px 32px rgba(232,98,30,0.12); transform: translateY(-3px); }

    .guide-step {
        counter-increment: guide-counter;
        position: relative;
    }
    .guide-step::before {
        content: counter(guide-counter);
        position: absolute; left: 0; top: 0;
        width: 32px; height: 32px;
        background: linear-gradient(135deg, #c0421a, #e8621e);
        color: white; font-weight: 800; font-size: 13px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
    }
    .guide-list { counter-reset: guide-counter; }
    .tag-chip { background: #ffedd5; color: #c0421a; }

    .beda-label { font-size: 9px; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800; }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="genre-hero pt-20 pb-0">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10 pb-16 relative z-10">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 mb-8" data-aos="fade-right">
            <a href="{{ route('static.jejak_pena') }}" class="breadcrumb-chip px-3 py-1.5 rounded-full text-white/70 text-xs font-medium hover:text-white transition flex items-center gap-1.5">
                <i class="bi bi-feather"></i> Jejak Pena
            </a>
            <i class="bi bi-chevron-right text-white/30 text-xs"></i>
            <span class="text-white/90 text-xs font-bold px-3 py-1.5 bg-white/15 rounded-full">Syair</span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-end gap-8">
            <div class="flex-1">
                <span class="inline-flex items-center gap-2 bg-orange-400/20 text-orange-200 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6 border border-orange-400/30" data-aos="fade-up">
                    <i class="bi bi-stars"></i> Puisi Lama Melayu
                </span>
                <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-4" style="font-family:'Playfair Display',serif;" data-aos="fade-up" data-aos-delay="100">
                    Syair <span class="text-brand-yellow">Melayu</span>
                </h1>
                <p class="text-white/70 text-lg max-w-xl leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    Puisi lama berbentuk berangkai dengan rima a-a-a-a — sarat nilai keagamaan, kepahlawanan, dan hikmat kehidupan.
                </p>
            </div>
            <div class="flex gap-4 flex-shrink-0" data-aos="fade-left" data-aos-delay="200">
                <div class="text-center bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                    <div class="text-3xl font-bold text-brand-yellow">4</div>
                    <div class="text-white/60 text-xs font-medium mt-1">Contoh Syair</div>
                </div>
                <div class="text-center bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                    <div class="text-3xl font-bold text-brand-yellow">5</div>
                    <div class="text-white/60 text-xs font-medium mt-1">Panduan Menulis</div>
                </div>
            </div>
        </div>
    </div>
    <div class="genre-hero-wave">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,0 1080,80 1440,30 L1440,60 L0,60 Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- Main Content --}}
<section class="py-16 bg-white">
    <div class="max-w-[1300px] mx-auto px-6 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- LEFT: Panduan --}}
            <div class="lg:col-span-1 order-2 lg:order-1">
                <div class="sticky top-28">
                    <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl p-6 border border-orange-100 mb-6" data-aos="fade-right">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="bi bi-lightbulb text-orange-600"></i> Panduan Menulis Syair
                        </h3>
                        <ol class="guide-list space-y-4">
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Pahami Ciri Khas Syair</strong><br>
                                Berbeda dengan pantun — syair tidak punya sampiran. Seluruh 4 baris adalah isi/makna.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Gunakan Rima a-a-a-a</strong><br>
                                Semua 4 baris harus berakhir dengan bunyi rima yang sama.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Setiap Bait = Satu Gagasan</strong><br>
                                Setiap rangkaian 4 baris mengandung satu pesan atau cerita utuh.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Angkat Tema yang Dalam</strong><br>
                                Religi, kepahlawanan, moral, atau kisah sejarah sangat cocok untuk syair.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Gunakan Bahasa Indah</strong><br>
                                Pilih diksi yang puitis, formal, dan kaya makna filosofis.
                            </li>
                        </ol>
                    </div>

                    {{-- Perbedaan Pantun vs Syair --}}
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" data-aos="fade-right" data-aos-delay="100">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="bi bi-arrows-collapse text-orange-600"></i> Pantun vs Syair
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-purple-50 rounded-xl p-3 border border-purple-100">
                                <p class="beda-label text-purple-500 mb-2">Pantun</p>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li class="flex items-start gap-1.5"><i class="bi bi-dot text-purple-500 text-base -mt-0.5 flex-shrink-0"></i>Ada sampiran</li>
                                    <li class="flex items-start gap-1.5"><i class="bi bi-dot text-purple-500 text-base -mt-0.5 flex-shrink-0"></i>Rima a-b-a-b</li>
                                    <li class="flex items-start gap-1.5"><i class="bi bi-dot text-purple-500 text-base -mt-0.5 flex-shrink-0"></i>4 baris per bait</li>
                                    <li class="flex items-start gap-1.5"><i class="bi bi-dot text-purple-500 text-base -mt-0.5 flex-shrink-0"></i>Pesan sindiran</li>
                                </ul>
                            </div>
                            <div class="bg-orange-50 rounded-xl p-3 border border-orange-100">
                                <p class="beda-label text-orange-500 mb-2">Syair</p>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li class="flex items-start gap-1.5"><i class="bi bi-dot text-orange-500 text-base -mt-0.5 flex-shrink-0"></i>Tidak ada sampiran</li>
                                    <li class="flex items-start gap-1.5"><i class="bi bi-dot text-orange-500 text-base -mt-0.5 flex-shrink-0"></i>Rima a-a-a-a</li>
                                    <li class="flex items-start gap-1.5"><i class="bi bi-dot text-orange-500 text-base -mt-0.5 flex-shrink-0"></i>Bait berangkai</li>
                                    <li class="flex items-start gap-1.5"><i class="bi bi-dot text-orange-500 text-base -mt-0.5 flex-shrink-0"></i>Pesan naratif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Contoh Syair --}}
            <div class="lg:col-span-2 order-1 lg:order-2 space-y-6">
                <div class="flex items-center gap-3 mb-6" data-aos="fade-up">
                    <div class="h-1 w-8 bg-gradient-to-r from-orange-600 to-orange-400 rounded-full"></div>
                    <h2 class="text-lg font-bold text-gray-800">Koleksi Syair Pilihan</h2>
                </div>

                {{-- Syair 1 --}}
                <article class="syair-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Syair Nasihat Kepada Anak</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penulis Riau Klasik</p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Nasihat</span>
                    </div>
                    <div class="font-serif text-gray-700 leading-[2.3] text-[14px] space-y-5 pl-4 border-l-2 border-orange-100" style="font-family:'Playfair Display',serif;">
                        <div>
                            <p>Wahai ananda dengarlah pesan,<br>
                            hidup di dunia penuh rintangan;<br>
                            Ilmu dan amal jadikan tumpuan,<br>
                            agar hati teguh dalam keimanan.</p>
                        </div>
                        <div>
                            <p>Hormat kepada ibu dan bapak,<br>
                            janganlah berlaku kasar dan lancang;<br>
                            Ridha ilahi di sana terletak,<br>
                            bila hati orang tua senang dan terancang.</p>
                        </div>
                        <div>
                            <p>Bergaul dengan orang yang saleh,<br>
                            jauhkan diri dari yang sesat;<br>
                            Apabila hati terjaga bersih,<br>
                            niscaya hidup penuh berkah dan nikmat.</p>
                        </div>
                    </div>
                </article>

                {{-- Syair 2 --}}
                <article class="syair-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Syair Tanah Melayu</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penulis Riau</p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Patriotik</span>
                    </div>
                    <div class="font-serif text-gray-700 leading-[2.3] text-[14px] space-y-5 pl-4 border-l-2 border-orange-100" style="font-family:'Playfair Display',serif;">
                        <div>
                            <p>Di bumi Melayu kita berpijak,<br>
                            adat dan budaya jangan diabaikan;<br>
                            Pusaka leluhur jangan dipecah,<br>
                            generasi muda wajib meneruskan.</p>
                        </div>
                        <div>
                            <p>Sungai Siak mengalir tenang,<br>
                            membawa cerita zaman berzaman;<br>
                            Tegakkan yang hak jangan gusar pun ragu,<br>
                            kebenaran itu pasti menang.</p>
                        </div>
                    </div>
                </article>

                {{-- Syair 3 --}}
                <article class="syair-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Syair Pemuda Beriman</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penulis Riau</p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Religi</span>
                    </div>
                    <div class="font-serif text-gray-700 leading-[2.3] text-[14px] space-y-5 pl-4 border-l-2 border-orange-100" style="font-family:'Playfair Display',serif;">
                        <div>
                            <p>Pemuda pemudi harapan bangsa,<br>
                            tanamkan iman di dada jiwa;<br>
                            Jangan tersesat di jalan yang sia,<br>
                            selamat dunia akhirat adalah cita.</p>
                        </div>
                        <div>
                            <p>Sekolah tinggi taklah berguna,<br>
                            bila akhlak dan budi diabaikan;<br>
                            Ilmu tanpa iman umpama pedang,<br>
                            tajam namun melukai diri sendiri pula.</p>
                        </div>
                    </div>
                </article>

                {{-- Syair 4 --}}
                <article class="syair-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Syair Keindahan Alam Riau</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penulis Riau</p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Alam</span>
                    </div>
                    <div class="font-serif text-gray-700 leading-[2.3] text-[14px] space-y-5 pl-4 border-l-2 border-orange-100" style="font-family:'Playfair Display',serif;">
                        <div>
                            <p>Rimba Riau hijau membentang,<br>
                            kicau burung mengisi pagi;<br>
                            Di sanalah kita berpanjang-panjang,<br>
                            merasakan nikmat sang Pencipta Sejati.</p>
                        </div>
                        <div>
                            <p>Jaga hutan jaga sungai kita,<br>
                            anak cucu berhak warisan;<br>
                            Bila alam rusak binasa semua,<br>
                            tanggungjawab ada di bahu kita bersama.</p>
                        </div>
                    </div>
                </article>

                {{-- Back Button --}}
                <div class="pt-4" data-aos="fade-up">
                    <a href="{{ route('static.jejak_pena') }}" class="inline-flex items-center gap-2 text-orange-600 font-bold text-sm hover:gap-3 transition-all">
                        <i class="bi bi-arrow-left"></i> Kembali ke Jejak Pena
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
