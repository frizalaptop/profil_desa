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
            <option>Kerajinan</option>
            <option>Jasa</option>
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
                  <a href="{{ route('umkm.edit', $umkm->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit me-1"></i> Perbarui
                  </a>
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

        <!-- UMKM 1 -->
        <div class="col-md-6 col-lg-4">
          <div class="umkm-card card h-100 shadow-sm">
            <img src="https://www.ruangriang.co.id/wp-content/uploads/2023/07/05c39369e7521189f942a62d18777283.jpg" 
                 class="map-static card-img-top" alt="Lokasi UMKM">
            <div class="card-body">
              <span class="badge badge-category mb-2">Makanan</span>
              <h5 class="card-title">Dorokdok</h5>
              <p class="card-text text-muted">
                <i class="fas fa-user me-2"></i> Ibu Siti Rahayu<br>
                <i class="fas fa-map-marker-alt me-2"></i> Dusun Krajan, RT 02/RW 04
              </p>
              <p class="card-text">Kerupuk kulit sapi siap saji.</p>
              
              <div class="btn-action-group">
                <a href="https://wa.me/6281234567890" class="btn btn-sm btn-success">
                  <i class="fab fa-whatsapp me-1"></i> Hubungi
                </a>
                
                @auth
                  <a href="/umkm/1/edit" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit me-1"></i> Perbarui
                  </a>
                @else
                  <a href="/umkm/1" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-info-circle me-1"></i> Detail
                  </a>
                @endauth
              </div>
            </div>
          </div>
        </div>

        <!-- UMKM 2 -->
        <div class="col-md-6 col-lg-4">
          <div class="umkm-card card h-100 shadow-sm">
            <img src="https://sorot.co/images/2023/06/wonosobo/220229_5282_fotoistimewa20230611220229.jpg" 
                 class="map-static card-img-top" alt="Lokasi UMKM">
            <div class="card-body">
              <span class="badge badge-category mb-2">Makanan</span>
              <h5 class="card-title">Opak Singkong</h5>
              <p class="card-text text-muted">
                <i class="fas fa-user me-2"></i> Bapak Sutrisno<br>
                <i class="fas fa-map-marker-alt me-2"></i> Dusun Ngemplak, RT 01/RW 03
              </p>
              <p class="card-text">Opak singkong mentah siap produksi.</p>
              
              <div class="btn-action-group">
                <a href="https://wa.me/6281234567891" class="btn btn-sm btn-success">
                  <i class="fab fa-whatsapp me-1"></i> Hubungi
                </a>
                
                @auth
                  <a href="/umkm/2/edit" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit me-1"></i> Perbarui
                  </a>
                @else
                  <a href="/umkm/2" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-info-circle me-1"></i> Detail
                  </a>
                @endauth
              </div>
            </div>
          </div>
        </div>

        <!-- UMKM 3 -->
        <div class="col-md-6 col-lg-4">
          <div class="umkm-card card h-100 shadow-sm">
            <img src="https://images.tokopedia.net/img/HCoJbh/2025/3/4/bdba2c17-ebb2-4a28-ad50-40c870c0d7c7.jpg" 
                 class="map-static card-img-top" alt="Lokasi UMKM">
            <div class="card-body">
              <span class="badge badge-category mb-2">Pertanian</span>
              <h5 class="card-title">Kripik Singkong</h5>
              <p class="card-text text-muted">
                <i class="fas fa-user me-2"></i> Agus Mansur<br>
                <i class="fas fa-map-marker-alt me-2"></i> Dusun Ngadirojo, RT 05/RW 02
              </p>
              <p class="card-text">Kripik singkong dengan aneka bumbu.</p>
              
              <div class="btn-action-group">
                <a href="https://wa.me/6281234567892" class="btn btn-sm btn-success">
                  <i class="fab fa-whatsapp me-1"></i> Hubungi
                </a>
                
                @auth
                  <a href="/umkm/3/edit" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit me-1"></i> Perbarui
                  </a>
                @else
                  <a href="/umkm/3" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-info-circle me-1"></i> Detail
                  </a>
                @endauth
              </div>
            </div>
          </div>
        </div>

        <!-- Tambahkan UMKM lainnya di sini -->
      </div>

      <!-- Pagination (Opsional) -->
      <nav class="mt-5">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
    </div>
</section>

@endsection('content')