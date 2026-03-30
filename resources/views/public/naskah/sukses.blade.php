@extends('public.layout.app')

@section('title', 'Naskah Berhasil Dikirim — Serindit')

@section('content')

<div class="min-h-[70vh] flex items-center justify-center px-4 py-16">
    <div class="text-center max-w-lg">

        {{-- Icon Sukses Animasi --}}
        <div class="relative inline-flex items-center justify-center mb-8">
            <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#1e7b1c,#166534);display:flex;align-items:center;justify-content:center;box-shadow:0 16px 40px rgba(30,123,28,0.3);">
                <i class="bi bi-check2-circle" style="font-size:40px;color:#fff;"></i>
            </div>
            <div style="position:absolute;width:120px;height:120px;border-radius:50%;border:3px solid rgba(30,123,28,0.2);animation:pulseRing 2s ease-in-out infinite;"></div>
        </div>

        <h1 class="text-3xl font-black text-gray-900 mb-3" style="font-family:'Playfair Display',serif;">
            Naskah Berhasil Dikirim!
        </h1>

        <p class="text-gray-500 text-base font-medium mb-2">
            Terima kasih, <strong class="text-brand-blue">{{ session('nama_pengirim', 'Penulis') }}</strong>! 🎉
        </p>
        <p class="text-gray-400 text-sm mb-8 max-w-sm mx-auto leading-relaxed">
            Naskah Anda telah kami terima dan sedang dalam proses peninjauan oleh tim redaksi Serindit. Kami akan menghubungi Anda melalui email atau WhatsApp jika ada perkembangan.
        </p>

        {{-- Info Card --}}
        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:16px;padding:20px 24px;margin-bottom:32px;text-align:left;">
            <p class="text-[12px] font-black text-brand-blue uppercase tracking-widest mb-3">
                <i class="bi bi-info-circle me-1"></i> Informasi Selanjutnya
            </p>
            <ul class="space-y-2 text-sm text-gray-600 font-medium">
                <li class="flex gap-2"><i class="bi bi-envelope text-brand-blue mt-0.5 flex-shrink-0"></i> Konfirmasi akan dikirim ke email Anda dalam 1–3 hari kerja.</li>
                <li class="flex gap-2"><i class="bi bi-whatsapp text-green-600 mt-0.5 flex-shrink-0"></i> Tim redaksi mungkin menghubungi via WhatsApp jika diperlukan.</li>
                <li class="flex gap-2"><i class="bi bi-clock text-brand-blue mt-0.5 flex-shrink-0"></i> Proses seleksi naskah membutuhkan waktu 7–14 hari kerja.</li>
            </ul>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('naskah.create') }}"
               style="display:inline-flex;align-items:center;gap:8px;padding:13px 28px;background:linear-gradient(135deg,#1e7b1c,#166534);color:#fff;border-radius:12px;font-weight:800;font-size:14px;text-decoration:none;box-shadow:0 8px 20px rgba(30,123,28,0.25);">
                <i class="bi bi-plus-circle"></i> Kirim Naskah Lain
            </a>
            <a href="{{ route('home') }}"
               style="display:inline-flex;align-items:center;gap:8px;padding:13px 28px;background:#fff;color:#374151;border:2px solid #e5e7eb;border-radius:12px;font-weight:700;font-size:14px;text-decoration:none;">
                <i class="bi bi-house"></i> Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

<style>
@keyframes pulseRing {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.15); opacity: 0; }
}
</style>

@endsection
