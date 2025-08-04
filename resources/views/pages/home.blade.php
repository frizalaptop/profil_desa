@extends('layouts.main')


@section('content')
<!-- Hero Section -->
<section class="hero-section text-white py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">Selamat Datang di Desa Ciangir</h1>
                <p class="lead mb-4">Desa yang asri, mandiri, dan berbudaya dengan masyarakat yang produktif dan sejahtera.</p>
                <a href="#profil" class="btn btn-light btn-lg px-4 me-2">Jelajahi Desa</a>
                <a href="#kontak" class="btn btn-outline-light btn-lg px-4">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>

<!-- Profil Desa -->
<section id="profil" class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h2 class="fw-bold mb-4">Profil Desa</h2>
        <p>Desa Maju Makmur terletak di Kecamatan Sejahtera, Kabupaten Makmur, Provinsi Harmoni. Desa ini dikenal dengan keindahan alamnya yang asri dan masyarakatnya yang ramah.</p>
        <div class="row mt-4">
          <div class="col-6">
            <div class="d-flex align-items-center mb-3">
              <i class="fas fa-users feature-icon me-3"></i>
              <div>
                <h3 class="h5 mb-0">3.245</h3>
                <small>Jiwa Penduduk</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center mb-3">
              <i class="fas fa-map-marked-alt feature-icon me-3"></i>
              <div>
                <h3 class="h5 mb-0">12.5</h3>
                <small>Km² Luas Wilayah</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="fas fa-warehouse feature-icon me-3"></i>
              <div>
                <h3 class="h5 mb-0">8</h3>
                <small>Dusun</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="fas fa-seedling feature-icon me-3"></i>
              <div>
                <h3 class="h5 mb-0">120</h3>
                <small>Ha Sawah</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="map-container shadow">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15845.125123456789!2d110.12345678901234!3d-6.987654321012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTknMTUuNiJTIDExMMKwMDcnMzYuNiJF!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid" 
                  width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Layanan Desa -->
<section id="layanan" class="py-5">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">Layanan Desa</h2>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <i class="fas fa-file-alt feature-icon mb-3"></i>
            <h5 class="card-title">Surat Keterangan</h5>
            <p class="card-text">Pengajuan surat keterangan domisili, tidak mampu, dan surat resmi lainnya.</p>
            <a href="#" class="btn btn-outline-success">Info Selengkapnya</a>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <i class="fas fa-hand-holding-heart feature-icon mb-3"></i>
            <h5 class="card-title">Bantuan Sosial</h5>
            <p class="card-text">Informasi program bantuan sosial dari pemerintah untuk warga.</p>
            <a href="#" class="btn btn-outline-success">Info Selengkapnya</a>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <i class="fas fa-chart-line feature-icon mb-3"></i>
            <h5 class="card-title">Data Statistik</h5>
            <p class="card-text">Data kependudukan dan statistik perkembangan desa.</p>
            <a href="#" class="btn btn-outline-success">Info Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Potensi Desa -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">Potensi Desa</h2>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Pertanian">
          <div class="card-body">
            <h5 class="card-title">Pertanian</h5>
            <p class="card-text">Hasil utama padi, jagung, dan sayuran organik.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" class="card-img-top" alt="Perkebunan">
          <div class="card-body">
            <h5 class="card-title">Perkebunan</h5>
            <p class="card-text">Kopi, cengkeh, dan buah-buahan lokal.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1584466977773-e625c37cdd50?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" class="card-img-top" alt="Kerajinan">
          <div class="card-body">
            <h5 class="card-title">Kerajinan</h5>
            <p class="card-text">Anyaman bambu dan kerajinan tangan tradisional.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Wisata">
          <div class="card-body">
            <h5 class="card-title">Wisata</h5>
            <p class="card-text">Air terjun dan pemandangan alam yang memukau.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Kontak -->
<section id="kontak" class="py-5 bg-dark text-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h2 class="fw-bold mb-4">Hubungi Kami</h2>
        <div class="mb-3">
          <h5 class="d-flex align-items-center">
            <i class="fas fa-map-marker-alt me-3"></i> Alamat Kantor Desa
          </h5>
          <p>Jl. Raya Desa No. 123, Dusun Makmur, Kec. Sejahtera, Kab. Harmoni</p>
        </div>
        <div class="mb-3">
          <h5 class="d-flex align-items-center">
            <i class="fas fa-phone-alt me-3"></i> Telepon
          </h5>
          <p>(021) 1234-5678</p>
        </div>
        <div class="mb-3">
          <h5 class="d-flex align-items-center">
            <i class="fas fa-envelope me-3"></i> Email
          </h5>
          <p>info@desamajumakmur.id</p>
        </div>
        <div class="d-flex mt-4">
          <a href="#" class="text-white me-3 fs-4"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-white me-3 fs-4"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-white me-3 fs-4"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="col-lg-6">
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Nama Anda">
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" placeholder="Email">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Subjek">
          </div>
          <div class="mb-3">
            <textarea class="form-control" rows="4" placeholder="Pesan"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Kirim Pesan</button>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection('content')