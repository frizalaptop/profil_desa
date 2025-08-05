@extends('layouts.main')


@section('content')

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
      <div class="row-lg-4 text-lg-end my-3">
          <a href="/umkm/create" class="btn btn-success btn-lg">
              <i class="fas fa-plus-circle me-2"></i> Tambah UMKM
          </a>
      </div>

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
        <!-- UMKM 1 -->
        <div class="col-md-6 col-lg-4">
          <div class="umkm-card card h-100 shadow-sm">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=-6.987654,110.123456&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7C-6.987654,110.123456&key=YOUR_API_KEY" 
                 class="map-static card-img-top" alt="Lokasi UMKM">
            <div class="card-body">
              <span class="badge badge-category mb-2">Makanan</span>
              <h5 class="card-title">Warung Makan Sederhana</h5>
              <p class="card-text text-muted">
                <i class="fas fa-user me-2"></i> Ibu Siti Rahayu<br>
                <i class="fas fa-map-marker-alt me-2"></i> Dusun Krajan, RT 02/RW 04
              </p>
              <p class="card-text">Menjual nasi campur dengan lauk khas desa dan aneka minuman tradisional.</p>
              <a href="https://wa.me/6281234567890" class="btn btn-sm btn-success">
                <i class="fab fa-whatsapp me-1"></i> Hubungi
              </a>
            </div>
          </div>
        </div>

        <!-- UMKM 2 -->
        <div class="col-md-6 col-lg-4">
          <div class="umkm-card card h-100 shadow-sm">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=-6.987654,110.123456&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7C-6.987654,110.123456&key=YOUR_API_KEY" 
                 class="map-static card-img-top" alt="Lokasi UMKM">
            <div class="card-body">
              <span class="badge badge-category mb-2">Kerajinan</span>
              <h5 class="card-title">Anyaman Bambu Jaya</h5>
              <p class="card-text text-muted">
                <i class="fas fa-user me-2"></i> Bapak Sutrisno<br>
                <i class="fas fa-map-marker-alt me-2"></i> Dusun Ngemplak, RT 01/RW 03
              </p>
              <p class="card-text">Produk anyaman bambu seperti keranjang, tudung saji, dan peralatan rumah tangga.</p>
              <a href="https://wa.me/6281234567891" class="btn btn-sm btn-success">
                <i class="fab fa-whatsapp me-1"></i> Hubungi
              </a>
            </div>
          </div>
        </div>

        <!-- UMKM 3 -->
        <div class="col-md-6 col-lg-4">
          <div class="umkm-card card h-100 shadow-sm">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=-6.987654,110.123456&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7C-6.987654,110.123456&key=YOUR_API_KEY" 
                 class="map-static card-img-top" alt="Lokasi UMKM">
            <div class="card-body">
              <span class="badge badge-category mb-2">Pertanian</span>
              <h5 class="card-title">Tani Makmur Sejahtera</h5>
              <p class="card-text text-muted">
                <i class="fas fa-user me-2"></i> Kelompok Tani Desa<br>
                <i class="fas fa-map-marker-alt me-2"></i> Dusun Ngadirojo, RT 05/RW 02
              </p>
              <p class="card-text">Menjual beras organik, sayuran segar, dan buah-buahan hasil kebun warga.</p>
              <a href="https://wa.me/6281234567892" class="btn btn-sm btn-success">
                <i class="fab fa-whatsapp me-1"></i> Hubungi
              </a>
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