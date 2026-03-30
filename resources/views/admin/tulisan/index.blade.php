@extends('admin.layout')

@section('title','Tulisan')

@section('content')

<style>
    /* HERO SECTION */
    .page-hero {
        background: linear-gradient(135deg, #003b0a, #16a34a);
        padding: 25px;
        border-radius: 12px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
    }
    .page-hero h2 { font-weight: 700; margin-bottom: 5px; }
    .page-hero p { margin: 0; opacity: .9; }

    /* SEARCH BAR */
    .search-wrap { 
        position: relative; 
        margin-bottom: 30px; 
        width: 100%; 
    }
    .search-wrap input { 
        border: 1px solid #e2e8f0; 
        border-radius: 12px; 
        padding: 14px 15px 14px 50px; 
        width: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        font-size: 15px;
    }
    .search-wrap i { 
        position: absolute; 
        left: 20px; 
        top: 50%; 
        transform: translateY(-50%); 
        color: #94a3b8; 
        font-size: 20px; 
    }

    /* CARD GRID REFINED */
    .tulisan-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,.05);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f5f9;
    }
    .tulisan-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,.1); }

    .tulisan-img {
        height: 140px; /* Ukuran lebih kecil untuk 4 kolom */
        width: 100%;
        background: #f8fafc;
        overflow: hidden;
    }
    .tulisan-img img { width: 100%; height: 100%; object-fit: cover; }

    .no-img {
        height: 100%;
        display: flex; align-items: center; justify-content: center;
        font-size: 30px; color: #cbd5e1;
    }

    .tulisan-content { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; }
    
    /* CATEGORY BADGE */
    .badge-kategori {
        font-size: 10px;
        text-transform: uppercase;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 8px;
        width: fit-content;
    }
    .kat-puisi { background: #dcfce7; color: #166534; }
    .kat-cerpen { background: #fef9c3; color: #854d0e; }
    .kat-pantun { background: #e0e7ff; color: #3730a3; }

    .judul { font-size: 15px; font-weight: 700; margin-bottom: 5px; color: #1e293b; line-height: 1.4; min-height: 42px; }
    .slug { font-size: 11px; color: #6366f1; font-family: monospace; background: #eef2ff; padding: 2px 6px; border-radius: 4px; margin-bottom: 10px; display: block; text-overflow: ellipsis; overflow: hidden; }
    .tanggal { font-size: 11px; color: #94a3b8; margin-bottom: 12px; }
    .card-action { 
        display: grid; 
        grid-template-columns: 1fr 40px; /
        gap: 8px; 
        margin-top: auto; 
        padding-top: 12px; 
        border-top: 1px solid #f1f5f9; 
    }
    .card-action { display: flex; gap: 6px; margin-top: auto; padding-top: 12px; border-top: 1px solid #f1f5f9; }
    .btn-action {
        flex: 1;
        height: 32px; border: none; border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
        color: white !important; font-size: 11px; font-weight: 600;
        text-decoration: none;
    }
    .btn-edit { background: #f59e0b; }
    .btn-delete { background: #ef4444; border-radius: 6px; border:none; color:white; width:100%; height:32px; font-size:11px;}

    .btn-add {
        background: rgba(255,255,255,0.2);
        color: #fff; border: 1.5px solid rgba(255,255,255,0.35);
        border-radius: 10px; padding: 8px 16px;
        font-size: 13px; font-weight: 600; backdrop-filter: blur(4px);
    }

    .btn-modal-save { 
        background: #16a34a; 
        border: none; 
        padding: 12px 25px; 
        color: white; 
        border-radius: 10px; 
        font-weight: 700; 
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);
    }
    
    .btn-modal-save:hover { 
        background: #15803d; 
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(22, 163, 74, 0.3);
    }

    .btn-modal-save.blue { 
        background: #3b82f6; 
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
    }
    
    .btn-modal-save.blue:hover { 
        background: #2563eb; 
    }

    /* Style Tombol Batal */
    .btn-modal-cancel {
        background: #f1f5f9;
        color: #475569;
        border: none;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-right: 10px;
    }

    .btn-modal-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    /* FORM ENHANCEMENT */
    .form-input-m { 
        width: 100%; 
        border: 1.5px solid #e2e8f0; 
        border-radius: 10px; 
        padding: 12px 15px; 
        transition: all 0.3s ease;
        background-color: #f8fafc;
        font-size: 14px;
    }
    
    .form-input-m:focus {
        outline: none;
        border-color: #16a34a;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1);
    }

    /* Khusus Select agar ada panah custom */
    select.form-input-m {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.5em;
        padding-right: 2.5rem;
    }

    .form-label-m { 
        font-weight: 700; 
        margin-bottom: 8px; 
        display: block; 
        color: #334155; 
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Modal Header & Footer Styling */
    .modal-header {
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 25px;
    }
    .modal-footer {
        border-top: 1px solid #f1f5f9;
        padding: 15px 25px;
    }
    .modal-title {
        font-weight: 800;
        color: #1e293b;
    }
    
    /* Help text */
    .form-text-m {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 5px;
        font-style: italic;
    }

    .btn-filter {
    padding: 8px 20px;
    border-radius: 50px;
    border: 1px solid #e2e8f0;
    background: white;
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-filter:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.btn-filter.active {
    background: #16a34a; 
    color: white;
    border-color: #16a34a;
    box-shadow: 0 4px 10px rgba(22, 163, 74, 0.2);
}

</style>

<div class="page-hero">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-pencil-square me-2"></i>Data Tulisan</h2>
            <p>Kelola Puisi, Cerpen, dan Pantun</p>
        </div>
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle-fill"></i> Tambah Tulisan
        </button>
    </div>
</div>

@if(session('success'))
    <div class="alert-success mb-4">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="d-flex gap-3 mb-4">
    <div class="search-wrap mb-0" style="flex: 1;">
        <i class="bi bi-search"></i>
        <input type="text" id="searchInput" placeholder="Cari berdasarkan judul..." onkeyup="filterSemua()">
    </div>
<div style="width: 250px;">
        <select id="filterKategori" class="form-input-m" onchange="filterSemua()" style="height: 54px; padding-top: 0; padding-bottom: 0;">
            <option value="all">Semua Kategori</option>
            <option value="Puisi">Puisi</option>
            <option value="Cerpen">Cerpen</option>
            <option value="Pantun dan Syair">Pantun & Syair</option>
        </select>
    </div>
</div>

<div class="row g-4" id="tulisanContainer">
    @forelse($tulisans as $t)
        <div class="col-md-3 tulisan-item">
            <div class="tulisan-card">
                <div class="tulisan-img">
                    @if($t->gambar)
                        <img src="{{ asset('uploads/tulisan/'.$t->gambar) }}" alt="gambar">
                    @else
                        <div class="no-img"><i class="bi bi-image"></i></div>
                    @endif
                </div>

                <div class="tulisan-content">
                    <span class="badge-kategori {{ $t->kategori == 'Puisi' ? 'kat-puisi' : ($t->kategori == 'Cerpen' ? 'kat-cerpen' : 'kat-pantun') }}">
                        {{ $t->kategori ?? 'Umum' }}
                    </span>
                    
                    <h5 class="judul text-truncate-2">{{ $t->judul }}</h5>
                    <span class="slug">{{ $t->slug }}</span>
                    <div class="tanggal"><i class="bi bi-calendar3 me-1"></i> {{ $t->created_at->format('d M Y') }}</div>

                    <div class="card-action">
                        <button type="button" class="btn-action btn-edit"
                            onclick="openEdit({{ $t->id }}, '{{ addslashes($t->judul) }}', `{{ $t->isi }}`, '{{ $t->kategori }}')">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </button>

                        <div class="btn-delete-wrap">
                            <form action="{{ route('admin.tulisan.destroy', $t->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Hapus tulisan ini?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada tulisan.</p>
        </div>
    @endforelse
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.tulisan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
    <div class="row">
        <div class="col-md-7 mb-3">
            <label class="form-label-m"><i class="bi bi-type-h1 me-1"></i> Judul Artikel</label>
            <input type="text" name="judul" class="form-input-m" placeholder="Contoh: Senja di Pekanbaru" required>
        </div>
        
        <div class="col-md-5 mb-3">
            <label class="form-label-m"><i class="bi bi-tag-fill me-1"></i> Kategori</label>
            <select name="kategori" class="form-input-m" required>
                <option value="" disabled selected>Pilih...</option>
                <option value="Puisi">Puisi</option>
                <option value="Cerpen">Cerpen</option>
                <option value="Pantun dan Syair">Pantun dan Syair</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
    <label class="form-label-m"><i class="bi bi-image-fill me-1"></i> Gambar Unggulan</label>
    <input type="file" name="gambar" class="form-input-m"> 
    <div class="form-text-m">*Format: JPG, PNG (Maks 2MB)</div>
    </div>

    <div class="mb-0">
        <label class="form-label-m"><i class="bi bi-justify-left me-1"></i> Isi Tulisan</label>
        <textarea name="isi" id="isi" rows="6" class="form-input-m"></textarea>
    </div>
</div>
                <div class="modal-footer">
    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
        <i class="bi bi-x-circle me-1"></i> Batal
    </button>
    
    <button type="submit" class="btn-modal-save">
        <i class="bi bi-check-circle me-1"></i> Simpan Tulisan
    </button>
</div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="formEdit" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT') 
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tulisan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="form-label-m">Judul Artikel</label>
                            <input type="text" id="editJudul" name="judul" class="form-input-m mb-3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-m">Kategori</label>
                            <select name="kategori" id="editKategori" class="form-input-m mb-3" required>
                                <option value="Puisi">Puisi</option>
                                <option value="Cerpen">Cerpen</option>
                                <option value="Pantun dan Syair">Pantun dan Syair</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-m">Ganti Gambar</label>
                        <input type="file" name="gambar" class="form-input-m">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-m">Isi Tulisan</label>
                        <textarea id="editIsi" name="isi" rows="6" class="form-input-m"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                <i class="bi bi-x-circle me-1"></i> Batal
            </button>
            
            <button type="submit" class="btn-modal-save blue" onclick="updateCKEditor()">
            <i class="bi bi-arrow-repeat me-1"></i> Update Perubahan
        </button>
        </div>
            </form>
        </div>
    </div>
</div>

<script>
    // 1. Inisialisasi CKEditor (Harus di luar)
    if (document.getElementById('isi')) {
        CKEDITOR.replace('isi');
    }
    if (document.getElementById('editIsi')) {
        CKEDITOR.replace('editIsi');
    }
    function updateCKEditor() {
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
}

    // 2. Fungsi Preview Gambar (Event Listener)
    document.addEventListener('change', function(e) {
        if (e.target && e.target.name === 'gambar') {
            const input = e.target;
            const parent = input.parentElement;
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    let oldPreview = parent.querySelector('.preview-wrapper');
                    if(oldPreview) oldPreview.remove();
                    
                    const div = document.createElement('div');
                    div.className = 'preview-wrapper mt-3 p-2';
                    div.style.backgroundColor = '#f8fafc';
                    div.style.borderRadius = '12px';
                    div.style.border = '1px dashed #cbd5e1';
                    div.style.width = 'fit-content';
                    
                    div.innerHTML = `
                        <p class="mb-1" style="font-size: 11px; font-weight: bold; color: #64748b;">PREVIEW GAMBAR:</p>
                        <img src="${event.target.result}" 
                             style="max-width: 250px; max-height: 200px; border-radius: 8px; display: block; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    `;
                    parent.appendChild(div);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }); 

   function openEdit(id, judul, isi, kategori) {

    const form = document.getElementById('formEdit');
    form.action = '/admin/tulisan/' + id; 
    
    // Isi data ke input lainnya
    document.getElementById('editJudul').value = judul;
    document.getElementById('editKategori').value = kategori;
    
    // Isi data ke CKEditor
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['editIsi']) {
        CKEDITOR.instances['editIsi'].setData(isi);
    } else {
        document.getElementById('editIsi').value = isi;
    }
    
    // Tampilkan modal
    var modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
    modalEdit.show();
}
 function filterSemua() {
    let inputJudul = document.getElementById('searchInput').value.toLowerCase();
    let filterKat = document.getElementById('filterKategori').value;
    let items = document.querySelectorAll('.tulisan-item');

    items.forEach(item => {
        let judul = item.querySelector('.judul').innerText.toLowerCase();
        // Gunakan innerText.trim() untuk membuang spasi yang tidak sengaja terbawa
        let kategoriKartu = item.querySelector('.badge-kategori').innerText.trim();

        let judulCocok = judul.includes(inputJudul);
        let kategoriCocok = (filterKat === 'all' || kategoriKartu === filterKat);

        if (judulCocok && kategoriCocok) {
            item.classList.remove('d-none'); // Pastikan dia muncul
            item.style.display = "block";
        } else {
            item.classList.add('d-none'); // Sembunyikan dengan class Bootstrap
            item.style.display = "none";
        }
    });
}

</script>
@endsection