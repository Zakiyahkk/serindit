@extends('admin.layout')

@section('title', 'Detail Kiriman — ' . $submission->nama)

@push('styles')
<style>
.detail-hero { background:linear-gradient(135deg,#0b3d0a,#1e7b1c); border-radius:16px; padding:24px 28px; color:#fff; margin-bottom:24px; }
.detail-card { background:#fff; border-radius:14px; border:1px solid #e8edf2; margin-bottom:20px; overflow:hidden; }
.detail-card-header { padding:14px 20px; background:#f8fafc; border-bottom:1px solid #e8edf2; display:flex; align-items:center; gap:10px; }
.detail-card-header-icon { width:32px; height:32px; border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:14px; color:#fff; flex-shrink:0; }
.detail-card-header-title { font-size:13.5px; font-weight:800; color:#1e293b; margin:0; }
.detail-card-body { padding:20px; }
.info-row { display:flex; padding:10px 0; border-bottom:1px solid #f1f5f9; gap:14px; }
.info-row:last-child { border-bottom:none; }
.info-label { font-size:11.5px; font-weight:800; text-transform:uppercase; letter-spacing:.07em; color:#94a3b8; width:130px; flex-shrink:0; padding-top:1px; }
.info-value { font-size:13.5px; color:#1e293b; font-weight:500; flex:1; }
.badge-status { display:inline-flex; align-items:center; gap:5px; font-size:12px; font-weight:700; padding:4px 14px; border-radius:999px; }
.badge-pending  { background:#fff7ed; color:#c2410c; border:1px solid #fed7aa; }
.badge-diterima { background:#f0fdf4; color:#15803d; border:1px solid #bbf7d0; }
.badge-ditolak  { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; }
.file-chip { display:inline-flex; align-items:center; gap:6px; padding:6px 14px; border-radius:10px; font-size:12.5px; font-weight:700; text-decoration:none; transition:.2s; }
.file-chip:hover { filter:brightness(.93); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="detail-hero">
    <div class="d-flex align-items-center gap-3 mb-2">
        <a href="{{ route('admin.submissions.index') }}" style="color:rgba(255,255,255,.7);text-decoration:none;font-size:13px;display:flex;align-items:center;gap:5px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <h2 style="font-size:20px;font-weight:800;margin:0 0 4px;">{{ $submission->nama }}</h2>
    <p style="font-size:13px;opacity:.7;margin:0;">Kiriman pada {{ \Carbon\Carbon::parse($submission->created_at)->translatedFormat('d F Y, H:i') }} WIB</p>
</div>

<div class="row g-4">
    <div class="col-lg-7">

        {{-- Data Pengirim --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-icon" style="background:linear-gradient(135deg,#1e7b1c,#166534);">
                    <i class="bi bi-person-fill"></i>
                </div>
                <h6 class="detail-card-header-title">Data Pengirim</h6>
            </div>
            <div class="detail-card-body">
                <div class="info-row">
                    <div class="info-label">Nama</div>
                    <div class="info-value fw-bold">{{ $submission->nama }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        <a href="mailto:{{ $submission->email }}" style="color:#2563eb;text-decoration:none;">{{ $submission->email }}</a>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. HP / WA</div>
                    <div class="info-value">
                        <a href="https://wa.me/{{ preg_replace('/^0/',62,$submission->no_hp) }}" target="_blank" style="color:#16a34a;text-decoration:none;">
                            <i class="bi bi-whatsapp me-1"></i>{{ $submission->no_hp }}
                        </a>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Kirim</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($submission->created_at)->translatedFormat('d F Y, H:i') }} WIB</div>
                </div>
                @if($submission->catatan)
                <div class="info-row">
                    <div class="info-label">Catatan</div>
                    <div class="info-value" style="white-space:pre-line;color:#374151;">{{ $submission->catatan }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- File Kiriman --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                </div>
                <h6 class="detail-card-header-title">Berkas yang Dikirimkan</h6>
            </div>
            <div class="detail-card-body">
                @if($submission->file_naskah)
                <div class="mb-3">
                    <div style="font-size:11.5px;font-weight:800;text-transform:uppercase;letter-spacing:.07em;color:#94a3b8;margin-bottom:8px;">Naskah (Word)</div>
                    <a href="{{ asset('storage/' . $submission->file_naskah) }}" target="_blank"
                       class="file-chip" style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;">
                        <i class="bi bi-file-earmark-word-fill"></i>
                        {{ basename($submission->file_naskah) }}
                        <i class="bi bi-download ms-1"></i>
                    </a>
                </div>
                @else
                <p style="font-size:13px;color:#94a3b8;">Tidak ada file naskah.</p>
                @endif

                @if($submission->file_foto)
                <div>
                    <div style="font-size:11.5px;font-weight:800;text-transform:uppercase;letter-spacing:.07em;color:#94a3b8;margin-bottom:8px;">Foto Pendukung (ZIP)</div>
                    <a href="{{ asset('storage/' . $submission->file_foto) }}" target="_blank"
                       class="file-chip" style="background:#fef3c7;color:#d97706;border:1px solid #fde68a;">
                        <i class="bi bi-file-earmark-zip-fill"></i>
                        {{ basename($submission->file_foto) }}
                        <i class="bi bi-download ms-1"></i>
                    </a>
                </div>
                @else
                <p style="font-size:13px;color:#94a3b8;margin-top:8px;">Tidak ada file foto.</p>
                @endif
            </div>
        </div>

    </div>

    <div class="col-lg-5">

        {{-- Update Status --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-icon" style="background:linear-gradient(135deg,#6366f1,#7c3aed);">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <h6 class="detail-card-header-title">Status Kiriman</h6>
            </div>
            <div class="detail-card-body">
                {{-- Status saat ini --}}
                <div class="mb-3">
                    <div style="font-size:11.5px;font-weight:800;text-transform:uppercase;color:#94a3b8;margin-bottom:6px;">Status Saat Ini</div>
                    @php
                        $badgeMap = ['pending'=>'badge-pending','diterima'=>'badge-diterima','ditolak'=>'badge-ditolak'];
                        $iconMap  = ['pending'=>'bi-hourglass-split','diterima'=>'bi-check-circle-fill','ditolak'=>'bi-x-circle-fill'];
                        $labelMap = ['pending'=>'Pending','diterima'=>'Diterima','ditolak'=>'Ditolak'];
                    @endphp
                    <span class="badge-status {{ $badgeMap[$submission->status] ?? 'badge-pending' }}">
                        <i class="bi {{ $iconMap[$submission->status] ?? 'bi-hourglass-split' }}"></i>
                        {{ $labelMap[$submission->status] ?? 'Pending' }}
                    </span>
                </div>

                {{-- Form Update --}}
                <form action="{{ route('admin.submissions.updateStatus', $submission->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label style="font-size:11.5px;font-weight:800;text-transform:uppercase;color:#94a3b8;display:block;margin-bottom:6px;">Ubah Status</label>
                        <select name="status" style="width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;font-family:'Inter',sans-serif;">
                            <option value="pending"  {{ $submission->status==='pending'  ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="diterima" {{ $submission->status==='diterima' ? 'selected' : '' }}>✅ Diterima</option>
                            <option value="ditolak"  {{ $submission->status==='ditolak'  ? 'selected' : '' }}>❌ Ditolak</option>
                        </select>
                    </div>
                    <button type="submit"
                        style="width:100%;padding:10px;background:linear-gradient(135deg,#1e7b1c,#166534);color:#fff;border:none;border-radius:10px;font-size:13.5px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;">
                        <i class="bi bi-check2-all"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- Hapus Kiriman --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-icon" style="background:#fef2f2;">
                    <i class="bi bi-trash-fill" style="color:#ef4444;"></i>
                </div>
                <h6 class="detail-card-header-title" style="color:#ef4444;">Zona Berbahaya</h6>
            </div>
            <div class="detail-card-body">
                <p style="font-size:13px;color:#94a3b8;margin-bottom:12px;">Hapus kiriman ini beserta semua filenya secara permanen.</p>
                <form action="{{ route('admin.submissions.destroy', $submission->id) }}" method="POST" id="formHapus">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Yakin hapus kiriman dari {{ $submission->nama }}?')"
                        style="width:100%;padding:9px;background:#fef2f2;color:#ef4444;border:1.5px solid #fecaca;border-radius:9px;font-size:13px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;transition:.2s;"
                        onmouseover="this.style.background='#ef4444';this.style.color='#fff';"
                        onmouseout="this.style.background='#fef2f2';this.style.color='#ef4444';">
                        <i class="bi bi-trash-fill"></i> Hapus Kiriman Ini
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
