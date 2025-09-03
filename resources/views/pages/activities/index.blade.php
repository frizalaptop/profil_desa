@extends('layouts.main')

@section('content')
<!-- Header Aktifitas -->
<section class="bg-success text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-3 text-light">Agenda & Kegiatan Desa</h1>
                <p class="lead">Daftar aktivitas tahunan dan kegiatan penting di Desa Maju Makmur</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('activities.create') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-plus-circle me-2"></i> Tambah Kegiatan
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Daftar Aktifitas -->
<section class="py-5">
    <div class="container">
        @if($activities->count())
            <!-- Accordion Aktifitas -->
            <div class="accordion" id="activitiesAccordion">
                @foreach($activities as $activity)
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="heading{{ $activity->id }}">
                            <button class="accordion-button bg-light-green bg-opacity-10 text-success fw-bold" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#activity{{ $activity->id }}" 
                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                                    aria-controls="activity{{ $activity->id }}">
                                <i class="fas fa-calendar-check me-3"></i> 
                                <span class="flex-grow-1">{{ $activity->title }}</span>
                                <span class="badge bg-success bg-opacity-10 text-success ms-2">
                                    <i class="fas fa-calendar-day me-1"></i> 
                                    {{ \Carbon\Carbon::parse($activity->event_date)->translatedFormat('d F Y') }}
                                </span>
                            </button>
                        </h2>
                        <div id="activity{{ $activity->id }}" 
                             class="accordion-collapse collapse " 
                             aria-labelledby="heading{{ $activity->id }}" 
                             data-bs-parent="#activitiesAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    @if($activity->thumbnail && Storage::disk('public')->exists($activity->thumbnail))
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <img src="{{ Storage::url($activity->thumbnail) }}" 
                                                 class="img-fluid rounded" 
                                                 alt="{{ $activity->title }}">
                                        </div>
                                    @endif
                                    <div class="col-md-8">
                                        <h5 class="text-success">Deskripsi Kegiatan</h5>
                                        <p>{{ $activity->description }}</p>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                <i class="fas fa-users me-1"></i> Peserta: {{ $activity->participant ?? 'Umum' }}
                                            </span>
                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                <i class="fas fa-map-marker-alt me-1"></i> {{ $activity->location ?? 'Lokasi akan diumumkan' }}
                                            </span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            @auth
                                                @if(auth()->user()->role === 'admin')
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $activities->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada kegiatan yang tercatat.
            </div>
        @endif
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
    .alert-warning, .alert-info {
        background-color: rgba(255,193,7,0.1);
        border: 1px solid rgba(255,193,7,0.3);
        color: #856404;
    }
</style>
@endsection
