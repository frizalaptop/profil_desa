@extends('layouts.main')

@section('title', 'Edit Kegiatan - Desa Maju Makmur')

@section('content')
<!-- Header Form -->
<section class="bg-success text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-3 text-light">
                    <i class="fas fa-calendar-alt me-2"></i> Edit Kegiatan
                </h1>
                <p class="lead">Perbarui informasi kegiatan desa yang sudah ada</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('activities.index') }}" class="btn btn-light">
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
                        <form action="{{ route('activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <h5 class="text-success mb-4">
                                    <i class="fas fa-info-circle me-2"></i> Informasi Kegiatan
                                </h5>

                                <div class="row g-3">
                                    <!-- Judul -->
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Judul Kegiatan</label>
                                        <input type="text" 
                                               class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" 
                                               value="{{ old('title', $activity->title) }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Peserta -->
                                    <div class="col-md-6">
                                        <label for="participant" class="form-label">Peserta</label>
                                        <input type="text" 
                                               class="form-control @error('participant') is-invalid @enderror" 
                                               id="participant" name="participant" 
                                               value="{{ old('participant', $activity->participant) }}">
                                        @error('participant')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Lokasi -->
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Lokasi</label>
                                        <input type="text" 
                                               class="form-control @error('location') is-invalid @enderror" 
                                               id="location" name="location" 
                                               value="{{ old('location', $activity->location) }}">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Kegiatan -->
                                    <div class="col-md-6">
                                        <label for="event_date" class="form-label">Tanggal Kegiatan</label>
                                        <input type="date" 
                                               class="form-control @error('event_date') is-invalid @enderror" 
                                               id="event_date" name="event_date" 
                                               value="{{ old('event_date', $activity->event_date->format('Y-m-d')) }}">
                                        @error('event_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="col-12">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="5">{{ old('description', $activity->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Thumbnail -->
                            <div class="mb-4">
                                <h5 class="text-success mb-4">
                                    <i class="fas fa-image me-2"></i> Thumbnail
                                </h5>
                                <div class="mb-3">
                                    @if($activity->thumbnail && Storage::disk('public')->exists($activity->thumbnail))
                                        <div class="mb-3">
                                            <img src="{{ Storage::url($activity->thumbnail) }}" 
                                                 alt="Thumbnail" 
                                                 class="img-fluid rounded shadow-sm" 
                                                 style="max-height: 200px">
                                        </div>
                                    @endif
                                    <input type="file" 
                                           class="form-control @error('thumbnail') is-invalid @enderror" 
                                           id="thumbnail" name="thumbnail" accept="image/*">
                                    <small class="text-muted">Format: JPG/PNG, maksimal 2MB</small>
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
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
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }
    .form-control.is-invalid:focus, .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220,53,69,.25);
    }
    .invalid-feedback {
        display: block;
    }
</style>
@endsection
