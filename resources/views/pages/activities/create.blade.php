@extends('layouts.main')

@section('title', 'Tambah Kegiatan Baru - Desa Maju Makmur')

@section('content')
<!-- Header Form -->
<section class="bg-success text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-3 text-light">
                    <i class="fas fa-calendar-plus me-2"></i> Tambah Kegiatan Baru
                </h1>
                <p class="lead">Catat agenda dan kegiatan penting desa</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('activity.index') }}" class="btn btn-light">
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
                        <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <h5 class="text-success mb-4">
                                    <i class="fas fa-info-circle me-2"></i> Informasi Dasar Kegiatan
                                </h5>

                                <div class="row g-3">
                                    <!-- Judul -->
                                    <div class="col-12">
                                        <label for="title" class="form-label">Judul Kegiatan</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title') }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Peserta -->
                                    <div class="col-md-6">
                                        <label for="participant" class="form-label">Peserta</label>
                                        <input type="text" class="form-control @error('participant') is-invalid @enderror" 
                                               id="participant" name="participant" 
                                               value="{{ old('participant') }}" 
                                               placeholder="Contoh: Umum, Ibu PKK, Pemuda">
                                        @error('participant')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Lokasi -->
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Lokasi</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                               id="location" name="location" value="{{ old('location') }}">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal -->
                                    <div class="col-md-6">
                                        <label for="event_date" class="form-label">Tanggal Kegiatan</label>
                                        <input type="date" class="form-control @error('event_date') is-invalid @enderror" 
                                               id="event_date" name="event_date" value="{{ old('event_date') }}">
                                        @error('event_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-4">
                                <label for="description" class="form-label">Deskripsi Kegiatan</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                <small class="text-muted">Jelaskan detail kegiatan, tujuan, dan rangkaian acara.</small>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Thumbnail -->
                            <div class="mb-4">
                                <h5 class="text-success mb-3">
                                    <i class="fas fa-image me-2"></i> Thumbnail Kegiatan
                                </h5>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                                       id="thumbnail" name="thumbnail" accept="image/*">
                                <small class="text-muted">Format: JPG/PNG, maksimal 2MB</small>
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-undo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Simpan Kegiatan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .required:after {
        content: " *";
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
