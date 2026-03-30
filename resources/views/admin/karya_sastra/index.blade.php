@extends('admin.layout')

@section('title', 'Karya Sastra — Jejak Pena')

@push('styles')
<style>
.page-hero { background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 60%, #27AE60 100%); border-radius: 16px; padding: 28px 32px; color: #fff; margin-bottom: 24px; position: relative; overflow: hidden; }
.page-hero::after { content: ''; position: absolute; right: -30px; top: -30px; width: 200px; height: 200px; background: rgba(255,255,255,0.06); border-radius: 50%; pointer-events: none; }
.stat-cards { display: grid; grid-template-columns: repeat(5,1fr); gap: 14px; margin-bottom: 18px; }
.stat-card { background: #fff; border-radius: 12px; border: 1px solid #e8edf2; padding: 16px 18px; display: flex; align-items: center; gap: 12px; cursor: pointer; transition: box-shadow .2s; }
.stat-card:hover { box-shadow: 0 4px 16px rgba(30,123,28,.1); }
.stat-card.active { border-color: #1e7b1c; background: #f0fdf4; }
.stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
.stat-val { font-size: 22px; font-weight: 800; color: #1e293b; line-height: 1; }
.stat-lbl { font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; margin-top: 2px; }
.filter-bar { background:#fff; border-radius:12px; border:1px solid #e8edf2; padding:14px 18px; margin-bottom:16px; display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.search-group { position:relative; flex:1; min-width:200px; }
.search-group i { position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:13px; pointer-events:none; }
.search-group input { width:100%; padding:8px 12px 8px 32px; border:1.5px solid #e2e8f0; border-radius:9px; font-size:13px; }
.search-group input:focus { outline:none; border-color:#1e7b1c; box-shadow:0 0 0 3px rgba(30,123,28,.1); }
.table-card { background:#fff; border-radius:14px; border:1px solid #e8edf2; overflow:hidden; }
.table-card-header { padding:13px 18px; background:#f8fafc; border-bottom:1px solid #e8edf2; display:flex; align-items:center; justify-content:space-between; gap:12px; }
.table-card-header h6 { font-size:13.5px; font-weight:700; color:#1e293b; margin:0; display:flex; align-items:center; gap:8px; }
.table-card table thead th { font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:.4px; padding:12px 16px; background:#f8fafc; border-bottom:1px solid #e8edf2; border-top:none; }
.table-card table tbody td { padding:13px 16px; vertical-align:middle; border-bottom:1px solid #f1f5f9; font-size:13.5px; }
.table-card table tbody tr:last-child td { border-bottom:none; }
.table-card table tbody tr:hover { background:#f9fffe; }
.badge-tipe { display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:700; padding:3px 10px; border-radius:999px; }
.badge-puisi  { background:#dcfce7; color:#15803d; border:1px solid #bbf7d0; }
.badge-cerpen { background:#d1fae5; color:#065f46; border:1px solid #a7f3d0; }
.badge-pantun { background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe; }
.badge-syair  { background:#fef3c7; color:#92400e; border:1px solid #fde68a; }
.badge-pub    { background:#f0fdf4; color:#15803d; border:1px solid #bbf7d0; }
.badge-draft  { background:#f8fafc; color:#94a3b8; border:1px solid #e2e8f0; }
.btn-action { width:32px; height:32px; border-radius:8px; border:none; display:inline-flex; align-items:center; justify-content:center; font-size:13px; cursor:pointer; transition:all .18s; text-decoration:none; }
.btn-edit   { background:#eff6ff; color:#2563eb; }
.btn-edit:hover   { background:#2563eb; color:#fff; }
.btn-delete { background:#fef2f2; color:#ef4444; }
.btn-delete:hover { background:#ef4444; color:#fff; }
.empty-state { padding:60px 20px; text-align:center; }
.btn-add { background:linear-gradient(135deg,#1e7b1c,#27AE60); color:#fff; border:none; padding:9px 20px; border-radius:10px; font-size:13px; font-weight:700; display:inline-flex; align-items:center; gap:6px; text-decoration:none; transition:opacity .2s; }
.btn-add:hover { opacity:.88; color:#fff; }
</style>
@endpush

@section('content')

<div class="page-hero">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="font-size:20px;"><i class="bi bi-feather me-2"></i>Karya Sastra — Jejak Pena</h2>
            <p style="font-size:13px;opacity:.8;margin:0;">Kelola karya puisi, cerpen, pantun & syair yang ditampilkan di halaman publik &mdash; <strong style="opacity:1;">{{ $totalAll }}</strong> karya total</p>
        </div>
    </div>
</div>

{{-- Stat Cards --}}
<div class="stat-cards">
    <a href="{{ route('admin.karya-sastra.index') }}" class="stat-card {{ !$tipe ? 'active' : '' }}" style="text-decoration:none;">
        <div class="stat-icon" style="background:#f0fdf4;color:#1e7b1c;"><i class="bi bi-grid-3x2-gap-fill"></i></div>
        <div><div class="stat-val">{{ $totalAll }}</div><div class="stat-lbl">Semua</div></div>
    </a>
    @foreach(['puisi'=>['bi-journal-text','#eff9ef','#1e7b1c'],'cerpen'=>['bi-book','#ecfdf5','#065f46'],'pantun'=>['bi-music-note-beamed','#eff6ff','#1d4ed8'],'syair'=>['bi-stars','#fef9ee','#92400e']] as $t=>[$icon,$bg,$col])
    <a href="{{ route('admin.karya-sastra.index', ['tipe'=>$t]) }}" class="stat-card {{ $tipe===$t ? 'active' : '' }}" style="text-decoration:none;">
        <div class="stat-icon" style="background:{{ $bg }};color:{{ $col }};"><i class="bi {{ $icon }}"></i></div>
        <div><div class="stat-val">{{ $counts[$t] ?? 0 }}</div><div class="stat-lbl">{{ ucfirst($t) }}</div></div>
    </a>
    @endforeach
</div>

{{-- Filter & Tambah --}}
<form method="GET" action="{{ route('admin.karya-sastra.index') }}" id="filterForm">
    <input type="hidden" name="tipe" value="{{ $tipe }}">
    <div class="filter-bar">
        <div class="search-group">
            <i class="bi bi-search"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul karya..." autocomplete="off" id="searchInput">
        </div>
        @if($search)
        <a href="{{ route('admin.karya-sastra.index', ['tipe'=>$tipe]) }}" style="font-size:12px;color:#94a3b8;text-decoration:none;display:flex;align-items:center;gap:4px;white-space:nowrap;">
            <i class="bi bi-x-circle"></i> Reset
        </a>
        @endif
        <a href="{{ route('admin.karya-sastra.create', ['tipe'=>$tipe ?: 'puisi']) }}" class="btn-add">
            <i class="bi bi-plus-circle-fill"></i> Tambah {{ $tipe ? ucfirst($tipe) : 'Karya' }}
        </a>
    </div>
</form>

{{-- Table --}}
<div class="table-card">
    <div class="table-card-header">
        <h6>
            <span style="width:26px;height:26px;border-radius:8px;background:linear-gradient(135deg,#1e7b1c,#166534);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:12px;">
                <i class="bi bi-feather"></i>
            </span>
            Daftar Karya Sastra
        </h6>
        <div style="font-size:12px;color:#94a3b8;">
            Menampilkan <strong style="color:#1e7b1c;">{{ $karyas->firstItem() ?? 0 }}–{{ $karyas->lastItem() ?? 0 }}</strong>
            dari <strong style="color:#1e7b1c;">{{ $karyas->total() }}</strong>
        </div>
    </div>

    @if($karyas->count() > 0)
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipe</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Status</th>
                    <th>Urutan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyas as $k)
                <tr>
                    <td style="color:#94a3b8;font-weight:600;">{{ $karyas->firstItem() + $loop->index }}</td>
                    <td>
                        @php $tipeIcons=['puisi'=>'bi-journal-text','cerpen'=>'bi-book','pantun'=>'bi-music-note-beamed','syair'=>'bi-stars']; @endphp
                        <span class="badge-tipe badge-{{ $k->tipe }}">
                            <i class="bi {{ $tipeIcons[$k->tipe] ?? 'bi-file' }}"></i>
                            {{ ucfirst($k->tipe) }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight:700;color:#1e293b;font-size:14px;">{{ $k->judul }}</div>
                        @if($k->tema || $k->jenis)
                        <div style="font-size:11.5px;color:#94a3b8;margin-top:2px;">{{ $k->tema ?: $k->jenis }}</div>
                        @endif
                    </td>
                    <td style="font-size:13px;color:#374151;">{{ $k->penulis }}</td>
                    <td>
                        <span class="badge-tipe {{ $k->is_published ? 'badge-pub' : 'badge-draft' }}">
                            <i class="bi {{ $k->is_published ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                            {{ $k->is_published ? 'Publik' : 'Draft' }}
                        </span>
                    </td>
                    <td style="font-size:13px;color:#94a3b8;text-align:center;">{{ $k->sort_order }}</td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('admin.karya-sastra.edit', $k->id) }}" class="btn-action btn-edit" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <button type="button" class="btn-action btn-delete"
                                onclick="openDeleteModal({{ $k->id }}, '{{ addslashes($k->judul) }}')"
                                title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($karyas->hasPages())
    <div class="d-flex justify-content-center py-3 border-top">
        {{ $karyas->links('pagination::bootstrap-5') }}
    </div>
    @endif
    @else
    <div class="empty-state">
        <div style="width:72px;height:72px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:28px;color:#94a3b8;">
            <i class="bi bi-feather"></i>
        </div>
        <h5 style="font-size:15px;font-weight:700;color:#374151;margin-bottom:6px;">Belum Ada Karya</h5>
        <p style="font-size:13px;color:#94a3b8;">Tambahkan karya sastra baru dengan tombol "Tambah Karya" di atas.</p>
    </div>
    @endif
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:0 20px 60px rgba(0,0,0,.15);">
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-4">
                    <div style="width:64px;height:64px;background:#fef2f2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                        <i class="bi bi-trash-fill" style="font-size:26px;color:#ef4444;"></i>
                    </div>
                    <p style="font-size:14px;font-weight:700;color:#1e293b;margin-bottom:6px;">Hapus karya ini?</p>
                    <p id="delName" style="font-size:13px;color:#1e7b1c;font-weight:700;margin-bottom:8px;"></p>
                    <p style="font-size:13px;color:#64748b;margin:0;">Data karya akan dihapus secara permanen dari database.</p>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f1f5f9;padding:12px 20px;">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius:8px;font-weight:700;">
                        <i class="bi bi-trash-fill me-1"></i> Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openDeleteModal(id, judul) {
    document.getElementById('delName').textContent = '"' + judul + '"';
    document.getElementById('formHapus').action = '/admin/karya-sastra/' + id;
    new bootstrap.Modal(document.getElementById('modalHapus')).show();
}
let debounce;
document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(debounce);
    debounce = setTimeout(() => document.getElementById('filterForm').submit(), 500);
});
</script>
@endpush
