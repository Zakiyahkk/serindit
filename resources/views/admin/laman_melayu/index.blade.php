@extends('admin.layout')

@section('title', 'Daftar Laman Melayu — Admin Serindit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="font-size:20px;">Laman Melayu</h2>
    <a href="{{ route('admin.laman-melayu.create') }}" class="btn btn-success" style="border-radius:10px;">
        <i class="bi bi-plus-circle me-1"></i> Tambah Tulisan
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:15px;">
    <div class="card-body p-4">
        
        <form method="GET" action="{{ route('admin.laman-melayu.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="border-radius:10px 0 0 10px;">Judul</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th style="border-radius:0 10px 10px 0;text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyas as $k)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $k->judul }}</div>
                            <small class="text-muted">{{ $k->created_at->format('d M Y') }}</small>
                        </td>
                        <td>{{ $k->penulis }}</td>
                        <td>
                            @if ($k->is_published)
                                <span class="badge bg-success">Publik</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $k->views }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.laman-melayu.edit', $k->id) }}" class="btn btn-sm btn-light text-primary" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.laman-melayu.destroy', $k->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada tulisan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $karyas->links('pagination::bootstrap-5') }}
        </div>
        
    </div>
</div>
@endsection
