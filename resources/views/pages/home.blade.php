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
        <p>Desa Ciangir terletak di Kecamatan Cibingbin, Kabupaten Kuningan, Provinsi Jawa Barat. Desa ini dikenal dengan keindahan alamnya yang asri dan masyarakatnya yang ramah.</p>
        <div class="row mt-4">
          <div class="col-6">
            <div class="d-flex align-items-center mb-3">
              <i class="fas fa-users feature-icon me-3"></i>
              <div>
                <h3 class="h5 mb-0">3.205 (Juni)</h3>
                <small>Jiwa Penduduk</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center mb-3">
              <i class="fas fa-map-marked-alt feature-icon me-3"></i>
              <div>
                <h3 class="h5 mb-0">22,095</h3>
                <small>HA Pemukiman</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="fas fa-warehouse feature-icon me-3"></i>
              <div>
                <h3 class="h5 mb-0">3</h3>
                <small>Dusun</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="fas fa-seedling feature-icon me-3"></i>
              <div>
                <h3 class="h5 mb-0">178,620</h3>
                <small>HA Sawah</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="map-container shadow">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31674.068344190295!2d108.71260776930035!3d-7.096002458757836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f7466e23602af%3A0xf944a3aad659c643!2sCiangir%2C%20Cibingbin%2C%20Kuningan%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1754642770598!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                @if(Storage::disk('public')->exists('services/surat.pdf'))
                    <a href="{{ Storage::url('services/surat.pdf') }}" target="_blank" class="btn btn-outline-success">
                        <i class="fas fa-download me-1"></i> Download Info
                    </a>
                @else
                    <button class="btn btn-outline-secondary" disabled>
                        <i class="fas fa-file-excel me-1"></i> File Tidak Tersedia
                    </button>
                @endif
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
                @if(Storage::disk('public')->exists('services/bansos.pdf'))
                    <a href="{{ Storage::url('services/bansos.pdf') }}" target="_blank" class="btn btn-outline-success">
                        <i class="fas fa-download me-1"></i> Download Info
                    </a>
                @else
                    <button class="btn btn-outline-secondary" disabled>
                        <i class="fas fa-file-excel me-1"></i> File Tidak Tersedia
                    </button>
                @endif
            </div>
        </div>
    </div>
    <!-- Card 3 -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center p-4">
                <i class="fas fa-hand-holding-medical feature-icon mb-3"></i>
                <h5 class="card-title">Posyandu & Kesehatan</h5>
                <p class="card-text">Layanan pemeriksaan kesehatan anak dan ibu hamil.</p>
                @if(Storage::disk('public')->exists('services/posyandu.pdf'))
                    <a href="{{ Storage::url('services/posyandu.pdf') }}" target="_blank" class="btn btn-outline-success">
                        <i class="fas fa-download me-1"></i> Download Info
                    </a>
                @else
                    <button class="btn btn-outline-secondary" disabled>
                        <i class="fas fa-file-excel me-1"></i> File Tidak Tersedia
                    </button>
                @endif
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
    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="{{ asset('images/sawah.jpeg') }}" class="card-img-top" alt="Pertanian">
          <div class="card-body">
            <h5 class="card-title">Pertanian</h5>
            <p class="card-text">Sawah yang luas untuk menghasilkan padi.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="{{ asset('images/peternakan.jpeg') }}" class="card-img-top" alt="Perkebunan">
          <div class="card-body">
            <h5 class="card-title">Peternakan</h5>
            <p class="card-text">Ayam, Kambing, dan Sapi.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Wisata">
          <div class="card-body">
            <h5 class="card-title">Wisata</h5>
            <p class="card-text">Cipanas sebagai pemandian air panas.</p>
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
          <p>Jl. Raya ciangir-cipondok, desa ciangir dusun 1 rt.1 rw 02.</p>
        </div>
        <div class="mb-3">
          <h5 class="d-flex align-items-center">
            <i class="fas fa-phone-alt me-3"></i> Telepon
          </h5>
          <p>-</p>
        </div>
        <div class="mb-3">
          <h5 class="d-flex align-items-center">
            <i class="fas fa-envelope me-3"></i> Email
          </h5>
          <p>EmailDesaciangir2022@gmail.com</p>
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