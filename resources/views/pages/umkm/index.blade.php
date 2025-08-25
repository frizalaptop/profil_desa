@extends('layouts.main')

@section('content')

<style>
  .map-static{
    width: 100%;
    height: 200px;
    object-fit: cover;
  }
  .badge-category {
    background-color: #198754;
    color: white;
  }
  .btn-action-group {
    display: flex;
    gap: 0.5rem;
  }
  .btn-action-group .btn {
    flex: 1;
  }
</style>

<!-- Header UMKM -->
<section class="bg-success text-white py-5">
    <div class="container py-4">
      <div class="row">
        <div class="col-lg-8">
          <h1 class="fw-bold mb-3 text-light">UMKM Desa Maju Makmur</h1>
          <p class="lead">Dukung produk lokal warga desa untuk kemandirian ekonomi</p>
        </div>
      </div>
    </div>
</section>

<!-- Flash Messages -->
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-flash alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-flash alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>


<!-- Daftar UMKM -->
<section class="py-5">
    <div class="container">
      @auth
      <div class="row-lg-4 text-lg-end my-3">
          <a href="/umkm/create" class="btn btn-success btn-lg">
              <i class="fas fa-plus-circle me-2"></i> Tambah UMKM
          </a>
      </div>
      @endauth

      <!-- Filter Kategori (Opsional) -->
      <div class="row mb-4">
        <div class="col-md-6">
          <input type="text" class="form-control" placeholder="Cari UMKM...">
        </div>
        <div class="col-md-6 mt-2 mt-md-0">
          <select class="form-select">
            <option selected>Semua Kategori</option>
            <option>Makanan</option>
            <option>BUMDES</option>
            <option>Pertanian</option>
          </select>
        </div>
      </div>

      <!-- Daftar Card UMKM -->
      <div class="row g-4">

        @forelse($umkms as $umkm)
          <div class="col-md-6 col-lg-4">
          <div class="umkm-card card h-100 shadow-sm">
            <img src="storage/{{ $umkm->product_photo }}" 
                 class="map-static card-img-top" alt="Foto UMKM">
            <div class="card-body">
              <span class="badge badge-category mb-2">{{ $umkm->category }}</span>
              <h5 class="card-title">{{ $umkm->name }}</h5>
              <p class="card-text text-muted">
                <i class="fas fa-user me-2"></i> {{ $umkm->owner }}<br>
                <i class="fas fa-map-marker-alt me-2"></i> {{ $umkm->address }}
              </p>
              <p class="card-text">{{ $umkm->description }}</p>
              
              <div class="btn-action-group">
                <a href="https://wa.me/{{ $umkm->phone }}" class="btn btn-sm btn-success">
                  <i class="fab fa-whatsapp me-1"></i> Hubungi
                </a>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('umkm.edit', $umkm->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit me-1"></i> Perbarui
                        </a>
                    @else
                        <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-info-circle me-1"></i> Detail
                        </a>
                    @endif
                @else
                    <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn-sm btn-outline-info">
                        <i class="fas fa-info-circle me-1"></i> Detail
                    </a>
                @endauth
              </div>
            </div>
          </div>
        </div>
        @empty
          <div class="col-12">
            <div class="alert alert-info text-center">
              Belum ada UMKM yang terdaftar. 
              @auth
                <a href="/umkm/create">Tambahkan UMKM pertama!</a>
              @else
                <a href="/login">Login</a> untuk menambahkan UMKM.
              @endauth
            </div>
          </div>
        @endforelse

        <!-- Tambahkan UMKM lainnya di sini -->
      </div>

      <div class="mt-4">
          {{ $umkms->links() }}
      </div>
</section>

@endsection('content')