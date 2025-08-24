@extends('layouts.main')

@section('title', 'Edit UMKM - Desa Maju Makmur')

<script>
    function confirmDelete() {
        // Submit form hapus
        document.getElementById('deleteForm').submit();
    }
</script>

@section('content')
<!-- Header Form -->
<section class="bg-success text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-3 text-light">
                    <i class="fas fa-store-alt me-2"></i> Edit Data UMKM
                </h1>
                <p class="lead">Perbarui data UMKM Anda</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="/umkm" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Form Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <h5 class="text-success mb-4">
                                    <i class="fas fa-info-circle me-2"></i> Informasi Dasar UMKM
                                </h5>
                                
                                <div class="row g-3">
                                    <!-- Nama UMKM -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nama Usaha</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $umkm->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Kategori -->
                                    <div class="col-md-6">
                                        <label for="category" class="form-label">Kategori</label>
                                        <select class="form-select @error('category') is-invalid @enderror" 
                                                id="category" name="category" required>
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach(['Makanan', 'BUMDES', 'Pertanian'] as $option)
                                                <option value="{{ $option }}" 
                                                    {{ old('category', $umkm->category) == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Pemilik -->
                                    <div class="col-md-6">
                                        <label for="owner" class="form-label">Nama Pemilik</label>
                                        <input type="text" class="form-control @error('owner') is-invalid @enderror" 
                                               id="owner" name="owner" value="{{ old('owner', $umkm->owner) }}" required>
                                        @error('owner')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- No. Telepon -->
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">No. Telepon/WhatsApp</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ old('phone', $umkm->phone) }}" 
                                               placeholder="Contoh: 62*******" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Alamat -->
                                    <div class="col-12">
                                        <label for="address" class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                                  id="address" name="address" rows="3" required>{{ old('address', $umkm->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Deskripsi -->
                                    <div class="col-12">
                                        <label for="description" class="form-label">Deskripsi Usaha</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="5" required>{{ old('description', $umkm->description) }}</textarea>
                                        <small class="text-muted">Jelaskan produk/jasa yang ditawarkan</small>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="text-success mb-4">
                                    <i class="fas fa-map-marked-alt me-2"></i> Lokasi Usaha
                                </h5>
                                
                                <div class="mb-3">
                                    <label for="gmaps_embed" class="form-label">Link Google Maps</label>
                                    <input type="url" class="form-control @error('gmaps_embed') is-invalid @enderror" 
                                           id="gmaps_embed" name="gmaps_embed" value="{{ old('gmaps_embed', $umkm->gmaps_embed) }}" required>
                                    @error('gmaps_embed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="text-success mb-4">
                                    <i class="fas fa-images me-2"></i> Foto Usaha
                                </h5>
                                
                                <div class="row g-3">
                                    <!-- Foto Produk Saat Ini -->
                                    <div class="col-12">
                                        <label class="form-label">Foto Saat Ini</label>
                                        <div>
                                            @if($umkm->product_photo)
                                                <img src="{{ asset('storage/' . $umkm->product_photo) }}" 
                                                     class="img-thumbnail mb-2" 
                                                     alt="Foto Produk Saat Ini" 
                                                     style="max-height: 200px;">
                                            @else
                                                <div class="alert alert-warning">Tidak ada foto produk</div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Foto Produk Baru -->
                                    <div class="col-12">
                                        <label for="product_photo" class="form-label">Ganti Foto Produk/Jasa</label>
                                        <input type="file" class="form-control @error('product_photo') is-invalid @enderror" 
                                               id="product_photo" name="product_photo" accept="image/*">
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG/PNG, maksimal 2MB</small>
                                        @error('product_photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <!-- Tombol Hapus -->
                                <button type="button" class="btn btn-outline-danger me-md-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus UMKM
                                </button>
                                
                                <!-- Tombol Update -->
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Update UMKM
                                </button>
                            </div>
                        </form>
                        
                        <!-- Form untuk Hapus (di luar form edit) -->
                        <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus UMKM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus UMKM "<strong>{{ $umkm->name }}</strong>"?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan. Semua data UMKM akan dihapus secara permanen.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .required:after {
        content: " *";
        color: #dc3545;
    }
    .map-container {
        border-radius: 8px;
        overflow: hidden;
    }
    .feature-icon {
        font-size: 2.5rem;
        color: var(--success);
    }
    .invalid-feedback.d-block {
        display: block !important;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }
    .form-control.is-invalid:focus, .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220,53,69,.25);
    }
    .form-check-input.is-invalid {
        border-color: #dc3545;
    }
    .form-check-input.is-invalid:checked {
        background-color: #dc3545;
    }
</style>
@endsection
