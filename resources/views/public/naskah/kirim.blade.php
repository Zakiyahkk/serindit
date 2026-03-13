@extends('public.layout.app')

@section('title', 'Kirim Naskah — Serindit')
@section('description', 'Kirimkan naskah karya sastra dan budaya Melayu Anda ke tim redaksi Serindit, Balai Bahasa Provinsi Riau.')

@section('styles')
<style>
.upload-zone { cursor: pointer; position: relative; overflow: hidden; transition: all .25s; }
.upload-zone:hover { background: #dcfce7 !important; border-color: #16a34a !important; }
.upload-zone.drag-active { background: #dcfce7 !important; border-color: #16a34a !important; }
.upload-zone input[type=file] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; z-index:2; }
.upload-icon-wrap { transition: transform .25s; }
.upload-zone:hover .upload-icon-wrap { transform: translateY(-4px) scale(1.05); }
.file-selected { display: none; }
.file-selected.show { display: flex; }
.kn-input {
    width: 100%;
    padding: 11px 15px;
    border: 1.5px solid #d1fae5;
    border-radius: 12px;
    font-size: 14px;
    color: #111827;
    background: #fafffe;
    transition: border-color .2s, box-shadow .2s;
    outline: none;
    font-family: 'Inter', sans-serif;
    box-sizing: border-box;
}
.kn-input:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
    background: #fff;
}
.kn-input.padl { padding-left: 40px; }
.kn-input.err { border-color: #ef4444 !important; background: #fff5f5; }
.kn-label { font-size: 11.5px; font-weight: 800; color: #374151; text-transform: uppercase; letter-spacing: .07em; display: flex; align-items: center; gap: 5px; margin-bottom: 7px; }
.kn-label .req { color: #ef4444; }
.kn-label .opt { font-size: 10px; font-weight: 600; color: #9ca3af; text-transform: none; letter-spacing: 0; background: #f3f4f6; padding: 2px 8px; border-radius: 999px; }
.kn-field { margin-bottom: 16px; }
.kn-field:last-child { margin-bottom: 0; }
.field-wrap { position: relative; }
.field-ico { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); font-size: 14px; pointer-events: none; }
.kn-errmsg { font-size: 11.5px; color: #ef4444; font-weight: 700; margin-top: 5px; display: flex; align-items: center; gap: 4px; }
.step-badge {
    width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 900;
}
@keyframes btnSpin { to { transform: rotate(360deg); } }
.btn-spinner { display: inline-block; width: 16px; height: 16px; border: 2.5px solid rgba(255,255,255,0.3); border-top-color: #fff; border-radius: 50%; animation: btnSpin .8s linear infinite; }
</style>
@endsection

@section('content')

{{-- ═══ HERO ═══ --}}
<div style="background: linear-gradient(135deg,#052e05 0%,#0b3d0a 40%,#1e7b1c 100%); padding: 60px 20px 90px; position: relative; overflow: hidden;">
    {{-- Decorative dots --}}
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle,rgba(255,255,255,0.04) 1px,transparent 1px);background-size:30px 30px;pointer-events:none;"></div>
    <div style="position:absolute;top:-80px;right:-80px;width:360px;height:360px;background:radial-gradient(circle,rgba(245,166,35,0.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>

    <div style="max-width:620px; margin:0 auto; text-align:center; position:relative; z-index:2;">

        {{-- Badge --}}
        <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,0.15);border:1px solid rgba(245,166,35,0.3);color:#F5A623;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:0.15em;padding:7px 18px;border-radius:999px;margin-bottom:20px;">
            <i class="bi bi-envelope-paper-fill"></i> Kanal Naskah
        </div>

        <h1 style="font-family:'Playfair Display',serif;font-size:clamp(26px,4.5vw,42px);font-weight:900;color:#fff;margin:0 0 12px;line-height:1.2;">
            Kirim Naskah Anda
        </h1>
        <p style="color:rgba(255,255,255,0.6);font-size:14px;font-weight:500;margin:0 0 40px;line-height:1.7;max-width:420px;margin-left:auto;margin-right:auto;">
            Isi form di bawah dengan lengkap. Tidak perlu akun — identitas Anda cukup diisi langsung di sini.
        </p>

        {{-- Steps --}}
        <div style="display:flex;align-items:center;justify-content:center;gap:0;">
            <div style="display:flex;flex-direction:column;align-items:center;gap:6px;">
                <div class="step-badge" style="background:#F5A623;color:#fff;box-shadow:0 0 0 6px rgba(245,166,35,0.2);">
                    <i class="bi bi-person-fill"></i>
                </div>
                <span style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:#F5A623;">Data Diri</span>
            </div>
            <div style="width:72px;height:2px;background:rgba(255,255,255,0.15);margin:0 8px 20px;"></div>
            <div style="display:flex;flex-direction:column;align-items:center;gap:6px;">
                <div class="step-badge" style="background:rgba(255,255,255,0.15);color:rgba(255,255,255,0.7);">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <span style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.5);">Naskah</span>
            </div>
            <div style="width:72px;height:2px;background:rgba(255,255,255,0.15);margin:0 8px 20px;"></div>
            <div style="display:flex;flex-direction:column;align-items:center;gap:6px;">
                <div class="step-badge" style="background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.3);">
                    <i class="bi bi-send-fill"></i>
                </div>
                <span style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.3);">Kirim</span>
            </div>
        </div>

    </div>
</div>

{{-- ═══ BODY ═══ --}}
<div style="max-width:1020px;margin:-50px auto 60px;padding:0 16px;position:relative;z-index:10;">

    {{-- Error Alert --}}
    @if($errors->any())
    <div style="background:#fef2f2;border:1.5px solid #fecaca;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;gap:12px;">
        <i class="bi bi-exclamation-triangle-fill" style="color:#ef4444;font-size:18px;flex-shrink:0;margin-top:1px;"></i>
        <div>
            <p style="font-weight:800;color:#991b1b;font-size:13px;margin:0 0 4px;">Terdapat kesalahan, mohon perbaiki:</p>
            <ul style="margin:0;padding-left:16px;">
                @foreach($errors->all() as $err)
                    <li style="color:#ef4444;font-size:12.5px;font-weight:600;">{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- Two-Column Grid --}}
    <div style="display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1.45fr);gap:22px;align-items:start;">

        @php $isSmall = false; @endphp

        {{-- ══ SIDEBAR ══ --}}
        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- Card: Ketentuan --}}
            <div style="background:#fff;border-radius:20px;border:1px solid #e8f5e9;overflow:hidden;box-shadow:0 4px 20px rgba(30,123,28,0.06);">
                <div style="padding:18px 20px 14px;border-bottom:1px solid #f0fdf4;display:flex;align-items:center;gap:10px;">
                    <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#1e7b1c,#166534);display:flex;align-items:center;justify-content:center;font-size:14px;color:#fff;flex-shrink:0;">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>
                    <div>
                        <div style="font-size:13.5px;font-weight:800;color:#0b3d0a;line-height:1.2;">Ketentuan Kiriman</div>
                        <div style="font-size:11px;color:#6b7280;font-weight:500;">Pastikan naskah memenuhi syarat ini</div>
                    </div>
                </div>
                <div style="padding:14px 20px;">
                    @php
                    $terms = [
                        ['bi bi-patch-check-fill','Naskah <strong>original</strong> & belum pernah diterbitkan'],
                        ['bi bi-file-earmark-word-fill','Format <strong>.doc / .docx</strong> — Maks. 10 MB'],
                        ['bi bi-images','Foto dalam file <strong>.zip</strong> — Maks. 50 MB'],
                        ['bi bi-fonts','Times New Roman 12pt, spasi 1,5'],
                        ['bi bi-clock-history','Proses seleksi <strong>7–14 hari kerja</strong>'],
                    ];
                    @endphp
                    @foreach($terms as [$ico, $txt])
                    <div style="display:flex;align-items:flex-start;gap:10px;padding:8px 0;border-bottom:1px solid #f8fafc;font-size:12.5px;">
                        <i class="{{ $ico }}" style="color:#1e7b1c;font-size:13px;flex-shrink:0;margin-top:2px;"></i>
                        <span style="color:#374151;font-weight:500;line-height:1.5;">{!! $txt !!}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Link: Panduan --}}
            <a href="{{ route('static.panduan_penulisan') }}"
               style="display:flex;gap:12px;align-items:center;background:linear-gradient(135deg,#0b3d0a,#1e7b1c);border-radius:16px;padding:16px 18px;text-decoration:none;box-shadow:0 6px 18px rgba(30,123,28,0.2);transition:transform .25s,box-shadow .25s;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 10px 28px rgba(30,123,28,0.3)'"
               onmouseout="this.style.transform='';this.style.boxShadow='0 6px 18px rgba(30,123,28,0.2)'">
                <div style="width:40px;height:40px;background:rgba(255,255,255,0.13);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:18px;color:#F5A623;flex-shrink:0;">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:13px;font-weight:800;color:#fff;margin-bottom:2px;">Baca Panduan Penulisan</div>
                    <div style="font-size:11px;color:rgba(255,255,255,0.5);font-weight:500;">Pastikan format naskah sudah benar</div>
                </div>
                <i class="bi bi-arrow-right-short" style="color:rgba(255,255,255,0.45);font-size:20px;flex-shrink:0;"></i>
            </a>

            {{-- Card: Jenis Naskah --}}
            <div style="background:#fff;border-radius:20px;border:1px solid #e8f5e9;overflow:hidden;box-shadow:0 4px 20px rgba(30,123,28,0.06);">
                <div style="padding:16px 20px 12px;border-bottom:1px solid #f0fdf4;display:flex;align-items:center;gap:10px;">
                    <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#a855f7,#7c3aed);display:flex;align-items:center;justify-content:center;font-size:14px;color:#fff;flex-shrink:0;">
                        <i class="bi bi-layers-fill"></i>
                    </div>
                    <div style="font-size:13.5px;font-weight:800;color:#0b3d0a;">Jenis Naskah Diterima</div>
                </div>
                <div style="padding:14px 20px;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                        @php
                        $types = [
                            ['bi-journal-text','#7c3aed','Puisi','1–3 judul'],
                            ['bi-book','#2563eb','Cerpen','1.500–5.000 kata'],
                            ['bi-music-note-beamed','#d97706','Pantun & Syair','5–20 bait'],
                            ['bi-newspaper','#059669','Esai & Artikel','1.000–3.000 kata'],
                        ];
                        @endphp
                        @foreach($types as [$ico,$col,$label,$desc])
                        <div style="background:#f8fafc;border-radius:12px;padding:10px 12px;display:flex;align-items:center;gap:8px;">
                            <i class="bi {{ $ico }}" style="color:{{ $col }};font-size:14px;flex-shrink:0;"></i>
                            <div>
                                <div style="font-size:12px;font-weight:800;color:#0b3d0a;">{{ $label }}</div>
                                <div style="font-size:10.5px;color:#6b7280;font-weight:500;">{{ $desc }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        {{-- ══ FORM CARD ══ --}}
        <div style="background:#fff;border-radius:24px;border:1px solid #e8f5e9;overflow:hidden;box-shadow:0 8px 40px rgba(30,123,28,0.08);">
            <form action="{{ route('naskah.store') }}" method="POST" enctype="multipart/form-data" id="formNaskah">
                @csrf

                {{-- ── SECTION A ── --}}
                <div style="display:flex;align-items:center;gap:12px;padding:20px 26px 16px;border-bottom:1px solid #f0fdf4;">
                    <div style="width:32px;height:32px;border-radius:10px;background:linear-gradient(135deg,#1e7b1c,#166534);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:900;color:#fff;flex-shrink:0;">A</div>
                    <div>
                        <div style="font-size:14px;font-weight:800;color:#0b3d0a;margin:0;">Data Pengirim</div>
                        <div style="font-size:11.5px;color:#6b7280;font-weight:500;">Identitas yang akan dihubungi redaksi</div>
                    </div>
                </div>

                <div style="padding:22px 26px;">

                    {{-- Nama --}}
                    <div class="kn-field">
                        <label class="kn-label">
                            <i class="bi bi-person-fill" style="color:#1e7b1c;"></i>
                            Nama Lengkap <span class="req">*</span>
                        </label>
                        <div class="field-wrap">
                            <i class="field-ico bi bi-person-fill" style="color:#1e7b1c;"></i>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="kn-input padl {{ $errors->has('nama') ? 'err' : '' }}"
                                placeholder="Nama lengkap Anda">
                        </div>
                        @error('nama') <div class="kn-errmsg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div> @enderror
                    </div>

                    {{-- No HP + Email --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="kn-field" style="margin-bottom:0;">
                            <label class="kn-label"><i class="bi bi-whatsapp" style="color:#16a34a;"></i> No. HP / WA <span class="req">*</span></label>
                            <div class="field-wrap">
                                <i class="field-ico bi bi-telephone-fill" style="color:#16a34a;"></i>
                                <input type="tel" name="no_hp" value="{{ old('no_hp') }}"
                                    class="kn-input padl {{ $errors->has('no_hp') ? 'err' : '' }}"
                                    placeholder="08xxxxxxxxxx">
                            </div>
                            @error('no_hp') <div class="kn-errmsg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div> @enderror
                        </div>
                        <div class="kn-field" style="margin-bottom:0;">
                            <label class="kn-label"><i class="bi bi-envelope-fill" style="color:#2563eb;"></i> Email <span class="req">*</span></label>
                            <div class="field-wrap">
                                <i class="field-ico bi bi-envelope-fill" style="color:#2563eb;"></i>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="kn-input padl {{ $errors->has('email') ? 'err' : '' }}"
                                    placeholder="email@contoh.com">
                            </div>
                            @error('email') <div class="kn-errmsg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>

                {{-- Divider --}}
                <div style="height:5px;background:linear-gradient(90deg,#f0fdf4,#dcfce7,#f0fdf4);"></div>

                {{-- ── SECTION B ── --}}
                <div style="display:flex;align-items:center;gap:12px;padding:20px 26px 16px;border-bottom:1px solid #f0fdf4;">
                    <div style="width:32px;height:32px;border-radius:10px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:900;color:#fff;flex-shrink:0;">B</div>
                    <div>
                        <div style="font-size:14px;font-weight:800;color:#0b3d0a;margin:0;">Berkas Kiriman</div>
                        <div style="font-size:11.5px;color:#6b7280;font-weight:500;">Upload naskah dan foto pendukung</div>
                    </div>
                </div>

                <div style="padding:22px 26px;">

                    {{-- Upload Naskah Word --}}
                    <div class="kn-field">
                        <label class="kn-label">
                            <i class="bi bi-file-earmark-word-fill" style="color:#2563eb;"></i>
                            File Naskah <span class="req">*</span>
                            <span class="opt">.doc / .docx</span>
                        </label>
                        <div class="upload-zone" id="zoneNaskah"
                             style="border:2px dashed #86efac;border-radius:16px;background:#f0fdf4;">
                            <input type="file" name="file_naskah" id="inputNaskah" accept=".doc,.docx"
                                   onchange="handleFile(this,'naskah','#2563eb','bi-file-earmark-word-fill')">
                            <div id="innerNaskah" style="padding:32px 20px;text-align:center;">
                                <div class="upload-icon-wrap" style="display:inline-block;">
                                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#dbeafe,#bfdbfe);display:flex;align-items:center;justify-content:center;font-size:24px;color:#2563eb;margin:0 auto 10px;">
                                        <i class="bi bi-file-earmark-word-fill"></i>
                                    </div>
                                </div>
                                <div style="font-size:14px;font-weight:800;color:#166534;margin-bottom:4px;">Klik atau seret file naskah ke sini</div>
                                <div style="font-size:12px;color:#6b7280;font-weight:500;margin-bottom:10px;">Microsoft Word — Maks. 10 MB</div>
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#dcfce7;color:#166534;font-size:10.5px;font-weight:700;padding:3px 12px;border-radius:999px;border:1px solid #bbf7d0;">
                                    <i class="bi bi-file-earmark-word"></i> .doc &nbsp;·&nbsp; .docx
                                </span>
                            </div>
                            <div class="file-selected" id="selectedNaskah"
                                 style="padding:14px 18px;align-items:center;gap:12px;background:#dcfce7;border-top:1px dashed #86efac;">
                                <div style="width:38px;height:38px;background:#2563eb;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;color:#fff;flex-shrink:0;">
                                    <i class="bi bi-file-earmark-word-fill"></i>
                                </div>
                                <div id="nameNaskah" style="font-size:12.5px;font-weight:700;color:#166534;word-break:break-all;flex:1;">—</div>
                                <i class="bi bi-check-circle-fill" style="color:#16a34a;font-size:20px;flex-shrink:0;"></i>
                                <button type="button" onclick="removeFile('naskah')"
                                        style="background:none;border:none;color:#ef4444;font-size:16px;cursor:pointer;padding:4px;flex-shrink:0;">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                        @error('file_naskah') <div class="kn-errmsg mt-2"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div> @enderror
                    </div>

                    {{-- Upload Foto ZIP --}}
                    <div class="kn-field">
                        <label class="kn-label">
                            <i class="bi bi-file-earmark-zip-fill" style="color:#d97706;"></i>
                            Foto Pendukung
                            <span class="opt">opsional — .zip</span>
                        </label>
                        <div class="upload-zone" id="zoneFoto"
                             style="border:2px dashed #fde68a;border-radius:16px;background:#fffbeb;">
                            <input type="file" name="file_foto" id="inputFoto" accept=".zip"
                                   onchange="handleFile(this,'foto','#d97706','bi-file-earmark-zip-fill')">
                            <div id="innerFoto" style="padding:28px 20px;text-align:center;">
                                <div class="upload-icon-wrap" style="display:inline-block;">
                                    <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#fef3c7,#fde68a);display:flex;align-items:center;justify-content:center;font-size:24px;color:#d97706;margin:0 auto 10px;">
                                        <i class="bi bi-file-earmark-zip-fill"></i>
                                    </div>
                                </div>
                                <div style="font-size:14px;font-weight:800;color:#92400e;margin-bottom:4px;">Klik atau seret file ZIP ke sini</div>
                                <div style="font-size:12px;color:#6b7280;font-weight:500;margin-bottom:10px;">Kumpulkan semua foto dalam satu .zip — Maks. 50 MB</div>
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#fef3c7;color:#92400e;font-size:10.5px;font-weight:700;padding:3px 12px;border-radius:999px;border:1px solid #fde68a;">
                                    <i class="bi bi-file-earmark-zip"></i> .zip
                                </span>
                            </div>
                            <div class="file-selected" id="selectedFoto"
                                 style="padding:14px 18px;align-items:center;gap:12px;background:#fef3c7;border-top:1px dashed #fde68a;">
                                <div style="width:38px;height:38px;background:#d97706;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;color:#fff;flex-shrink:0;">
                                    <i class="bi bi-file-earmark-zip-fill"></i>
                                </div>
                                <div id="nameFoto" style="font-size:12.5px;font-weight:700;color:#92400e;word-break:break-all;flex:1;">—</div>
                                <i class="bi bi-check-circle-fill" style="color:#d97706;font-size:20px;flex-shrink:0;"></i>
                                <button type="button" onclick="removeFile('foto')"
                                        style="background:none;border:none;color:#ef4444;font-size:16px;cursor:pointer;padding:4px;flex-shrink:0;">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                        @error('file_foto') <div class="kn-errmsg mt-2"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div> @enderror
                    </div>

                    {{-- Catatan --}}
                    <div class="kn-field">
                        <label class="kn-label">
                            <i class="bi bi-chat-left-text-fill" style="color:#6b7280;"></i>
                            Catatan untuk Redaksi <span class="opt">opsional</span>
                        </label>
                        <textarea name="catatan"
                            class="kn-input {{ $errors->has('catatan') ? 'err' : '' }}"
                            rows="3"
                            style="resize:vertical;"
                            placeholder="Genre naskah, pesan khusus untuk tim redaksi, dll...">{{ old('catatan') }}</textarea>
                        @error('catatan') <div class="kn-errmsg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div> @enderror
                    </div>

                </div>

                {{-- ── SUBMIT FOOTER ── --}}
                <div style="padding:20px 26px;border-top:1px solid #f0fdf4;background:linear-gradient(135deg,#f9fffe,#f0fdf4);">
                    <p style="font-size:11.5px;color:#6b7280;font-weight:500;margin:0 0 14px;line-height:1.6;">
                        Dengan mengirim, Anda menyatakan bahwa naskah ini adalah karya asli dan belum pernah diterbitkan,
                        serta menyetujui <a href="{{ route('static.panduan_penulisan') }}" style="color:#1e7b1c;font-weight:700;">ketentuan pengiriman</a> Serindit.
                    </p>
                    <button type="submit" id="btnSubmit"
                        style="width:100%;padding:16px 24px;background:linear-gradient(135deg,#1e7b1c 0%,#166534 100%);color:#fff;border:none;border-radius:14px;font-size:15px;font-weight:900;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .25s;letter-spacing:.02em;box-shadow:0 8px 24px rgba(30,123,28,0.28);font-family:'Inter',sans-serif;"
                        onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 14px 36px rgba(30,123,28,0.38)'"
                        onmouseout="this.style.transform='';this.style.boxShadow='0 8px 24px rgba(30,123,28,0.28)'">
                        <i class="bi bi-send-fill"></i>
                        Kirim Naskah Sekarang
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
function handleFile(input, key, color, icon) {
    if (!input.files || !input.files.length) return;
    const name = input.files[0].name;
    document.getElementById('name' + cap(key)).textContent = name;
    document.getElementById('inner' + cap(key)).style.display = 'none';
    const sel = document.getElementById('selected' + cap(key));
    sel.classList.add('show');
}
function removeFile(key) {
    document.getElementById('input' + cap(key)).value = '';
    document.getElementById('inner' + cap(key)).style.display = '';
    document.getElementById('selected' + cap(key)).classList.remove('show');
}
function cap(s) { return s.charAt(0).toUpperCase() + s.slice(1); }

// Drag & drop
['zoneNaskah','zoneFoto'].forEach(id => {
    const z = document.getElementById(id);
    z.addEventListener('dragover', e => { e.preventDefault(); z.classList.add('drag-active'); });
    z.addEventListener('dragleave', () => z.classList.remove('drag-active'));
    z.addEventListener('drop', () => z.classList.remove('drag-active'));
});

// Loading on submit
document.getElementById('formNaskah').addEventListener('submit', function() {
    const btn = document.getElementById('btnSubmit');
    btn.innerHTML = '<span class="btn-spinner"></span> Mengirim...';
    btn.disabled = true;
    btn.style.opacity = '0.85';
});
</script>
@endpush

@endsection
