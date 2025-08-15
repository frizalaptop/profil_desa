@extends('layouts.main')

@section('title', 'Tambah UMKM Baru - Desa Maju Makmur')

@section('content')
<!-- Header Form -->
<section class="bg-success text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-3 text-light">
                    <i class="fas fa-store-alt me-2"></i> Pendaftaran UMKM Baru
                </h1>
                <p class="lead">Daftarkan usaha Anda untuk dipromosikan dalam direktori UMKM desa</p>
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
                        <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <h5 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle me-2"></i> Terdapat kesalahan!
                                </h5>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="mb-4">
                                <h5 class="text-success mb-4">
                                    <i class="fas fa-info-circle me-2"></i> Informasi Dasar UMKM
                                </h5>
                                
                                <div class="row g-3">
                                    <!-- Nama UMKM -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label required">Nama Usaha</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Kategori -->
                                    <div class="col-md-6">
                                        <label for="category" class="form-label required">Kategori</label>
                                        <select class="form-select @error('category') is-invalid @enderror" 
                                                id="category" name="category" required>
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            <option value="Makanan" {{ old('category') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                            <option value="Kerajinan" {{ old('category') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                            <option value="Pertanian" {{ old('category') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                            <option value="Jasa" {{ old('category') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                            <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Pemilik -->
                                    <div class="col-md-6">
                                        <label for="owner" class="form-label required">Nama Pemilik</label>
                                        <input type="text" class="form-control @error('owner') is-invalid @enderror" 
                                               id="owner" name="owner" value="{{ old('owner') }}" required>
                                        @error('owner')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- No. Telepon -->
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label required">No. Telepon/WhatsApp</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Alamat -->
                                    <div class="col-12">
                                        <label for="address" class="form-label required">Alamat Lengkap</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                                  id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Deskripsi -->
                                    <div class="col-12">
                                        <label for="description" class="form-label required">Deskripsi Usaha</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
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
                                    <label for="gmaps_embed" class="form-label required">Link Google Maps Embed</label>
                                    <input type="url" class="form-control @error('gmaps_embed') is-invalid @enderror" 
                                           id="gmaps_embed" name="gmaps_embed" value="{{ old('gmaps_embed') }}" 
                                           placeholder="https://maps.google.com/embed?pb=..." required>
                                    <small class="text-muted">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#gmapsHelpModal">
                                            Cara mendapatkan link embed Google Maps
                                        </a>
                                    </small>
                                    @error('gmaps_embed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="map-container shadow-sm mb-3" style="height: 250px;">
                                    <div id="mapPreview" class="h-100 w-100 bg-light d-flex align-items-center justify-content-center">
                                        <p class="text-muted">Pratinjau peta akan muncul di sini</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="text-success mb-4">
                                    <i class="fas fa-images me-2"></i> Foto Usaha
                                </h5>
                                
                                <div class="row g-3">
                                    <!-- Foto Produk -->
                                    <div class="col-md">
                                        <label for="product_photo" class="form-label required">Foto Produk/Jasa</label>
                                        <input type="file" class="form-control @error('product_photo') is-invalid @enderror" 
                                               id="product_photo" name="product_photo" accept="image/*" required>
                                        <small class="text-muted">Format: JPG/PNG, maksimal 2MB</small>
                                        @error('product_photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input @error('agreement') is-invalid @enderror" 
                                       type="checkbox" id="agreement" name="agreement" required>
                                <label class="form-check-label" for="agreement">
                                    Saya menyatakan bahwa data yang diisi adalah benar dan dapat dipertanggungjawabkan
                                </label>
                                @error('agreement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-undo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Simpan UMKM
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Cara Embed Google Maps -->
<div class="modal fade" id="gmapsHelpModal" tabindex="-1" aria-labelledby="gmapsHelpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="gmapsHelpModalLabel">
                    <i class="fas fa-map-marked-alt me-2"></i> Cara Mendapatkan Link Google Maps Embed
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Buka <a href="https://maps.google.com" target="_blank">Google Maps</a></li>
                    <li>Cari lokasi usaha Anda</li>
                    <li>Klik menu "Bagikan"</li>
                    <li>Pilih tab "Sematkan peta"</li>
                    <li>Copy kode iframe yang disediakan</li>
                    <li>Ambil bagian src="..." dari kode iframe tersebut</li>
                </ol>
                <div class="alert alert-success bg-success bg-opacity-10 border-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Contoh link embed: <code>https://maps.google.com/embed?pb=!1m18!1m12!1m3!1d...</code>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview Google Maps saat link diubah
    document.getElementById('gmaps_embed').addEventListener('input', function() {
        const mapPreview = document.getElementById('mapPreview');
        const url = this.value;
        
        if (url.includes('maps.google.com') && url.includes('embed')) {
            mapPreview.innerHTML = `<iframe src="${url}" width="100%" height="100%" style="border:0;"></iframe>`;
        } else {
            mapPreview.innerHTML = '<p class="text-muted">Pratinjau peta akan muncul di sini</p>';
        }
    });
</script>
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
    .alert-danger {
        border-left: 4px solid #dc3545;
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