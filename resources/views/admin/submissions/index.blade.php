@extends('admin.layout')

@section('title', 'Kiriman Naskah')

@push('styles')
<style>
.page-hero {
    background: linear-gradient(135deg, #0b3d0a 0%, #1e7b1c 60%, #27AE60 100%);
    border-radius: 16px;
    padding: 28px 32px;
    color: #fff;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
}
.page-hero::after {
    content: '';
    position: absolute;
    right: -30px; top: -30px;
    width: 200px; height: 200px;
    background: rgba(255,255,255,0.06);
    border-radius: 50%;
    pointer-events: none;
}
.stat-cards { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 18px; }
.stat-card { background: #fff; border-radius: 12px; border: 1px solid #e8edf2; padding: 16px 18px; display: flex; align-items: center; gap: 12px; }
.stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
.stat-val { font-size: 22px; font-weight: 800; color: #1e293b; line-height: 1; }
.stat-lbl { font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; margin-top: 2px; }
.filter-bar { background:#fff; border-radius:12px; border:1px solid #e8edf2; padding:14px 18px; margin-bottom:16px; display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.search-group { position:relative; flex:1; min-width:200px; }
.search-group i { position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:13px; pointer-events:none; }
.search-group input { width:100%; padding:8px 12px 8px 32px; border:1.5px solid #e2e8f0; border-radius:9px; font-size:13px; }
.search-group input:focus { outline:none; border-color:#1e7b1c; box-shadow:0 0 0 3px rgba(30,123,28,.1); }
.filter-select { padding:8px 28px 8px 10px; border:1.5px solid #e2e8f0; border-radius:9px; font-size:13px; color:#374151; background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") no-repeat right 8px center; appearance:none; cursor:pointer; }
.filter-select:focus { outline:none; border-color:#1e7b1c; }
.table-card { background:#fff; border-radius:14px; border:1px solid #e8edf2; overflow:hidden; }
.table-card-header { padding:13px 18px; background:#f8fafc; border-bottom:1px solid #e8edf2; display:flex; align-items:center; justify-content:space-between; gap:12px; }
.table-card-header h6 { font-size:13.5px; font-weight:700; color:#1e293b; margin:0; display:flex; align-items:center; gap:8px; }
.table-card table thead th { font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:.4px; padding:12px 16px; background:#f8fafc; border-bottom:1px solid #e8edf2; border-top:none; }
.table-card table tbody td { padding:13px 16px; vertical-align:middle; border-bottom:1px solid #f1f5f9; font-size:13.5px; }
.table-card table tbody tr:last-child td { border-bottom:none; }
.table-card table tbody tr:hover { background:#f9fffe; }
.badge-status { display:inline-flex; align-items:center; gap:5px; font-size:11.5px; font-weight:700; padding:4px 12px; border-radius:999px; }
.badge-pending  { background:#fff7ed; color:#c2410c; border:1px solid #fed7aa; }
.badge-diterima { background:#f0fdf4; color:#15803d; border:1px solid #bbf7d0; }
.badge-ditolak  { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; }
.btn-action { width:32px; height:32px; border-radius:8px; border:none; display:inline-flex; align-items:center; justify-content:center; font-size:13px; cursor:pointer; transition:all .18s; text-decoration:none; }
.btn-view   { background:#effff1; color:#16a34a; }
.btn-view:hover   { background:#16a34a; color:#fff; }
.btn-delete { background:#fef2f2; color:#ef4444; }
.btn-delete:hover { background:#ef4444; color:#fff; }
.empty-state { padding:60px 20px; text-align:center; }
.empty-state .empty-icon { width:72px; height:72px; background:#f1f5f9; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 14px; font-size:28px; color:#94a3b8; }
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="page-hero">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1" style="font-size:20px;"><i class="bi bi-envelope-paper-fill me-2"></i>Kiriman Naskah</h2>
            <p style="font-size:13px;opacity:.8;margin:0;">Kelola naskah yang dikirimkan melalui Kanal Naskah — <strong style="opacity:1;">{{ $totalAll }}</strong> kiriman total</p>
        </div>
    </div>
</div>

{{-- Stat Cards --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-icon" style="background:#eff6ff;color:#2563eb;"><i class="bi bi-inbox-fill"></i></div>
        <div>
            <div class="stat-val">{{ $totalAll }}</div>
            <div class="stat-lbl">Total</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fff7ed;color:#d97706;"><i class="bi bi-hourglass-split"></i></div>
        <div>
            <div class="stat-val">{{ $totalPending }}</div>
            <div class="stat-lbl">Pending</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;"><i class="bi bi-check-circle-fill"></i></div>
        <div>
            <div class="stat-val">{{ $totalDiterima }}</div>
            <div class="stat-lbl">Diterima</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fef2f2;color:#ef4444;"><i class="bi bi-x-circle-fill"></i></div>
        <div>
            <div class="stat-val">{{ $totalDitolak }}</div>
            <div class="stat-lbl">Ditolak</div>
        </div>
    </div>
</div>

{{-- Filter --}}
<form method="GET" action="{{ route('admin.submissions.index') }}" id="filterForm">
    <div class="filter-bar">
        <div class="search-group">
            <i class="bi bi-search"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, email, atau no HP..." autocomplete="off" id="searchInput">
        </div>
        <select name="status" class="filter-select" onchange="this.form.submit()">
            <option value="">📋 Semua Status</option>
            <option value="pending"  {{ $status==='pending'  ? 'selected' : '' }}>⏳ Pending</option>
            <option value="diterima" {{ $status==='diterima' ? 'selected' : '' }}>✅ Diterima</option>
            <option value="ditolak"  {{ $status==='ditolak'  ? 'selected' : '' }}>❌ Ditolak</option>
        </select>
        @if($search || $status)
        <a href="{{ route('admin.submissions.index') }}" style="font-size:12px;color:#94a3b8;text-decoration:none;display:flex;align-items:center;gap:4px;white-space:nowrap;">
            <i class="bi bi-x-circle"></i> Reset
        </a>
        @endif
    </div>
</form>

{{-- Table Card --}}
<div class="table-card">
    <div class="table-card-header">
        <h6>
            <span style="width:26px;height:26px;border-radius:8px;background:linear-gradient(135deg,#1e7b1c,#166534);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:12px;">
                <i class="bi bi-envelope-paper-fill"></i>
            </span>
            Daftar Kiriman
        </h6>
        <div style="font-size:12px;color:#94a3b8;">
            Menampilkan <strong style="color:#1e7b1c;">{{ $submissions->firstItem() ?? 0 }}–{{ $submissions->lastItem() ?? 0 }}</strong>
            dari <strong style="color:#1e7b1c;">{{ $submissions->total() }}</strong> kiriman
        </div>
    </div>

    @if($submissions->count() > 0)
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pengirim</th>
                    <th>Kontak</th>
                    <th>Naskah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $s)
                <tr>
                    <td style="color:#94a3b8;font-weight:600;">{{ $submissions->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="font-weight:700;color:#1e293b;font-size:14px;">{{ $s->nama }}</div>
                    </td>
                    <td>
                        <div style="font-size:12.5px;color:#374151;"><i class="bi bi-envelope me-1 text-blue-500"></i>{{ $s->email }}</div>
                        <div style="font-size:12px;color:#94a3b8;"><i class="bi bi-telephone me-1"></i>{{ $s->no_hp }}</div>
                    </td>
                    <td>
                        @if($s->file_naskah)
                            <span style="font-size:11.5px;font-weight:600;color:#2563eb;background:#eff6ff;padding:3px 10px;border-radius:999px;border:1px solid #bfdbfe;">
                                <i class="bi bi-file-earmark-word me-1"></i>Ada
                            </span>
                        @else
                            <span style="font-size:11.5px;color:#94a3b8;">—</span>
                        @endif
                        @if($s->file_foto)
                            <span style="font-size:11.5px;font-weight:600;color:#d97706;background:#fef3c7;padding:3px 10px;border-radius:999px;border:1px solid #fde68a;margin-left:4px;">
                                <i class="bi bi-images me-1"></i>ZIP
                            </span>
                        @endif
                    </td>
                    <td>
                        @php
                            $badgeMap = ['pending'=>'badge-pending','diterima'=>'badge-diterima','ditolak'=>'badge-ditolak'];
                            $iconMap  = ['pending'=>'bi-hourglass-split','diterima'=>'bi-check-circle-fill','ditolak'=>'bi-x-circle-fill'];
                            $labelMap = ['pending'=>'Pending','diterima'=>'Diterima','ditolak'=>'Ditolak'];
                        @endphp
                        <span class="badge-status {{ $badgeMap[$s->status] ?? 'badge-pending' }}">
                            <i class="bi {{ $iconMap[$s->status] ?? 'bi-hourglass-split' }}"></i>
                            {{ $labelMap[$s->status] ?? 'Pending' }}
                        </span>
                    </td>
                    <td style="font-size:12px;color:#64748b;white-space:nowrap;">
                        {{ \Carbon\Carbon::parse($s->created_at)->format('d M Y') }}<br>
                        <span style="color:#94a3b8;">{{ \Carbon\Carbon::parse($s->created_at)->format('H:i') }}</span>
                    </td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('admin.submissions.show', $s->id) }}" class="btn-action btn-view" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <button type="button" class="btn-action btn-delete"
                                onclick="openDeleteModal({{ $s->id }}, '{{ addslashes($s->nama) }}')"
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
    @if($submissions->hasPages())
    <div class="d-flex justify-content-center py-3 border-top">
        {{ $submissions->links('pagination::bootstrap-5') }}
    </div>
    @endif
    @else
    <div class="empty-state">
        <div class="empty-icon"><i class="bi bi-envelope-paper"></i></div>
        <h5 style="font-size:15px;font-weight:700;color:#374151;margin-bottom:6px;">
            {{ $search || $status ? 'Tidak Ada Hasil' : 'Belum Ada Kiriman Naskah' }}
        </h5>
        <p style="font-size:13px;color:#94a3b8;">
            {{ $search || $status ? 'Coba ubah kata kunci atau filter yang digunakan.' : 'Kiriman naskah dari pengunjung akan muncul di sini.' }}
        </p>
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
                    <p style="font-size:14px;font-weight:700;color:#1e293b;margin-bottom:6px;">Hapus kiriman ini?</p>
                    <p id="delName" style="font-size:13px;color:#6366f1;font-weight:700;margin-bottom:8px;"></p>
                    <p style="font-size:13px;color:#64748b;margin:0;">File naskah dan foto akan ikut terhapus secara permanen.</p>
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
function openDeleteModal(id, nama) {
    document.getElementById('delName').textContent = '"' + nama + '"';
    document.getElementById('formHapus').action = '/admin/submissions/' + id;
    new bootstrap.Modal(document.getElementById('modalHapus')).show();
}
let debounce;
document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(debounce);
    debounce = setTimeout(() => document.getElementById('filterForm').submit(), 500);
});
</script>
@endpush
