@extends('layouts.main')

@section('content')
<!-- Header Layanan -->
<section class="bg-success text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-3 text-light">Layanan Desa Maju Makmur</h1>
                <p class="lead">Berbagai layanan publik yang disediakan oleh pemerintah desa untuk masyarakat</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="#" class="btn btn-light btn-lg">
                    <i class="fas fa-info-circle me-2"></i> Panduan Layanan
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Daftar Layanan -->
<section class="py-5">
    <div class="container">

        <!-- Accordion Layanan -->
        <div class="accordion" id="layananAccordion">
            <!-- Layanan 1 -->
            <div class="accordion-item border-0 shadow-sm mb-3">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button bg-light-green bg-opacity-10 text-success fw-bold" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#layanan1" 
                            aria-expanded="true" 
                            aria-controls="layanan1">
                        <i class="fas fa-file-alt me-3"></i> Layanan Surat Menyurat
                    </button>
                </h2>
                <div id="layanan1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#layananAccordion">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <img src="{{ asset('images/surat.jpeg') }}" 
                                     class="img-fluid rounded" alt="Surat Keterangan">
                            </div>
                            <div class="col-md-8">
                                <h5 class="text-success">Deskripsi Layanan</h5>
                                <p>Layanan pembuatan berbagai surat keterangan resmi dari desa seperti:</p>
                                <ul>
                                    <li>Surat Kematian</li>
                                    <li>Surat Pengantar (KTP, KK, Akte, Nikah, KTA)</li>
                                    <li>Surat Keterangan (Ahli Waris, BPJS, Usaha, Kepemilikan Tanah)</li>
                                </ul>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-clock me-1"></i> Proses 1 Hari Kerja
                                    </span>
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-money-bill-wave me-1"></i> Gratis
                                    </span>
                                </div>
                                <hr>
                                @if(Storage::disk('public')->exists('services/surat.pdf'))
                                    <a href="{{ Storage::url('services/surat.pdf') }}" target="_blank" class="btn btn-success mt-2">
                                        <i class="fas fa-download me-1"></i> Download Persyaratan
                                    </a>
                                @else
                                    <div class="alert alert-warning mt-2">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        File persyaratan belum tersedia
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Layanan 3 -->
            <div class="accordion-item border-0 shadow-sm">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed bg-light-green bg-opacity-10 text-success fw-bold" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#layanan3" 
                            aria-expanded="false" 
                            aria-controls="layanan3">
                        <i class="fas fa-stethoscope me-3"></i> Posyandu & Kesehatan
                    </button>
                </h2>
                <div id="layanan3" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#layananAccordion">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <img src="{{ asset('images/posyandu.jpeg') }}"" 
                                     class="img-fluid rounded" alt="Posyandu">
                            </div>
                            <div class="col-md-8">
                                <h5 class="text-success">Deskripsi Layanan</h5>
                                <p>Layanan kesehatan yang tersedia di desa:</p>
                                <ul>
                                    <li>Posyandu Batita, Balita dan Bumil setiap bulan sekali.</li>
                                    <li>Imunisasi Gratis, Vitamin A, Obat Cacing.</li>
                                    <li>Penyuluhan perawatan masa kehamilan.</li>
                                </ul>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-map-marker-alt me-1"></i> Posyandu tiap dusun
                                    </span>
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-clock me-1"></i>Awal Bulan 08.00 - 10:00
                                    </span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    @if(Storage::disk('public')->exists('services/posyandu.pdf'))
                                        <a href="{{ Storage::url('services/posyandu.pdf') }}" target="_blank" class="btn btn-outline-success">
                                            <i class="fas fa-download me-1"></i> Detail Informasi
                                        </a>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Informasi posyandu belum tersedia
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .accordion-button:not(.collapsed) {
        background-color: rgba(139, 195, 74, 0.2);
        color: #2e7d32;
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(139, 195, 74, 0.5);
    }
    .accordion-item {
        border-radius: 8px !important;
        overflow: hidden;
    }
    .alert-warning {
        background-color: rgba(255,193,7,0.1);
        border: 1px solid rgba(255,193,7,0.3);
        color: #856404;
    }
</style>
@endsection