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
  .filter-form .form-control,
  .filter-form .form-select {
    height: 45px;
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

      <!-- Filter Kategori -->
      <form action="{{ route('umkm.index') }}" method="GET" class="filter-form">
        <div class="row mb-4">
          <div class="col-md-6">
            <input type="text" 
                   class="form-control" 
                   placeholder="Cari UMKM, pemilik, atau deskripsi..." 
                   name="search"
                   value="{{ request('search') }}">
          </div>
          <div class="col-md-4 mt-2 mt-md-0">
            <select class="form-select" name="category">
              <option value="">Semua Kategori</option>
              @foreach($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                  {{ $category }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2 mt-2 mt-md-0">
            <button type="submit" class="btn btn-primary w-100">
              <i class="fas fa-search me-1"></i> Filter
            </button>
          </div>
        </div>
      </form>

      <!-- Info Filter Aktif -->
      @if(request()->has('search') || request()->has('category'))
      <div class="alert alert-info mb-4">
        <i class="fas fa-filter me-2"></i>
        Menampilkan hasil filter:
        @if(request('search'))
          <span class="badge bg-info text-dark ms-2">Pencarian: "{{ request('search') }}"</span>
        @endif
        @if(request('category'))
          <span class="badge bg-info text-dark ms-2">Kategori: {{ request('category') }}</span>
        @endif
        <a href="{{ route('umkm.index') }}" class="btn btn-sm btn-outline-info ms-3">
          <i class="fas fa-times me-1"></i> Hapus Filter
        </a>
      </div>
      @endif

      <!-- Daftar Card UMKM -->
      <div class="row g-4">
        @forelse($umkms as $umkm)
          <div class="col-md-6 col-lg-4">
          <div class="umkm-card card h-100 shadow-sm">
            <img src="{{ asset('storage/' . $umkm->product_photo) }}" 
                 class="map-static card-img-top" alt="Foto UMKM">
            <div class="card-body">
              <span class="badge badge-category mb-2">{{ $umkm->category }}</span>
              <h5 class="card-title">{{ $umkm->name }}</h5>
              <p class="card-text text-muted">
                <i class="fas fa-user me-2"></i> {{ $umkm->owner }}<br>
                <i class="fas fa-map-marker-alt me-2"></i> {{ $umkm->address }}
              </p>
              <p class="card-text">{{ Str::limit($umkm->description, 100) }}</p>
              
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
            <div class="alert alert-warning text-center">
              <i class="fas fa-search me-2"></i>
              @if(request()->has('search') || request()->has('category'))
                Tidak ditemukan UMKM yang sesuai dengan filter Anda.
                <a href="{{ route('umkm.index') }}" class="alert-link">Tampilkan semua UMKM</a>
              @else
                Belum ada UMKM yang terdaftar. 
                @auth
                  <a href="/umkm/create">Tambahkan UMKM pertama!</a>
                @else
                  <a href="/login">Login</a> untuk menambahkan UMKM.
                @endauth
              @endif
            </div>
          </div>
        @endforelse
      </div>

      <!-- Pagination -->
      <div class="mt-4">
          {{ $umkms->appends(request()->query())->links() }}
      </div>
    </div>
</section>

<!-- Auto-dismiss alert script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert-flash');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>

@endsection