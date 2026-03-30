@extends('public.layout.app')

@section('title', 'Pantun Melayu — Serindit')
@section('description', 'Koleksi pantun Melayu pilihan beserta panduan cara menulis pantun yang baik dan benar.')

@section('styles')
<style>
    .genre-hero {
        background: linear-gradient(135deg, #4a044e 0%, #7e22ce 60%, #9333ea 100%);
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
    .pantun-card {
        border-left: 4px solid #9333ea;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .pantun-card:hover { box-shadow: 0 12px 32px rgba(147,51,234,0.12); transform: translateY(-3px); }

    .guide-step {
        counter-increment: guide-counter;
        position: relative;
    }
    .guide-step::before {
        content: counter(guide-counter);
        position: absolute; left: 0; top: 0;
        width: 32px; height: 32px;
        background: linear-gradient(135deg, #7e22ce, #9333ea);
        color: white; font-weight: 800; font-size: 13px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
    }
    .guide-list { counter-reset: guide-counter; }
    .tag-chip { background: #f3e8ff; color: #7e22ce; }

    .sampiran { color: #9333ea; font-weight: 600; }
    .isi { color: #1e293b; }
    .baris-label { font-size: 9px; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800; }
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
            <span class="text-white/90 text-xs font-bold px-3 py-1.5 bg-white/15 rounded-full">Pantun</span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-end gap-8">
            <div class="flex-1">
                <span class="inline-flex items-center gap-2 bg-purple-400/20 text-purple-200 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6 border border-purple-400/30" data-aos="fade-up">
                    <i class="bi bi-music-note-beamed"></i> Warisan Lisan Melayu
                </span>
                <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-4" style="font-family:'Playfair Display',serif;" data-aos="fade-up" data-aos-delay="100">
                    Pantun <span class="text-brand-yellow">Melayu</span>
                </h1>
                <p class="text-white/70 text-lg max-w-xl leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    Empat baris menyimpan ribuan makna. Pantun adalah identitas budaya Melayu yang telah diwarisi dari generasi ke generasi.
                </p>
            </div>
            <div class="flex gap-4 flex-shrink-0" data-aos="fade-left" data-aos-delay="200">
                <div class="text-center bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                    <div class="text-3xl font-bold text-brand-yellow">8</div>
                    <div class="text-white/60 text-xs font-medium mt-1">Contoh Pantun</div>
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
                    <div class="bg-gradient-to-br from-purple-50 to-fuchsia-50 rounded-2xl p-6 border border-purple-100 mb-6" data-aos="fade-right">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="bi bi-lightbulb text-purple-600"></i> Panduan Menulis Pantun
                        </h3>
                        <ol class="guide-list space-y-4">
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Pahami Struktur 4 Baris</strong><br>
                                Baris 1-2 = <span class="text-purple-600 font-semibold">Sampiran</span> (pembuka), baris 3-4 = <span class="font-semibold">Isi</span> (pesan).
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Gunakan Rima a-b-a-b</strong><br>
                                Akhiran baris 1 berima dengan baris 3, baris 2 berima dengan baris 4.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Sampiran dari Alam</strong><br>
                                Ambil sampiran dari fenomena alam, tumbuhan, atau aktivitas sehari-hari.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Isi = Pesan Utama</strong><br>
                                Sampaikan nasihat, cinta, atau sindiran dalam dua baris isi.
                            </li>
                            <li class="guide-step pl-10 text-sm text-gray-600 leading-relaxed">
                                <strong class="text-gray-800">Tiap Baris 8–12 Suku Kata</strong><br>
                                Perhatikan irama agar pantun enak diucapkan dan didengar.
                            </li>
                        </ol>
                    </div>

                    {{-- Diagram Struktur --}}
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm" data-aos="fade-right" data-aos-delay="100">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="bi bi-layout-text-sidebar text-purple-600"></i> Anatomi Pantun
                        </h3>
                        <div class="rounded-xl overflow-hidden border border-purple-100">
                            <div class="bg-purple-50 p-4 border-b border-purple-100">
                                <p class="baris-label text-purple-400 mb-1">Sampiran</p>
                                <p class="text-sm font-serif text-purple-800 italic">Kalau ada sumur di ladang,<br>boleh kita menumpang mandi;</p>
                            </div>
                            <div class="bg-white p-4">
                                <p class="baris-label text-gray-400 mb-1">Isi</p>
                                <p class="text-sm font-serif text-gray-800 italic">Kalau ada umur yang panjang,<br>boleh kita berjumpa lagi.</p>
                            </div>
                        </div>
                        <div class="mt-3 flex gap-3">
                            <div class="flex items-center gap-1.5 text-xs text-purple-600 font-medium">
                                <div class="w-3 h-3 bg-purple-100 rounded-sm border border-purple-200"></div>
                                Sampiran
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-gray-600 font-medium">
                                <div class="w-3 h-3 bg-white rounded-sm border border-gray-200"></div>
                                Isi / Makna
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Koleksi Pantun --}}
            <div class="lg:col-span-2 order-1 lg:order-2">
                <div class="flex items-center gap-3 mb-8" data-aos="fade-up">
                    <div class="h-1 w-8 bg-gradient-to-r from-purple-600 to-purple-400 rounded-full"></div>
                    <h2 class="text-lg font-bold text-gray-800">Koleksi Pantun Terpilih</h2>
                </div>

                {{-- Grid Pantun --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    @php
                    $pantuns = [
                        ['tema'=>'Nasihat','baris'=>['Buah cempedak di luar pagar,','ambil galah tolong jolokkan;','Saya budak baru belajar,','kalau salah tolong tunjukkan.']],
                        ['tema'=>'Adat','baris'=>['Kayu cendana di atas batu,','sudah diikat dibawa pulang;','Adat lembaga tidak berlalu,','namun zaman boleh berubah.']],
                        ['tema'=>'Cinta','baris'=>['Ke mana hendak ku tuju,','ke mana hendak ku berlabuh;','Hatiku hanya untukmu,','dalam setiap nafas dan kalbuku.']],
                        ['tema'=>'Semangat','baris'=>['Anak ayam turun sepuluh,','mati satu tinggal sembilan;','Bangun pagi menuntut ilmu,','biar pun lelah terus berjalan.']],
                        ['tema'=>'Kebersamaan','baris'=>['Pandan wangi pulau angsa,','tumbuh subur di tepi kali;','Hidup bersama saling merasa,','tolong-menolong sepanjang hari.']],
                        ['tema'=>'Alam','baris'=>['Burung merpati terbang tinggi,','hinggap di ranting pohon durian;','Wahai manusia sadari diri,','jaga alam titipan Tuhan.']],
                        ['tema'=>'Rindu','baris'=>['Bunga melur bunga cempaka,','harum baunya semerbak wangi;','Jauh di mata jauh di mata,','namun tetap dekat di hati.']],
                        ['tema'=>'Hormat','baris'=>['Pohon kelapa tumbuh condong,','akarnya kuat menghujam tanah;','Kepada orang tua kita mendong,','hormati selagi masih ada.']],
                    ];
                    @endphp

                    @foreach($pantuns as $i => $pantun)
                    <article class="pantun-card bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 75 }}">
                        <span class="tag-chip text-[11px] font-bold px-3 py-1 rounded-full inline-block mb-4">{{ $pantun['tema'] }}</span>
                        <div class="font-serif leading-[2.1] text-[14px]" style="font-family:'Playfair Display',serif;">
                            <p class="sampiran">{{ $pantun['baris'][0] }}<br>{{ $pantun['baris'][1] }}</p>
                            <p class="isi mt-2">{{ $pantun['baris'][2] }}<br>{{ $pantun['baris'][3] }}</p>
                        </div>
                    </article>
                    @endforeach

                </div>

                {{-- Back Button --}}
                <div class="pt-8" data-aos="fade-up">
                    <a href="{{ route('static.jejak_pena') }}" class="inline-flex items-center gap-2 text-purple-600 font-bold text-sm hover:gap-3 transition-all">
                        <i class="bi bi-arrow-left"></i> Kembali ke Jejak Pena
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
