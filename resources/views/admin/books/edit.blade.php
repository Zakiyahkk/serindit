@extends('admin.layout')

@section('title', 'Edit Majalah')

@push('styles')
<style>

.row.g-4{
align-items:flex-start;
--bs-gutter-y:0;
}

.form-control.description-area{
height:120px;
}

.form-section{
background:#fff;
border-radius:12px;
border:1px solid #e8edf2;
margin-bottom:16px;
overflow:hidden;
}

.form-section-header{
display:flex;
align-items:center;
gap:10px;
padding:16px 20px;
background:#f8fafc;
border-bottom:1px solid #e8edf2;
}

.section-icon{
width:32px;
height:32px;
border-radius:8px;
display:flex;
align-items:center;
justify-content:center;
font-size:15px;
color:#fff;
flex-shrink:0;
}

.form-section-header h6{
margin:0;
font-size:14px;
font-weight:600;
color:#1e293b;
}

.form-section-header p{
margin:0;
font-size:12px;
color:#94a3b8;
}

.form-section-body{
padding:20px;
}

.form-label{
font-size:13px;
font-weight:600;
color:#374151;
margin-bottom:6px;
}

.form-control{
font-size:13.5px;
border-radius:8px;
border:1.5px solid #e2e8f0;
padding:9px 13px;
}

.check-grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:8px;
}

.check-item{
display:flex;
align-items:center;
gap:9px;
padding:9px 13px;
border:1.5px solid #e2e8f0;
border-radius:8px;
cursor:pointer;
}

.check-item input{
accent-color:#6366f1;
}

.upload-area{
border:2px dashed #e2e8f0;
border-radius:10px;
height:77px;
display:flex;
flex-direction:column;
align-items:center;
justify-content:center;
cursor:pointer;
position:relative;
}

.upload-area:hover{
border-color:#6366f1;
background:#f5f3ff;
}

.upload-area input{
position:absolute;
inset:0;
opacity:0;
cursor:pointer;
}

.upload-icon{
font-size:20px;
color:#cbd5e1;
}

.upload-text{
font-size:10px;
font-weight:500;
color:#64748b;
}

.upload-hint{
font-size:10px;
color:#b0bec5;
}

/* preview file */

.file-preview-box{
display:none;
align-items:center;
justify-content:space-between;
gap:12px;
padding:0 16px;
height:72px;
background:#f8fafc;
border:2px dashed #e2e8f0;
border-radius:10px;
margin-bottom:5px;
width:100%;
}

.file-preview-left{
display:flex;
align-items:center;
gap:12px;
flex:1;
min-width:0;
}

.file-preview-info{
display:flex;
flex-direction:column;
flex:1;
min-width:0;
}

.file-preview-name{
font-size:13px;
font-weight:500;
color:#374151;
overflow:hidden;
text-overflow:ellipsis;
white-space:nowrap;
max-width:200px;
}

.file-preview-size{
font-size:11.5px;
color:#94a3b8;
}

.file-remove-btn{
background:#e2e8f0;
border:none;
border-radius:50%;
width:26px;
height:26px;
cursor:pointer;
display:flex;
align-items:center;
justify-content:center;
}

.submit-bar{
background:#fff;
border:1px solid #e8edf2;
border-radius:12px;
padding:16px 20px;
display:flex;
justify-content:space-between;
align-items:center;
}

