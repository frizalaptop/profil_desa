@extends('layouts.main')

@section('title', $umkm->name . ' - UMKM Desa Maju Makmur')

@section('content')

<style>
  .umkm-header-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 8px;
  }
  .badge-category {
    background-color: #198754;
    color: white;
    font-size: 0.9rem;
  }
  .contact-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
  }
  .map-container {
    border-radius: 8px;
    overflow: hidden;
    height: 300px;
  }
  .detail-card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  }
  .detail-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background-color: #198754;
    color: white;
    margin-right: 15px;
  }
</style>

<!-- Header UMKM -->
<section class="bg-success text-white py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/umkm" class="text-white">UMKM</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $umkm->name }}</li>
            </ol>
        </nav>
        
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-category mb-2">{{ $umkm->category }}</span>
                <h1 class="fw-bold mb-2 text-light">{{ $umkm->name }}</h1>
                <p class="lead mb-0">Oleh: {{ $umkm->owner }}</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="/umkm" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke UMKM
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Detail UMKM -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Foto dan Kontak -->
            <div class="col-lg-5 mb-4">
                <div class="card detail-card h-100">
                    <img src="{{ asset('storage/' . $umkm->product_photo) }}" 
                         class="umkm-header-image card-img-top" 
                         alt="{{ $umkm->name }}"
                         onerror="this.src='https://via.placeholder.com/500x300/198754/ffffff?text=UMKM+Desa+Maju+Makmur'">
                    
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="https://wa.me/{{ $umkm->phone }}" 
                               class="btn btn-success btn-lg contact-btn" 
                               target="_blank">
                                <i class="fab fa-whatsapp fa-lg"></i>
                                Hubungi via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Detail -->
            <div class="col-lg-7">
                <div class="card detail-card h-100">
                    <div class="card-header bg-white">
                        <h4 class="mb-0 text-success">
                            <i class="fas fa-info-circle me-2"></i> Informasi Detail
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="text-success mb-3">Deskripsi Usaha</h5>
                            <p class="lead">{{ $umkm->description }}</p>
                        </div>

                        <div class="row g-3">
                            <!-- Informasi Pemilik -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="detail-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Pemilik</h6>
                                        <p class="mb-0 text-muted">{{ $umkm->owner }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="detail-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Telepon/WhatsApp</h6>
                                        <p class="mb-0 text-muted">{{ $umkm->phone }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="detail-icon">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Kategori</h6>
                                        <p class="mb-0 text-muted">{{ $umkm->category }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="col-12">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Alamat</h6>
                                        <p class="mb-0 text-muted">{{ $umkm->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peta Lokasi -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card detail-card">
                    <div class="card-header bg-white">
                        <h4 class="mb-0 text-success">
                            <i class="fas fa-map-marked-alt me-2"></i> Lokasi Usaha
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="map-container">
                            <a href="{!! $umkm->gmaps_embed !!}">{!! $umkm->gmaps_embed !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Script untuk menangani error gambar
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.onerror = function() {
                this.src = 'https://via.placeholder.com/500x300/198754/ffffff?text=UMKM+Desa+Maju+Makmur';
                this.alt = 'Gambar tidak tersedia';
            };
        });
    });
</script>
@endsection