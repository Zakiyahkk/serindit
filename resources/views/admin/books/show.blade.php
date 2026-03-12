@extends('admin.layout')

@section('title', 'Detail Majalah')

@push('styles')
<style>

.detail-header{
background:linear-gradient(135deg,#6366f1 0%,#4f46e5 60%,#7c3aed 100%);
border-radius:16px;
padding:28px 32px;
color:#fff;
margin-bottom:24px;
position:relative;
overflow:hidden;
}

.detail-header::after{
content:'';
position:absolute;
right:-30px;
top:-30px;
width:200px;
height:200px;
background:rgba(255,255,255,0.06);
border-radius:50%;
}

.detail-header h2{
font-size:22px;
font-weight:700;
margin:0 0 4px;
position:relative;
z-index:1;
}

.detail-header p{
font-size:13px;
margin:0;
opacity:.75;
position:relative;
z-index:1;
}

.btn-back{
background:rgba(255,255,255,.2);
color:#fff;
border:1.5px solid rgba(255,255,255,.35);
border-radius:10px;
padding:9px 18px;
font-size:13px;
font-weight:600;
text-decoration:none;
display:flex;
align-items:center;
gap:7px;
backdrop-filter:blur(4px);
transition:.2s;
}

.btn-back:hover{
background:rgba(255,255,255,.3);
color:#fff;
}

.info-card{
background:#fff;
border-radius:14px;
border:1px solid #e8edf2;
overflow:hidden;
margin-bottom:20px;
}

.info-card-header{
display:flex;
align-items:center;
gap:10px;
padding:14px 20px;
background:#f8fafc;
border-bottom:1px solid #e8edf2;
}

.info-card-header .ic-icon{
width:30px;
height:30px;
border-radius:8px;
display:flex;
align-items:center;
justify-content:center;
font-size:14px;
color:#fff;
flex-shrink:0;
}

.info-card-header h6{
margin:0;
font-size:13.5px;
font-weight:700;
color:#1e293b;
}

.info-card-body{
padding:20px;
}

.detail-row{
display:flex;
gap:12px;
padding:10px 0;
border-bottom:1px solid #f1f5f9;
font-size:13.5px;
}

.detail-row:last-child{
border-bottom:none;
}

.detail-label{
min-width:140px;
font-weight:600;
color:#64748b;
font-size:12.5px;
}

.detail-value{
color:#1e293b;
flex:1;
}

.cover-box{
border-radius:12px;
overflow:hidden;
border:2px solid #e2e8f0;
box-shadow:0 4px 20px rgba(0,0,0,.08);
}

.cover-box img{
width:100%;
display:block;
max-height:360px;
object-fit:cover;
}

.cover-placeholder{
width:100%;
height:280px;
background:linear-gradient(135deg,#f1f5f9,#e2e8f0);
display:flex;
flex-direction:column;
align-items:center;
justify-content:center;
color:#94a3b8;
gap:10px;
}

/* PDF */

.pdf-box{
display:flex;
align-items:center;
gap:14px;
padding:14px 16px;
background:#fef2f2;
border:1.5px solid #fecaca;
border-radius:10px;
}

.pdf-icon{
font-size:28px;
color:#ef4444;
flex-shrink:0;
}

.pdf-text{
display:flex;
flex-direction:column;
min-width:0;
}

.pdf-name{
font-size:13px;
font-weight:600;
color:#374151;
overflow:hidden;
text-overflow:ellipsis;
white-space:nowrap;
max-width:200px;
}

.pdf-label{
font-size:11.5px;
color:#94a3b8;
}

.tag-list{
display:flex;
flex-wrap:wrap;
gap:6px;
}

.tag{
padding:4px 12px;
border-radius:20px;
font-size:12px;
font-weight:500;
}

.tag-cat{
background:#eff6ff;
color:#3b82f6;
border:1px solid #bfdbfe;
}

.action-bar{
background:#fff;
border:1px solid #e8edf2;
border-radius:12px;
padding:14px 20px;
display:flex;
gap:10px;
align-items:center;
}

.btn-edit-main{
background:linear-gradient(135deg,#6366f1,#4f46e5);
color:#fff;
border:none;
border-radius:9px;
padding:9px 22px;
font-size:13.5px;
font-weight:600;
text-decoration:none;
display:flex;
align-items:center;
gap:7px;
}

.btn-delete-main{
background:#fef2f2;
color:#ef4444;
border:1.5px solid #fecaca;
border-radius:9px;
padding:9px 18px;
font-size:13.5px;
font-weight:600;
cursor:pointer;
display:flex;
align-items:center;
gap:7px;
}

</style>
@endpush

@section('content')

<div class="detail-header">
<div class="d-flex justify-content-between align-items-start">

<div>
<h2><i class="bi bi-journal-text me-2"></i>{{ $book->title }}</h2>
<p>Detail informasi majalah Serindit</p>
</div>

<a href="{{ route('admin.books.index') }}" class="btn-back">
<i class="bi bi-arrow-left"></i> Kembali
</a>

</div>
</div>

<div class="row g-4">

<div class="col-lg-4">

<div class="info-card">
<div class="info-card-header">
<div class="ic-icon" style="background:linear-gradient(135deg,#ec4899,#db2777);">
<i class="bi bi-image"></i>
</div>
<h6>Cover Majalah</h6>
</div>

<div class="info-card-body p-0">

@if($book->cover_image)

<div class="cover-box">
<img src="{{ asset('storage/'.$book->cover_image) }}">
</div>

@else

<div class="cover-placeholder">
<i class="bi bi-image" style="font-size:48px;"></i>
<span>Belum ada cover</span>
</div>

@endif

</div>
</div>

<div class="info-card">

<div class="info-card-header">
<div class="ic-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626);">
<i class="bi bi-file-pdf"></i>
</div>
<h6>File PDF</h6>
</div>

<div class="info-card-body">

@if($book->pdf_file)

<a href="{{ asset('storage/'.$book->pdf_file) }}" target="_blank" class="pdf-box" style="text-decoration:none;">

<i class="bi bi-file-pdf-fill pdf-icon"></i>

<div class="pdf-text">

<div class="pdf-name">
{{ basename($book->pdf_file) }}
</div>

<div class="pdf-label">
Klik untuk membuka file PDF
</div>

</div>

</a>

@else

<div class="text-center py-3" style="color:#94a3b8;font-size:13px;">
<i class="bi bi-file-earmark-x" style="font-size:28px;display:block;margin-bottom:6px;"></i>
Belum ada file PDF
</div>

@endif

</div>
</div>

</div>

<div class="col-lg-8">

<div class="info-card">

<div class="info-card-header">
<div class="ic-icon" style="background:linear-gradient(135deg,#6366f1,#4f46e5);">
<i class="bi bi-info-circle"></i>
</div>
<h6>Informasi Majalah</h6>
</div>

<div class="info-card-body">

<div class="detail-row">
<span class="detail-label">Judul</span>
<span class="detail-value fw-semibold">{{ $book->title }}</span>
</div>

<div class="detail-row">
<span class="detail-label">Sub Judul</span>
<span class="detail-value">{{ $book->description ?? '—' }}</span>
</div>

<div class="detail-row">
<span class="detail-label">Volume</span>
<span class="detail-value">{{ $book->volume ?? '—' }}</span>
</div>

<div class="detail-row">
<span class="detail-label">Nomor</span>
<span class="detail-value">{{ $book->nomor ?? '—' }}</span>
</div>

<div class="detail-row">
<span class="detail-label">Terbitan</span>
<span class="detail-value">{{ $book->terbitan ?? '—' }}</span>
</div>

<div class="detail-row">
<span class="detail-label">ISSN</span>
<span class="detail-value">
<span style="background:#f8fafc;border:1px solid #e2e8f0;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
<i class="bi bi-upc-scan me-1"></i>
{{ $book->issn ?? '—' }}
</span>
</span>
</div>

<div class="detail-row">
<span class="detail-label">Ditambahkan</span>
<span class="detail-value">
{{ \Carbon\Carbon::parse($book->created_at)->format('d M Y, H:i') }}
</span>
</div>

<div class="detail-row">
<span class="detail-label">Diperbarui</span>
<span class="detail-value">
{{ \Carbon\Carbon::parse($book->updated_at)->diffForHumans() }}
</span>
</div>

</div>
</div>

<div class="info-card">

<div class="info-card-header">
<div class="ic-icon" style="background:linear-gradient(135deg,#10b981,#059669);">
<i class="bi bi-tags"></i>
</div>
<h6>Kategori</h6>
</div>

<div class="info-card-body">

<div class="detail-row">
<span class="detail-label">Kategori</span>
<span class="detail-value">

@if($categories->count())

<div class="tag-list">

@foreach($categories as $cat)
<span class="tag tag-cat">{{ $cat->name }}</span>
@endforeach

</div>

@else

<span style="color:#94a3b8;">—</span>

@endif

</span>
</div>

</div>
</div>

<div class="action-bar">

<a href="{{ route('admin.books.edit',$book->id) }}" class="btn-edit-main">
<i class="bi bi-pencil-square"></i> Edit Majalah
</a>

<form action="{{ route('admin.books.destroy',$book->id) }}" method="POST"
onsubmit="return confirm('Yakin ingin menghapus majalah ini?')">

@csrf
@method('DELETE')

<button type="submit" class="btn-delete-main">
<i class="bi bi-trash"></i> Hapus
</button>

</form>

</div>

</div>

</div>

@endsection