.btn-submit{
background:linear-gradient(135deg,#6366f1,#4f46e5);
color:#fff;
border:none;
border-radius:10px;
padding:10px 28px;
font-size:14px;
font-weight:600;
}

.btn-cancel{
background:#f1f5f9;
color:#64748b;
border:none;
border-radius:10px;
padding:10px 24px;
text-decoration:none;
}

.page-header{
margin-bottom:20px;
}

.page-header h3{
font-size:20px;
font-weight:700;
color:#1e293b;
margin-bottom:4px;
}

.page-header p{
font-size:13px;
color:#94a3b8;
margin:0;
}

</style>
@endpush


@section('content')

<div class="page-header">
<div class="d-flex justify-content-between align-items-center">

<div>
<h3><i class="bi bi-pencil-square me-2" style="color:#6366f1;"></i>Edit Majalah</h3>
<p>Perbarui informasi majalah</p>
</div>

<a href="{{ route('admin.books.index') }}" class="btn-cancel">
<i class="bi bi-arrow-left"></i> Kembali
</a>

</div>
</div>


<form action="{{ route('admin.books.update',$book->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')


<div class="row g-4">


<!-- LEFT -->

<div class="col-lg-8">

<div class="form-section">
<div class="form-section-header">
<div class="section-icon" style="background:linear-gradient(135deg,#6366f1,#4f46e5);">
<i class="bi bi-book"></i>
</div>
<div>
<h6>Informasi Utama</h6>
<p>Judul dan sub judul majalah</p>
</div>
</div>

<div class="form-section-body">

<div class="mb-4">
<label class="form-label">Judul Majalah</label>
<input type="text" name="title" class="form-control"
value="{{ old('title',$book->title) }}">
</div>

<div>
<label class="form-label">Sub Judul</label>
<textarea name="description" class="form-control description-area">{{ old('description',$book->description) }}</textarea>
</div>

</div>
</div>

<div class="form-section">
<div class="form-section-header">
<div class="section-icon" style="background:linear-gradient(135deg,#0ea5e9,#0284c7);">
<i class="bi bi-people"></i>
</div>
<div>
<h6>Detail</h6>
<p>Informasi edisi majalah</p>
</div>
</div>

<div class="form-section-body">

<div class="row g-3">

<div class="col-md-6">
<label class="form-label">Volume</label>
<input type="text" name="volume" class="form-control"
value="{{ old('volume',$book->volume) }}">
</div>

<div class="col-md-6">
<label class="form-label">Nomor</label>
<input type="text" name="nomor" class="form-control"
value="{{ old('nomor',$book->nomor) }}">
</div>

<div class="col-md-6">
<label class="form-label">Terbitan</label>
<input type="text" name="terbitan" class="form-control"
value="{{ old('terbitan',$book->terbitan) }}">
</div>

<div class="col-md-6">
<label class="form-label">ISSN</label>
<input type="text" name="issn" class="form-control"
value="{{ old('issn',$book->issn) }}">
</div>

</div>

</div>
</div>

</div>


<!-- RIGHT -->

<div class="col-lg-4">

<div class="form-section">
<div class="form-section-header">
<div class="section-icon" style="background:linear-gradient(135deg,#ec4899,#db2777);">
<i class="bi bi-image"></i>
</div>
<div>
<h6>Cover Majalah</h6>
<p>Gambar sampul majalah</p>
</div>
</div>

<div class="form-section-body">

<div id="coverPreviewBox" class="file-preview-box" style="{{ $book->cover_image ? 'display:flex' : '' }}">

<div class="file-preview-left">
<i class="bi bi-image"></i>

<div class="file-preview-info">
<div id="coverName" class="file-preview-name">
{{ $book->cover_image ? basename($book->cover_image) : '' }}
</div>

<div id="coverSize" class="file-preview-size">
Cover saat ini
</div>
</div>

</div>

<button type="button" class="file-remove-btn" onclick="removeCover()">
<i class="bi bi-x"></i>
</button>

</div>

<div class="upload-area" id="coverUploadArea" style="{{ $book->cover_image ? 'display:none' : '' }}">

<input type="file" name="cover_image" id="cover_image" accept="image/*" onchange="previewCover(event)">

<div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
<div class="upload-text">Klik atau drag & drop</div>
<div class="upload-hint">JPG, PNG — Maks. 2MB</div>

</div>

</div>
</div>


<div class="form-section">
<div class="form-section-header">
<div class="section-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626);">
<i class="bi bi-file-pdf"></i>
</div>
<div>
<h6>File PDF</h6>
<p>Isi majalah untuk flipbook reader</p>
</div>
</div>

<div class="form-section-body">

<div id="pdfPreviewBox" class="file-preview-box" style="{{ $book->pdf_file ? 'display:flex' : '' }}">

<div class="file-preview-left">
<i class="bi bi-file-earmark-pdf"></i>

<div class="file-preview-info">
<div id="pdfName" class="file-preview-name">
{{ $book->pdf_file ? basename($book->pdf_file) : '' }}
</div>

<div id="pdfSize" class="file-preview-size">
File saat ini
</div>
</div>

</div>

<button type="button" class="file-remove-btn" onclick="removePdf()">
<i class="bi bi-x"></i>
</button>

</div>

<div class="upload-area" id="pdfUploadArea" style="{{ $book->pdf_file ? 'display:none' : '' }}">

<input type="file" name="pdf_file" id="pdf_file" accept=".pdf" onchange="previewPdf(event)">

<div class="upload-icon"><i class="bi bi-file-earmark-pdf"></i></div>
<div class="upload-text">Klik atau drag & drop</div>
<div class="upload-hint">PDF — Maks. 50MB</div>

</div>

</div>
</div>


<div class="form-section">
<div class="form-section-body">

<div style="font-size:13px;color:#64748b">

<div class="fw-semibold mb-2" style="color:#374151">
<i class="bi bi-lightbulb me-1" style="color:#f59e0b"></i>
Tips Pengisian
</div>

<ul class="mb-0 ps-3" style="line-height:1.9">
<li>Cover digunakan sebagai thumbnail di halaman utama</li>
<li>PDF adalah isi majalah yang bisa dibaca via flipbook</li>
<li>Detail majalah berisi tentang informasi edisi dan nomor ISSN majalah</li>
</ul>

</div>

</div>
</div>

</div>

<!-- SECTION: Daftar Isi (FULL WIDTH) -->
<div class="col-12">
<div class="form-section">

<div class="form-section-header">
<div class="section-icon" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed);">
<i class="bi bi-list-ol"></i>
</div>

<div>
<h6>Daftar Isi Majalah</h6>
<p>Navigasi interaktif untuk Flipbook Reader</p>
</div>
</div>

<div class="form-section-body">

