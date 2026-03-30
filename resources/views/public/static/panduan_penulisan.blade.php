@extends('public.layout.app')

@section('title', 'Panduan Penulisan Naskah — Serindit')
@section('description', 'Ketentuan dan panduan lengkap pengiriman naskah karya sastra dan budaya Melayu ke redaksi Serindit, Balai Bahasa Provinsi Riau.')

@section('content')

{{-- Hero Strip --}}
<div style="background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 100%); padding: 56px 0 40px;">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 text-white/80 text-[11px] font-black uppercase tracking-widest px-4 py-2 rounded-full mb-5">
            <i class="bi bi-journal-bookmark"></i> Kanal Naskah
        </div>
        <h1 class="text-3xl lg:text-4xl font-black text-white mb-3" style="font-family:'Playfair Display',serif;">
            Panduan Penulisan Naskah
        </h1>
        <p class="text-white/70 text-sm font-medium max-w-lg mx-auto">
            Baca ketentuan dan tata cara pengiriman naskah sebelum mengirimkan karya Anda ke Serindit.
        </p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 lg:px-6 py-12">

    {{-- Intro --}}
    <div class="mb-8 p-6 bg-green-50 border border-green-100 rounded-2xl">
        <p class="text-gray-700 text-sm leading-relaxed font-medium">
            Serindit membuka peluang bagi para penulis, sastrawan, dan pegiat budaya Melayu untuk mempublikasikan karyanya melalui majalah digital resmi Balai Bahasa Provinsi Riau. Kami menerima naskah berupa <strong>puisi, cerpen, pantun, syair, esai budaya, dan artikel kebahasaan</strong>.
        </p>
    </div>

    {{-- Panduan Cards --}}
    <div class="space-y-6">

        {{-- 1. Ketentuan Umum --}}
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-50" style="background:#f0fdf4;">
                <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#1e7b1c,#166534);display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-list-check text-white"></i>
                </div>
                <h2 class="font-black text-gray-900 text-[15px]">1. Ketentuan Umum</h2>
            </div>
            <div class="px-6 py-5">
                <ul class="space-y-3 text-sm text-gray-600 font-medium">
                    <li class="flex gap-3"><i class="bi bi-check-circle-fill text-green-500 mt-0.5 flex-shrink-0"></i> Naskah merupakan karya asli, bukan terjemahan, dan belum pernah dipublikasikan di media lain.</li>
                    <li class="flex gap-3"><i class="bi bi-check-circle-fill text-green-500 mt-0.5 flex-shrink-0"></i> Penulis menjamin keaslian karya dan bertanggung jawab penuh atas isi naskah.</li>
                    <li class="flex gap-3"><i class="bi bi-check-circle-fill text-green-500 mt-0.5 flex-shrink-0"></i> Naskah yang dikirimkan menjadi hak penerbitan Serindit.</li>
                    <li class="flex gap-3"><i class="bi bi-check-circle-fill text-green-500 mt-0.5 flex-shrink-0"></i> Redaksi berhak melakukan penyuntingan tanpa mengubah isi dan makna karya.</li>
                    <li class="flex gap-3"><i class="bi bi-check-circle-fill text-green-500 mt-0.5 flex-shrink-0"></i> Naskah yang tidak memenuhi syarat tidak akan diproses lebih lanjut.</li>
                </ul>
            </div>
        </div>

        {{-- 2. Format & Teknis --}}
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-50" style="background:#fffbeb;">
                <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-file-earmark-word text-white"></i>
                </div>
                <h2 class="font-black text-gray-900 text-[15px]">2. Format & Teknis Penulisan</h2>
            </div>
            <div class="px-6 py-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 font-medium">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="font-black text-gray-800 mb-2 text-[13px]"><i class="bi bi-file-earmark-text me-1"></i> Format File</p>
                        <p>Microsoft Word (.doc / .docx)</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="font-black text-gray-800 mb-2 text-[13px]"><i class="bi bi-fonts me-1"></i> Jenis & Ukuran Huruf</p>
                        <p>Times New Roman, 12pt</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="font-black text-gray-800 mb-2 text-[13px]"><i class="bi bi-layout-text-sidebar me-1"></i> Spasi & Margin</p>
                        <p>Spasi 1,5 — Margin normal (2,5 cm)</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="font-black text-gray-800 mb-2 text-[13px]"><i class="bi bi-card-text me-1"></i> Ukuran Kertas</p>
                        <p>A4 (21 × 29,7 cm)</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Jenis & Panjang Naskah --}}
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-50" style="background:#eff6ff;">
                <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-layers text-white"></i>
                </div>
                <h2 class="font-black text-gray-900 text-[15px]">3. Jenis & Panjang Naskah</h2>
            </div>
            <div class="px-6 py-5">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr style="background:#f0fdf4;">
                                <th class="text-left py-2 px-3 rounded-tl-lg font-black text-gray-800 text-[12px] uppercase tracking-wide">Jenis Naskah</th>
                                <th class="text-left py-2 px-3 font-black text-gray-800 text-[12px] uppercase tracking-wide">Panjang</th>
                                <th class="text-left py-2 px-3 rounded-tr-lg font-black text-gray-800 text-[12px] uppercase tracking-wide">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 font-medium">
                            <tr class="border-b border-gray-50">
                                <td class="py-2.5 px-3"><i class="bi bi-journal-text text-purple-500 me-1"></i> Puisi</td>
                                <td class="py-2.5 px-3">1–3 judul</td>
                                <td class="py-2.5 px-3">Tiap judul maks. 2 halaman</td>
                            </tr>
                            <tr class="border-b border-gray-50">
                                <td class="py-2.5 px-3"><i class="bi bi-book text-blue-500 me-1"></i> Cerpen</td>
                                <td class="py-2.5 px-3">1.500–5.000 kata</td>
                                <td class="py-2.5 px-3">Satu naskah per pengiriman</td>
                            </tr>
                            <tr class="border-b border-gray-50">
                                <td class="py-2.5 px-3"><i class="bi bi-music-note-beamed text-yellow-500 me-1"></i> Pantun & Syair</td>
                                <td class="py-2.5 px-3">5–20 bait</td>
                                <td class="py-2.5 px-3">Bertemakan budaya Melayu</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 px-3"><i class="bi bi-newspaper text-green-500 me-1"></i> Esai / Artikel</td>
                                <td class="py-2.5 px-3">1.000–3.000 kata</td>
                                <td class="py-2.5 px-3">Topik bahasa/budaya Melayu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- 4. Biodata Penulis --}}
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-50" style="background:#fdf4ff;">
                <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#a855f7,#7c3aed);display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-person-badge text-white"></i>
                </div>
                <h2 class="font-black text-gray-900 text-[15px]">4. Biodata Penulis</h2>
            </div>
            <div class="px-6 py-5">
                <p class="text-sm text-gray-600 font-medium mb-3">Sertakan biodata singkat di bagian akhir naskah, memuat:</p>
                <ul class="space-y-2 text-sm text-gray-600 font-medium">
                    <li class="flex gap-3"><i class="bi bi-person text-purple-500 mt-0.5"></i> Nama lengkap dan nama pena (jika ada)</li>
                    <li class="flex gap-3"><i class="bi bi-geo-alt text-purple-500 mt-0.5"></i> Kota domisili</li>
                    <li class="flex gap-3"><i class="bi bi-envelope text-purple-500 mt-0.5"></i> Email aktif dan nomor WhatsApp</li>
                    <li class="flex gap-3"><i class="bi bi-instagram text-purple-500 mt-0.5"></i> Akun media sosial (opsional)</li>
                </ul>
            </div>
        </div>

    </div>

    {{-- CTA Kirim Naskah --}}
    <div class="mt-10 text-center">
        <div class="inline-block bg-white border border-gray-100 rounded-2xl shadow-sm px-8 py-8">
            <div style="width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg,#1e7b1c,#166534);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <i class="bi bi-send-fill text-white text-xl"></i>
            </div>
            <h3 class="font-black text-gray-900 text-xl mb-2" style="font-family:'Playfair Display',serif;">Siap Mengirim Naskah?</h3>
            <p class="text-gray-500 text-sm mb-6 max-w-sm">Sudah baca panduan di atas? Klik tombol di bawah untuk langsung mengisi form pengiriman naskah.</p>
            <a href="{{ route('naskah.create') }}"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-black text-white text-sm"
               style="background:linear-gradient(135deg,#1e7b1c,#166534);box-shadow:0 8px 20px rgba(30,123,28,0.25);text-decoration:none;">
                <i class="bi bi-send"></i>
                Kirim Naskah Sekarang
            </a>
        </div>
    </div>

</div>

@endsection
