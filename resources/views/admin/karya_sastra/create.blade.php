@extends('admin.layout')

@section('title', 'Tambah '.ucfirst($tipe).' — Jejak Pena')

@push('styles')
<style>
.page-hero { background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 60%, #27AE60 100%); border-radius: 16px; padding: 28px 32px; color: #fff; margin-bottom: 24px; position: relative; overflow: hidden; }
.form-card { background:#fff; border-radius:14px; border:1px solid #e8edf2; padding:28px 32px; }
.form-label { font-size:13px; font-weight:600; color:#374151; margin-bottom:6px; }
.form-control, .form-select { border:1.5px solid #e2e8f0; border-radius:9px; font-size:13.5px; padding:9px 12px; }
.form-control:focus, .form-select:focus { outline:none; border-color:#1e7b1c; box-shadow:0 0 0 3px rgba(30,123,28,.1); }
.section-divider { border-top:1.5px dashed #e2e8f0; margin:24px 0; }
.bait-item { background:#f8fafc; border-radius:10px; padding:14px 16px; border:1px solid #e8edf2; margin-bottom:12px; position:relative; }
.btn-remove-bait { position:absolute; top:10px; right:10px; width:26px; height:26px; border-radius:7px; background:#fef2f2; color:#ef4444; border:none; display:flex; align-items:center; justify-content:center; font-size:12px; cursor:pointer; }
.btn-add-bait { background:#f0fdf4; color:#1e7b1c; border:1.5px dashed #bbf7d0; padding:8px 16px; border-radius:9px; font-size:13px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:6px; transition:.2s; }
.btn-add-bait:hover { background:#dcfce7; }
.btn-simpan { background:linear-gradient(135deg,#1e7b1c,#27AE60); color:#fff; border:none; padding:10px 28px; border-radius:10px; font-size:14px; font-weight:700; display:inline-flex; align-items:center; gap:8px; }
.help-text { font-size:11.5px; color:#94a3b8; margin-top:5px; }
</style>
@endpush

@section('content')

<div class="page-hero">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="font-size:20px;"><i class="bi bi-plus-circle-fill me-2"></i>Tambah {{ ucfirst($tipe) }}</h2>
            <p style="font-size:13px;opacity:.8;margin:0;">Isi formulir di bawah untuk menambahkan karya {{ $tipe }} baru ke halaman publik.</p>
        </div>
        <a href="{{ route('admin.karya-sastra.index', ['tipe'=>$tipe]) }}" style="background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.25);padding:8px 18px;border-radius:9px;font-size:13px;font-weight:600;text-decoration:none;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.karya-sastra.store') }}">
    @csrf
    <input type="hidden" name="tipe" value="{{ $tipe }}">

    <div class="row g-4">
        {{-- Kolom Kiri: Informasi Dasar --}}
        <div class="col-lg-8">
            <div class="form-card">
                <h6 style="font-size:14px;font-weight:700;color:#1e293b;margin-bottom:20px;display:flex;align-items:center;gap:8px;">
                    <span style="width:26px;height:26px;border-radius:8px;background:linear-gradient(135deg,#1e7b1c,#27AE60);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:12px;">
                        @if($tipe === 'puisi') <i class="bi bi-journal-text"></i>
                        @elseif($tipe === 'cerpen') <i class="bi bi-book"></i>
                        @elseif($tipe === 'pantun') <i class="bi bi-music-note-beamed"></i>
                        @else <i class="bi bi-stars"></i> @endif
                    </span>
                    Informasi Dasar
                </h6>

                <div class="mb-3">
                    <label class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required placeholder="Judul karya {{ $tipe }}">
                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis <span class="text-danger">*</span></label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $tipe==='pantun' ? 'Pantun Melayu Tradisional' : 'Penulis Riau') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="2" placeholder="Deskripsi singkat untuk ditampilkan di kartu...">{{ old('deskripsi') }}</textarea>
                </div>

                @if($tipe==='puisi')
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Jenis Puisi</label>
                        <input type="text" name="jenis" class="form-control" value="{{ old('jenis') }}" placeholder="Puisi Lirik, Naratif, Elegi...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Majas (pisahkan koma)</label>
                        <input type="text" name="majas" class="form-control" value="{{ old('majas') }}" placeholder="Personifikasi, Metafora, Simile">
                    </div>
                </div>
                @endif

                @if($tipe==='cerpen')
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Genre</label>
                        <input type="text" name="jenis" class="form-control" value="{{ old('jenis') }}" placeholder="Tradisi & Budaya, Keluarga...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Durasi Baca</label>
                        <input type="text" name="durasi_baca" class="form-control" value="{{ old('durasi_baca', '± 5 menit') }}" placeholder="± 5 menit">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tema Tags (koma)</label>
                        <input type="text" name="tema_tags" class="form-control" value="{{ old('tema_tags') }}" placeholder="Keluarga, Tradisi">
                    </div>
                </div>
                @endif

                @if($tipe==='pantun' || $tipe==='syair')
                <div class="mb-3">
                    <label class="form-label">Tema</label>
                    <input type="text" name="tema" class="form-control" value="{{ old('tema') }}" placeholder="Nasihat, Cinta, Alam, Patriotik...">
                </div>
                @endif

                <div class="section-divider"></div>

                {{-- ── Input Konten Spesifik per Tipe ── --}}
                @if($tipe==='puisi')
                <h6 style="font-size:13px;font-weight:700;color:#374151;margin-bottom:14px;">Bait-bait Puisi</h6>
                <div id="bait-container">
                    <div class="bait-item">
                        <button type="button" class="btn-remove-bait" onclick="removeBait(this)" title="Hapus bait"><i class="bi bi-x"></i></button>
                        <label class="form-label" style="font-size:11.5px;color:#94a3b8;margin-bottom:6px;">Bait 1</label>
                        <textarea name="bait[]" class="form-control" rows="2" placeholder="Baris 1&#10;Baris 2"></textarea>
                        <p class="help-text">Pisahkan tiap baris dengan Enter (Newline)</p>
                    </div>
                </div>
                <button type="button" class="btn-add-bait mt-1" onclick="addBait()">
                    <i class="bi bi-plus-circle"></i> Tambah Bait
                </button>

                @elseif($tipe==='cerpen')
                <h6 style="font-size:13px;font-weight:700;color:#374151;margin-bottom:6px;">Teks Cerita</h6>
                <p class="help-text mb-2">Pisahkan setiap paragraf dengan baris kosong (tekan Enter dua kali). Dialog yang dimulai dengan tanda petik akan diformat khusus.</p>
                <textarea name="teks_cerpen" class="form-control" rows="20" placeholder='Paragraf pertama cerita...&#10;&#10;"Dialog tokoh," kata Pak Ahmad.&#10;&#10;Paragraf berikutnya...'>{{ old('teks_cerpen') }}</textarea>

                @elseif($tipe==='pantun')
                <h6 style="font-size:13px;font-weight:700;color:#374151;margin-bottom:14px;">Baris-baris Pantun</h6>
                <div class="row g-3">
                    @foreach(['Baris 1 (Sampiran)','Baris 2 (Sampiran)','Baris 3 (Isi)','Baris 4 (Isi)'] as $i=>$label)
                    <div class="col-12">
                        <label class="form-label" style="font-size:12px;">{{ $label }}</label>
                        <input type="text" name="baris_{{ $i+1 }}" class="form-control" placeholder="{{ $label }}..." value="{{ old('baris_'.($i+1)) }}">
                    </div>
                    @endforeach
                </div>

                @elseif($tipe==='syair')
                <h6 style="font-size:13px;font-weight:700;color:#374151;margin-bottom:14px;">Bait-bait Syair</h6>
                <div id="bait-syair-container">
                    <div class="bait-item">
                        <button type="button" class="btn-remove-bait" onclick="removeBait(this)" title="Hapus bait"><i class="bi bi-x"></i></button>
                        <label class="form-label" style="font-size:11.5px;color:#94a3b8;margin-bottom:6px;">Bait 1</label>
                        <textarea name="bait_syair[]" class="form-control" rows="4" placeholder="Baris 1&#10;Baris 2&#10;Baris 3&#10;Baris 4"></textarea>
                        <p class="help-text">4 baris per bait, pisahkan dengan Enter</p>
                    </div>
                </div>
                <button type="button" class="btn-add-bait mt-1" onclick="addBaitSyair()">
                    <i class="bi bi-plus-circle"></i> Tambah Bait
                </button>
                @endif

                <div class="section-divider"></div>

                <div class="mb-3">
                    <label class="form-label">Makna / Pesan Moral</label>
                    <textarea name="makna" class="form-control" rows="3" placeholder="Penjelasan makna atau pesan moral dari karya ini...">{{ old('makna') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Pengaturan --}}
        <div class="col-lg-4">
            <div class="form-card mb-4">
                <h6 style="font-size:14px;font-weight:700;color:#1e293b;margin-bottom:16px; display:flex;align-items:center;gap:8px;">
                    <span style="width:26px;height:26px;border-radius:8px;background:#f8fafc;border:1px solid #e2e8f0;display:inline-flex;align-items:center;justify-content:center;color:#64748b;font-size:12px;"><i class="bi bi-gear"></i></span>
                    Pengaturan
                </h6>
                <div class="mb-3">
                    <label class="form-label">Status Publikasi</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" id="isPublished" value="1" checked>
                        <label class="form-check-label" for="isPublished" style="font-size:13px;">Tampilkan di halaman publik</label>
                    </div>
                </div>
                <div>
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                    <p class="help-text">Semakin kecil angka = semakin atas</p>
                </div>
            </div>

            <div class="form-card">
                <button type="submit" class="btn-simpan w-100 justify-content-center">
                    <i class="bi bi-check-circle-fill"></i> Simpan {{ ucfirst($tipe) }}
                </button>
                <a href="{{ route('admin.karya-sastra.index', ['tipe'=>$tipe]) }}" class="btn btn-light w-100 mt-2" style="border-radius:9px;font-size:13px;font-weight:600;">
                    Batal
                </a>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
let baitCount = 1;
function addBait() {
    baitCount++;
    const div = document.createElement('div');
    div.className = 'bait-item';
    div.innerHTML = `
        <button type="button" class="btn-remove-bait" onclick="removeBait(this)"><i class="bi bi-x"></i></button>
        <label class="form-label" style="font-size:11.5px;color:#94a3b8;margin-bottom:6px;">Bait ${baitCount}</label>
        <textarea name="bait[]" class="form-control" rows="2" placeholder="Baris 1&#10;Baris 2"></textarea>
        <p class="help-text">Pisahkan tiap baris dengan Enter</p>`;
    document.getElementById('bait-container')?.appendChild(div);
}
let baitSyairCount = 1;
function addBaitSyair() {
    baitSyairCount++;
    const div = document.createElement('div');
    div.className = 'bait-item';
    div.innerHTML = `
        <button type="button" class="btn-remove-bait" onclick="removeBait(this)"><i class="bi bi-x"></i></button>
        <label class="form-label" style="font-size:11.5px;color:#94a3b8;margin-bottom:6px;">Bait ${baitSyairCount}</label>
        <textarea name="bait_syair[]" class="form-control" rows="4" placeholder="Baris 1&#10;Baris 2&#10;Baris 3&#10;Baris 4"></textarea>
        <p class="help-text">4 baris per bait</p>`;
    document.getElementById('bait-syair-container')?.appendChild(div);
}
function removeBait(btn) {
    const container = btn.closest('.bait-item');
    const parent = container.parentElement;
    if (parent.querySelectorAll('.bait-item').length > 1) container.remove();
}
</script>
@endpush