<input type="hidden"
name="table_of_contents"
id="toc_hidden_input"
value="[]">

<div class="table-responsive">

<table class="table table-bordered table-sm mb-3">

<thead style="background:#f8fafc;">
<tr>
<th width="60%" class="text-muted" style="font-size:12px;font-weight:600;">
Judul Bab / Bagian
</th>

<th width="30%" class="text-muted" style="font-size:12px;font-weight:600;">
Halaman
</th>

<th width="10%" class="text-center text-muted" style="font-size:12px;font-weight:600;">
Aksi
</th>
</tr>
</thead>

<tbody id="toc_tbody">
</tbody>

</table>

</div>

<button type="button"
class="btn btn-sm btn-light border"
onclick="addTocRow()">

<i class="bi bi-plus-circle me-1"></i>
Tambah Baris

</button>

</div>
</div>
</div>

<!-- KATEGORI -->

<div class="col-12">

<div class="form-section">

<div class="form-section-header">
<div class="section-icon" style="background:linear-gradient(135deg,#10b981,#059669);">
<i class="bi bi-tags"></i>
</div>

<div>
<h6>Kategori</h6>
<p>Klasifikasi majalah</p>
</div>

</div>

<div class="form-section-body">

<div class="check-grid">

@foreach($categories as $category)

<label class="check-item">

<input type="checkbox"
name="categories[]"
value="{{ $category->id }}"
{{ in_array($category->id, old('categories',$selectedCategories)) ? 'checked' : '' }}>

<label style="pointer-events:none">
{{ $category->name }}
</label>

</label>

@endforeach

</div>

</div>

</div>

</div>

</div>


<div class="submit-bar mt-2">

<div style="font-size:13px;color:#94a3b8">
<i class="bi bi-clock-history me-1"></i>
Terakhir diupdate {{ \Carbon\Carbon::parse($book->updated_at)->diffForHumans() }}
</div>

<div class="d-flex gap-2">

<a href="{{ route('admin.books.index') }}" class="btn-cancel">
<i class="bi bi-x-circle"></i> Batal
</a>

<button type="submit" class="btn-submit">
<i class="bi bi-check-circle"></i> Simpan Perubahan
</button>

</div>

</div>

</form>


<script>

function previewCover(event){

const file=event.target.files[0]
if(!file) return

const size=(file.size/1024/1024).toFixed(2)

document.getElementById('coverName').textContent=file.name
document.getElementById('coverSize').textContent=size+' MB'

document.getElementById('coverPreviewBox').style.display='flex'
document.getElementById('coverUploadArea').style.display='none'

}

function removeCover(){

document.getElementById('cover_image').value=''
document.getElementById('coverPreviewBox').style.display='none'
document.getElementById('coverUploadArea').style.display='flex'

}

function previewPdf(event){

const file=event.target.files[0]
if(!file) return

const size=(file.size/1024/1024).toFixed(2)

document.getElementById('pdfName').textContent=file.name
document.getElementById('pdfSize').textContent=size+' MB'

document.getElementById('pdfPreviewBox').style.display='flex'
document.getElementById('pdfUploadArea').style.display='none'

}

function removePdf(){

document.getElementById('pdf_file').value=''
document.getElementById('pdfPreviewBox').style.display='none'
document.getElementById('pdfUploadArea').style.display='flex'

}

/* =========================
   TABLE OF CONTENTS LOGIC
========================= */

let tocItems = {!! $book->table_of_contents ?: '[]' !!};

if (!Array.isArray(tocItems)) {
    tocItems = [];
}

function renderToc(){

const tbody=document.getElementById('toc_tbody')
tbody.innerHTML=''

if(tocItems.length===0){

tbody.innerHTML=
`<tr>
<td colspan="3"
class="text-center text-muted py-3"
style="font-size:13px">
Belum ada daftar isi ditambahkan
</td>
</tr>`

}else{

tocItems.forEach((item,index)=>{

tbody.innerHTML+=`
<tr>

<td>
<input type="text"
class="form-control form-control-sm"
value="${item.title}"
oninput="updateTocRow(${index},'title',this.value)"
placeholder="Contoh: Kata Pengantar">
</td>

<td>
<input type="number"
class="form-control form-control-sm"
value="${item.page}"
oninput="updateTocRow(${index},'page',this.value)"
placeholder="1">
</td>

<td class="text-center">
<button type="button"
class="btn btn-sm btn-light text-danger"
onclick="removeTocRow(${index})">
<i class="bi bi-trash"></i>
</button>
</td>

</tr>`
})
}

document.getElementById('toc_hidden_input').value=
JSON.stringify(tocItems)

}

function addTocRow(){

tocItems.push({
title:'',
page:''
})

renderToc()

}

function updateTocRow(index,field,value){

tocItems[index][field]=value

document.getElementById('toc_hidden_input').value=
JSON.stringify(tocItems)

}

function removeTocRow(index){

tocItems.splice(index,1)

renderToc()

}

document.addEventListener('DOMContentLoaded',function(){

renderToc()

})

</script>

@endsection
