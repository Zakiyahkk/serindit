@extends('admin.layout')

@section('title', 'Tambah Warta Basa — Admin')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
.form-card { background:#fff; border-radius:14px; border:1px solid #e8edf2; padding:28px 32px; }
.form-label { font-size:13px; font-weight:600; color:#374151; margin-bottom:6px; }
.form-control { border:1.5px solid #e2e8f0; border-radius:9px; font-size:13.5px; padding:9px 12px; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="font-size:20px;">Tambah Warta Basa</h2>
    <a href="{{ route('admin.warta-basa.index') }}" class="btn btn-light" style="border-radius:10px;">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<form method="POST" action="{{ route('admin.warta-basa.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="form-card">
                <div class="mb-3">
                    <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Tim Redaksi / Penulis <span class="text-danger">*</span></label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis', 'Tim Redaksi') }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Isi Berita <span class="text-danger">*</span></label>
                    <textarea name="konten" class="form-control" id="summernote" required>{{ old('konten') }}</textarea>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="form-card mb-4">
                <div class="mb-3">
                    <label class="form-label">Foto Thumbnail</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <div class="form-text" style="font-size:11px;">(Maks 2MB. Diperbolehkan: jpg, png, gif)</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Status Tayang</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" id="isPublished" value="1" checked>
                        <label class="form-check-label" for="isPublished" style="font-size:13px;">Tampilkan ke publik</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success w-100 mt-3" style="border-radius:10px;">
                    <i class="bi bi-send-check me-1"></i> Terbitkan Berita
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
    $('#summernote').summernote({
        placeholder: 'Tulis isi berita di sini...',
        tabsize: 2,
        height: 400,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'italic', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
@endpush
