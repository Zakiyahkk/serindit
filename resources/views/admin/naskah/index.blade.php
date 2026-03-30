@extends('admin.layout')

@section('title','Naskah')

@section('content')

<style>
    /* HERO SECTION */
    .page-hero {
        background: linear-gradient(135deg,  #bb4040, #f3ef0c);
        padding: 25px;
        border-radius: 12px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
    }
    .page-hero h2 { font-weight: 700; margin-bottom: 5px; }
    .page-hero p  { margin: 0; opacity: .9; }

    /* STAT CARDS */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
    }
    .stat-card .stat-number { font-size: 32px; font-weight: 800; line-height: 1; }
    .stat-card .stat-label  { font-size: 12px; color: #94a3b8; margin-top: 5px; }
    .stat-red    { color: #ef4444; }
    .stat-yellow { color: #f59e0b; }
    .stat-green  { color: #16a34a; }
    .stat-gray   { color: #94a3b8; }

    /* FILTER */
    .filter-wrap {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,.03);
    }

    .search-wrap { position: relative; }
    .search-wrap input {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 11px 15px 11px 44px;
        width: 100%;
        font-size: 14px;
        background: #f8fafc;
        transition: all 0.3s;
    }
    .search-wrap input:focus {
        outline: none;
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 4px rgba(37,99,235,.08);
    }
    .search-wrap i {
        position: absolute; left: 14px; top: 50%;
        transform: translateY(-50%); color: #94a3b8; font-size: 18px;
    }

    select.form-input-m {
        width: 100%;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 11px 38px 11px 14px;
        font-size: 14px;
        background-color: #f8fafc;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.9rem center;
        background-size: 1.4em;
        transition: all 0.3s;
    }
    select.form-input-m:focus {
        outline: none;
        border-color: #2563eb;
        background-color: white;
        box-shadow: 0 0 0 4px rgba(37,99,235,.08);
    }

    /* NASKAH CARD */
    .naskah-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
        padding: 18px 20px;
        margin-bottom: 12px;
        transition: all 0.25s ease;
    }
    .naskah-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,.08);
        transform: translateY(-2px);
        border-color: #e2e8f0;
    }

    /* BADGE JENIS */
    .badge-jenis {
        font-size: 10px; font-weight: 700;
        text-transform: uppercase; padding: 3px 10px;
        border-radius: 50px; display: inline-block; letter-spacing: 0.4px;
    }
    .jenis-cerpen  { background: #fee2e2; color: #b91c1c; }
    .jenis-puisi   { background: #ede9fe; color: #6d28d9; }
    .jenis-pantun  { background: #dbeafe; color: #1d4ed8; }
    .jenis-esai    { background: #e0e7ff; color: #3730a3; }
    .jenis-novel   { background: #fce7f3; color: #be185d; }
    .jenis-artikel { background: #ccfbf1; color: #0f766e; }

    /* BADGE STATUS */
    .badge-status {
        font-size: 10px; font-weight: 700;
        padding: 3px 10px; border-radius: 50px;
        display: inline-flex; align-items: center; gap: 4px;
    }
    .status-menunggu  { background: #fef9c3; color: #a16207; border: 1px solid #fde68a; }
    .status-disetujui { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .status-ditolak   { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    .naskah-judul  { font-size: 16px; font-weight: 700; color: #1e293b; margin: 6px 0 2px; line-height: 1.4; }
    .naskah-meta   { font-size: 12px; color: #64748b; margin-bottom: 6px; }
    .naskah-meta a { color: #2563eb; text-decoration: none; }
    .naskah-meta a:hover { text-decoration: underline; }
    .naskah-sinopsis {
        font-size: 13px; color: #64748b; line-height: 1.6;
        display: -webkit-box; -webkit-line-clamp: 2;
        -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 6px;
    }
    .naskah-tanggal { font-size: 11px; color: #94a3b8; }

    /* ACTION BUTTONS */
    .btn-lihat {
        height: 34px; padding: 0 14px;
        border: 1.5px solid #e2e8f0; border-radius: 8px;
        background: white; color: #475569;
        font-size: 12px; font-weight: 600;
        display: inline-flex; align-items: center; gap: 5px;
        text-decoration: none; transition: all 0.2s; white-space: nowrap;
        cursor: pointer;
    }
    .btn-lihat:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; text-decoration: none; }

    .btn-setujui {
        height: 34px; padding: 0 14px; border: none; border-radius: 8px;
        background: #16a34a; color: white; font-size: 12px; font-weight: 600;
        display: inline-flex; align-items: center; justify-content: center; gap: 5px;
        cursor: pointer; transition: all 0.2s; white-space: nowrap; width: 100%;
    }
    .btn-setujui:hover { background: #15803d; transform: translateY(-1px); }

    .btn-tolak {
        height: 34px; padding: 0 14px; border: none; border-radius: 8px;
        background: #ef4444; color: white; font-size: 12px; font-weight: 600;
        display: inline-flex; align-items: center; justify-content: center; gap: 5px;
        cursor: pointer; transition: all 0.2s; white-space: nowrap; width: 100%;
    }
    .btn-tolak:hover { background: #dc2626; transform: translateY(-1px); }

    .btn-reset {
        height: 34px; padding: 0 12px; width: 100%;
        border: 1.5px solid #e2e8f0; border-radius: 8px;
        background: #f8fafc; color: #64748b;
        font-size: 11px; font-weight: 600;
        cursor: pointer; transition: all 0.2s;
    }
    .btn-reset:hover { background: #f1f5f9; }

    .btn-hapus {
        height: 34px; padding: 0 10px; width: 100%;
        border: 1.5px solid #fecaca; border-radius: 8px;
        background: white; color: #ef4444;
        font-size: 11px; font-weight: 600;
        cursor: pointer; transition: all 0.2s;
    }
    .btn-hapus:hover { background: #fee2e2; }

    /* SECTION TITLE */
    .section-title {
        font-size: 15px; font-weight: 700; color: #1e293b;
        margin-bottom: 16px; display: flex; align-items: center; gap: 8px;
    }
    .section-title span {
        background: #f1f5f9; color: #64748b;
        font-size: 12px; padding: 2px 8px;
        border-radius: 20px; font-weight: 600;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center; padding: 60px 20px;
        background: white; border-radius: 12px;
        border: 1px solid #f1f5f9;
    }
    .empty-state .icon { font-size: 48px; margin-bottom: 12px; }
    .empty-state p { color: #94a3b8; font-size: 14px; margin: 0; }

    /* MODAL OVERLAY */
    .modal-overlay {
        position: fixed; inset: 0; z-index: 9999;
        background: rgba(0,0,0,0.45);
        backdrop-filter: blur(3px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .modal-overlay.show { display: flex; }

    .modal-box {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0,0,0,.2);
        width: 100%; max-width: 460px;
        overflow: hidden;
    }
    .modal-head {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; justify-content: space-between;
    }
    .modal-head h5 { font-weight: 800; color: #1e293b; margin: 0; font-size: 16px; }
    .modal-close {
        background: none; border: none; cursor: pointer;
        color: #94a3b8; font-size: 20px; line-height: 1;
        padding: 4px;
    }
    .modal-close:hover { color: #475569; }
    .modal-body-inner { padding: 20px 24px; }
    .modal-foot {
        padding: 15px 24px;
        border-top: 1px solid #f1f5f9;
        display: flex; justify-content: flex-end; gap: 10px;
    }

    .btn-modal-cancel {
        background: #f1f5f9; color: #475569; border: none;
        padding: 10px 22px; border-radius: 10px;
        font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.2s;
    }
    .btn-modal-cancel:hover { background: #e2e8f0; color: #1e293b; }

    .btn-modal-save {
        background: #ef4444; border: none;
        padding: 10px 22px; color: white;
        border-radius: 10px; font-weight: 700;
        font-size: 14px; cursor: pointer; transition: all 0.3s;
    }
    .btn-modal-save:hover { background: #dc2626; transform: translateY(-1px); }

    .form-label-m {
        font-weight: 700; margin-bottom: 8px; display: block;
        color: #334155; font-size: 12px;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .form-input-m {
        width: 100%; border: 1.5px solid #e2e8f0; border-radius: 10px;
        padding: 12px 15px; transition: all 0.3s;
        background-color: #f8fafc; font-size: 14px;
        box-sizing: border-box;
    }
    .form-input-m:focus {
        outline: none; border-color: #ef4444;
        background-color: #fff; box-shadow: 0 0 0 4px rgba(239,68,68,.08);
    }
</style>

{{-- Flash --}}
@if(session('success'))
    <div style="background:#dcfce7; color:#166534; border:1px solid #bbf7d0;
                padding:12px 16px; border-radius:10px; font-size:14px;
                margin-bottom:20px; display:flex; align-items:center; gap:8px;">
        <span>✓</span> {{ session('success') }}
    </div>
@endif

{{-- Hero --}}
<div class="page-hero">
    <h2>📥 Naskah Inbox</h2>
    <p>Kelola naskah panjang yang masuk dari pengguna eksternal</p>
</div>

{{-- Statistik --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-number stat-red">{{ $totalMasuk }}</div>
        <div class="stat-label">Total Masuk</div>
    </div>
    <div class="stat-card">
        <div class="stat-number stat-yellow">{{ $menunggu }}</div>
        <div class="stat-label">Menunggu</div>
    </div>
    <div class="stat-card">
        <div class="stat-number stat-green">{{ $disetujui }}</div>
        <div class="stat-label">Disetujui</div>
    </div>
    <div class="stat-card">
        <div class="stat-number stat-gray">{{ $ditolak }}</div>
        <div class="stat-label">Ditolak</div>
    </div>
</div>

{{-- Filter --}}
<div class="filter-wrap">
    <p style="font-weight:700; font-size:14px; color:#334155; margin-bottom:14px;">
        🔍 Filter &amp; Pencarian
    </p>
    <form method="GET" action="{{ route('admin.naskah.index') }}"
          style="display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;">

        <div style="flex:1; min-width:220px;">
            <label class="form-label-m">Cari</label>
            <div style="position:relative;">
                <svg style="position:absolute;left:12px;top:50%;transform:translateY(-50%);width:17px;height:17px;pointer-events:none;" fill="none" stroke="#94a3b8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari judul atau penulis..."
                       style="border:1.5px solid #e2e8f0;border-radius:10px;padding:11px 15px 11px 40px;width:100%;font-size:14px;background:#f8fafc;box-sizing:border-box;outline:none;transition:all 0.3s;">
            </div>
        </div>

        <div style="min-width:150px;">
            <label class="form-label-m">Jenis</label>
            <select name="jenis" class="form-input-m">
                <option value="semua" {{ request('jenis','semua')==='semua'?'selected':'' }}>Semua Jenis</option>
                @foreach(['Cerpen','Puisi','Pantun','Esai','Novel','Artikel'] as $j)
                    <option value="{{ $j }}" {{ request('jenis')===$j?'selected':'' }}>{{ $j }}</option>
                @endforeach
            </select>
        </div>

        <div style="min-width:150px;">
            <label class="form-label-m">Status</label>
            <select name="status" class="form-input-m">
                <option value="semua"     {{ request('status','semua')==='semua'    ?'selected':'' }}>Semua Status</option>
                <option value="Menunggu"  {{ request('status')==='Menunggu'         ?'selected':'' }}>Menunggu</option>
                <option value="Disetujui" {{ request('status')==='Disetujui'        ?'selected':'' }}>Disetujui</option>
                <option value="Ditolak"   {{ request('status')==='Ditolak'          ?'selected':'' }}>Ditolak</option>
            </select>
        </div>

        <div style="display:flex; gap:8px; align-items:flex-end;">
            <button type="submit"
                    style="height:42px; padding:0 22px; background:#2563eb; color:white;
                           border:none; border-radius:10px; font-size:13px; font-weight:600;
                           cursor:pointer; display:flex; align-items:center; gap:6px; white-space:nowrap;">
                <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
                Cari
            </button>
            @if(request()->hasAny(['search','jenis','status']))
                <a href="{{ route('admin.naskah.index') }}"
                   style="height:42px; padding:0 16px; background:#f1f5f9; color:#64748b;
                          border:1.5px solid #e2e8f0; border-radius:10px; font-size:13px;
                          font-weight:600; display:flex; align-items:center; text-decoration:none; white-space:nowrap;">
                    ✕ Reset
                </a>
            @endif
        </div>
    </form>
</div>

{{-- Daftar --}}
<div class="section-title">
    Daftar Naskah <span>{{ $naskah->total() }}</span>
</div>

@forelse($naskah as $item)
    @php
        $jenisCls = match($item->jenis) {
            'Cerpen'  => 'jenis-cerpen',
            'Puisi'   => 'jenis-puisi',
            'Pantun'  => 'jenis-pantun',
            'Esai'    => 'jenis-esai',
            'Novel'   => 'jenis-novel',
            'Artikel' => 'jenis-artikel',
            default   => 'jenis-esai',
        };
        $statusCls  = match($item->status) {
            'Disetujui' => 'status-disetujui',
            'Ditolak'   => 'status-ditolak',
            default     => 'status-menunggu',
        };
        $statusIcon = match($item->status) {
            'Disetujui' => '✓', 'Ditolak' => '✕', default => '⏱',
        };
    @endphp

    <div class="naskah-card">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; flex-wrap:wrap;">

            {{-- Info --}}
            <div style="flex:1; min-width:0;">
                <div style="display:flex; flex-wrap:wrap; gap:6px; margin-bottom:6px;">
                    <span class="badge-jenis {{ $jenisCls }}">{{ $item->jenis }}</span>
                    <span class="badge-status {{ $statusCls }}">{{ $statusIcon }} {{ $item->status }}</span>
                    @if($item->jumlah_halaman)
                        <span class="badge-status"
                              style="background:#f1f5f9; color:#64748b; border:1px solid #e2e8f0;">
                            📄 {{ $item->jumlah_halaman }} hal
                        </span>
                    @endif
                </div>

                <div class="naskah-judul">{{ $item->judul }}</div>
                <div class="naskah-meta">
                    oleh <strong>{{ $item->penulis }}</strong>
                    &nbsp;·&nbsp;
                    <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                </div>

                @if($item->sinopsis)
                    <div class="naskah-sinopsis">{{ $item->sinopsis }}</div>
                @endif

                <div class="naskah-tanggal">
                    📅 {{ $item->tanggal_kirim_format }}
                    @if($item->tanggal_review)
                        &nbsp;·&nbsp; Direview {{ \Carbon\Carbon::parse($item->tanggal_review)->diffForHumans() }}
                    @endif
                </div>
            </div>

            {{-- Tombol --}}
            <div style="display:flex; flex-direction:column; gap:8px; min-width:115px;">

                <a href="{{ route('admin.naskah.show', $item) }}" class="btn-lihat"
                   style="justify-content:center;">
                    👁 Lihat
                </a>

                @if($item->status === 'Menunggu')
                    <form action="{{ route('admin.naskah.setujui', $item) }}" method="POST"
                          onsubmit="return confirm('Setujui naskah ini?')">
                        @csrf
                        <button type="submit" class="btn-setujui">✓ Setujui</button>
                    </form>

                    <button type="button" class="btn-tolak"
                            onclick="openTolakModal({{ $item->id }}, '{{ addslashes($item->judul) }}')">
                        ✕ Tolak
                    </button>

                @else
                    <form action="{{ route('admin.naskah.reset', $item) }}" method="POST"
                          onsubmit="return confirm('Kembalikan status ke Menunggu?')">
                        @csrf
                        <button type="submit" class="btn-reset">↩ Reset</button>
                    </form>
                @endif

                <form action="{{ route('admin.naskah.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Hapus naskah ini secara permanen?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-hapus">🗑 Hapus</button>
                </form>

            </div>
        </div>
    </div>

@empty
    <div class="empty-state">
        <div class="icon">📭</div>
        <p>Belum ada naskah masuk.</p>
    </div>
@endforelse

{{-- Pagination --}}
@if($naskah->hasPages())
    <div style="margin-top:16px;">{{ $naskah->links() }}</div>
@endif

{{-- Modal Tolak --}}
<div id="tolakModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <h5>✕ Tolak Naskah</h5>
            <button class="modal-close" onclick="closeTolakModal()">✕</button>
        </div>
        <form id="tolakForm" method="POST">
            @csrf
            <div class="modal-body-inner">
                <p id="tolakJudulText"
                   style="font-size:13px; color:#64748b; background:#f8fafc;
                          padding:10px 14px; border-radius:8px; margin-bottom:16px;
                          font-weight:600; border-left:3px solid #ef4444;">
                </p>
                <label class="form-label-m">
                    Catatan Penolakan <span style="color:#ef4444;">*</span>
                </label>
                <textarea name="catatan_penolakan" rows="4" class="form-input-m"
                          placeholder="Tuliskan alasan penolakan untuk dikirim ke penulis..."
                          required style="resize:none;"></textarea>
                <p style="font-size:12px; color:#94a3b8; margin-top:6px; font-style:italic;">
                    Catatan ini akan membantu penulis memahami alasan penolakan.
                </p>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-modal-cancel" onclick="closeTolakModal()">Batal</button>
                <button type="submit" class="btn-modal-save">✕ Tolak Naskah</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openTolakModal(id, judul) {
        document.getElementById('tolakJudulText').textContent = '📄 ' + judul;
        document.getElementById('tolakForm').action = '/admin/naskah/' + id + '/tolak';
        document.getElementById('tolakModal').classList.add('show');
    }

    function closeTolakModal() {
        document.getElementById('tolakModal').classList.remove('show');
        document.getElementById('tolakForm').querySelector('textarea').value = '';
    }

    document.getElementById('tolakModal').addEventListener('click', function(e) {
        if (e.target === this) closeTolakModal();
    });
</script>
@endpush

@endsection