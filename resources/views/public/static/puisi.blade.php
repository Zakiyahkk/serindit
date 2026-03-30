@extends('public.layout.app')

@section('title', 'Koleksi Puisi — Serindit')
@section('description', 'Nikmati bait-bait puisi terbaik dari para penulis Riau Melayu. Panduan penulisan dan contoh puisi pilihan.')

@section('styles')
<style>
    .genre-hero {
        background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 60%, #27AE60 100%);
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
    .puisi-card {
        border-left: 4px solid #1e7b1c;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .puisi-card:hover { box-shadow: 0 12px 32px rgba(30,123,28,0.12); transform: translateY(-3px); }

    .guide-step {
        counter-increment: guide-counter;
        position: relative;
    }
    .guide-step::before {
        content: counter(guide-counter);
        position: absolute; left: 0; top: 0;
        width: 32px; height: 32px;
        background: linear-gradient(135deg, #1e7b1c, #27AE60);
        color: white; font-weight: 800; font-size: 13px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
    }
    .guide-list { counter-reset: guide-counter; }

    .tag-chip { background: #dcfce7; color: #1e7b1c; }
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
            <span class="text-white/90 text-xs font-bold px-3 py-1.5 bg-white/15 rounded-full">Puisi</span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-end gap-8">
            <div class="flex-1">
                <span class="inline-flex items-center gap-2 bg-green-400/20 text-green-200 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6 border border-green-400/30" data-aos="fade-up">
                    <i class="bi bi-journal-text"></i> Genre Sastra
                </span>
                <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-4" style="font-family:'Playfair Display',serif;" data-aos="fade-up" data-aos-delay="100">
                    Koleksi <span class="text-brand-yellow">Puisi</span>
                </h1>
                <p class="text-white/70 text-lg max-w-xl leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    Ungkapkan rasa melalui diksi yang tepat, metafora yang dalam, dan irama yang mengalun bebas dari jiwa penyair.
                </p>
            </div>
            <div class="flex gap-4 flex-shrink-0" data-aos="fade-left" data-aos-delay="200">
                <div class="text-center bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                    <div class="text-3xl font-bold text-brand-yellow">4</div>
                    <div class="text-white/60 text-xs font-medium mt-1">Contoh Karya</div>
                </div>
                <div class="text-center bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                    <div class="text-3xl font-bold text-brand-yellow">6</div>
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
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100 mb-6" data-aos="fade-right">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="bi bi-lightbulb text-brand-green"></i> Panduan Menulis Puisi
                        </h3>
                        <ol class="guide-list space-y-4">
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Tentukan Tema & Perasaan</strong><br>
                                Pilih satu emosi atau pesan utama yang ingin disampaikan.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Gunakan Diksi yang Kuat</strong><br>
                                Pilih kata yang tepat, berima indah, dan penuh makna.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Bangun Imaji Visual</strong><br>
                                Gambarkan dengan detail agar pembaca bisa merasakannya.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Pakai Majas & Metafora</strong><br>
                                Personifikasi, simile, dan metafora memperkaya makna.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Perhatikan Irama</strong><br>
                                Baca keras-keras untuk rasakan aliran bunyi setiap baris.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Revisi & Perbaiki</strong><br>
                                Puisi terbaik lahir dari proses pengeditan yang teliti.
                            </li>
                        </ol>
                    </div>

                    {{-- Ciri-ciri --}}
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" data-aos="fade-right" data-aos-delay="100">
                        <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="bi bi-check-circle text-brand-green"></i> Ciri-ciri Puisi
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag-chip text-xs font-bold px-3 py-1 rounded-full">Diksi kuat</span>
                            <span class="tag-chip text-xs font-bold px-3 py-1 rounded-full">Irama bebas</span>
                            <span class="tag-chip text-xs font-bold px-3 py-1 rounded-full">Imaji visual</span>
                            <span class="tag-chip text-xs font-bold px-3 py-1 rounded-full">Majas & simbol</span>
                            <span class="tag-chip text-xs font-bold px-3 py-1 rounded-full">Padat makna</span>
                            <span class="tag-chip text-xs font-bold px-3 py-1 rounded-full">Emosional</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Contoh Puisi --}}
            <div class="lg:col-span-2 order-1 lg:order-2 space-y-6">
                <div data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-1 w-8 bg-gradient-to-r from-brand-blue to-brand-green rounded-full"></div>
                        <h2 class="text-lg font-bold text-gray-800">Contoh Karya Pilihan</h2>
                    </div>
                </div>

                {{-- Puisi 1 --}}
                <article class="puisi-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Hujan di Negeri Melayu</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penyair Riau</p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Puisi Lirik</span>
                    </div>
                    <div class="font-serif text-gray-700 leading-[2.2] text-[15px] space-y-4 pl-4 border-l-2 border-green-100" style="font-family:'Playfair Display',serif;">
                        <p>Hujan turun membasahi bumi,<br>
                        memeluk tanah yang lama rindu.<br>
                        Di sini aku berdiri sendiri,<br>
                        mengeja nama dalam gerimis yang syahdu.</p>

                        <p>Akar pohon sungkai menjalar,<br>
                        seperti ingatan yang tak mau pergi.<br>
                        Angin sungai berbisik keras,<br>
                        tentang masa yang telah berlari.</p>

                        <p>Biarlah hujan mencuci luka,<br>
                        dan embun malam menyembuhkan duka.<br>
                        Sebab negeri ini menyimpan cerita,<br>
                        di setiap tetes, di setiap kata.</p>
                    </div>
                </article>

                {{-- Puisi 2 --}}
                <article class="puisi-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Sungai Siak Bercerita</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penyair Riau</p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Puisi Naratif</span>
                    </div>
                    <div class="font-serif text-gray-700 leading-[2.2] text-[15px] space-y-4 pl-4 border-l-2 border-green-100" style="font-family:'Playfair Display',serif;">
                        <p>Sungai Siak mengalir tenang,<br>
                        membawa kisah dari hulu ke hilir.<br>
                        Di tepiannya para nelayan bertahang,<br>
                        menunggu rezeki yang tak pernah terlambat tiba.</p>

                        <p>O, Siak — saksi bisu peradaban,<br>
                        di airmu tersimpan sejarah Melayu.<br>
                        Istana berdiri penuh keanggunan,<br>
                        mengingatkan kita: bangsa yang berbudaya tidak layu.</p>
                    </div>
                </article>

                {{-- Puisi 3 --}}
                <article class="puisi-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Ibu</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penyair Riau</p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Puisi Elegi</span>
                    </div>
                    <div class="font-serif text-gray-700 leading-[2.2] text-[15px] space-y-4 pl-4 border-l-2 border-green-100" style="font-family:'Playfair Display',serif;">
                        <p>Tanganmu kasar oleh waktu,<br>
                        namun sentuhannya selalu hangat.<br>
                        Di setiap kerutan kutemu cinta,<br>
                        yang tak pernah mengenal kata batas.</p>

                        <p>Ibu, doamu adalah langit,<br>
                        menaungi aku dari hujan dan badai.<br>
                        Namamu kusebut ketika tersesat,<br>
                        dan jalan pulang selalu terbuka kembali.</p>
                    </div>
                </article>

                {{-- Puisi 4 --}}
                <article class="puisi-card bg-white rounded-2xl p-8 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold font-serif text-gray-900 mb-1" style="font-family:'Playfair Display',serif;">Hutan Rimba Riau</h3>
                            <p class="text-sm text-gray-400 font-medium">Karya: Penyair Riau</p>
                        </div>
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0">Puisi Alam</span>
                    </div>
                    <div class="font-serif text-gray-700 leading-[2.2] text-[15px] space-y-4 pl-4 border-l-2 border-green-100" style="font-family:'Playfair Display',serif;">
                        <p>Di rimba raya kau berdiri megah,<br>
                        pohon-pohon tua menjaga rahasia.<br>
                        Burung hinggap tanpa rasa lelah,<br>
                        bernyanyi untuk semesta yang bahagia.</p>

                        <p>Lindungi kami, wahai rimba,<br>
                        dengan naungan daun yang rindang.<br>
                        Kau warisan yang tak ternilai harganya,<br>
                        bagi anak cucu yang akan datang.</p>
                    </div>
                </article>

                {{-- Back Button --}}
                <div class="pt-4" data-aos="fade-up">
                    <a href="{{ route('static.jejak_pena') }}" class="inline-flex items-center gap-2 text-brand-blue font-bold text-sm hover:gap-3 transition-all">
                        <i class="bi bi-arrow-left"></i> Kembali ke Jejak Pena
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
