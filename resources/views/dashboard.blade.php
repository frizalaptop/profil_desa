<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="py-4">
        <div class="container-fluid">
            @if(auth()->user()->role === 'admin')
                <!-- Section UMKM Belum Diverifikasi -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-clock text-warning me-2"></i>
                            UMKM Menunggu Verifikasi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px;">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nama UMKM</th>
                                        <th scope="col">Pemilik</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingUmkms as $umkm)
                                        <tr>
                                            <td>
                                                <div class="fw-medium">{{ $umkm->name }}</div>
                                                <small class="text-muted">{{ $umkm->phone }}</small>
                                            </td>
                                            <td>{{ $umkm->owner }}</td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ $umkm->category }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <!-- Tombol Pratinjau -->
                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#previewModal" onclick="loadUmkmData({{ $umkm->id }})">
                                                        <i class="fas fa-eye me-1"></i> Pratinjau
                                                    </button>
                                                    
                                                    <!-- Tombol Setuju -->
                                                    <form action="{{ route('umkm.verify', $umkm->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" 
                                                                class="btn btn-outline-success"
                                                                onclick="return confirm('Setujui UMKM ini?')">
                                                            <i class="fas fa-check me-1"></i> Setuju
                                                        </button>
                                                    </form>
                                                    
                                                    <!-- Tombol Tolak -->
                                                    <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-outline-danger"
                                                                onclick="return confirm('Hapus permanen UMKM ini?')">
                                                            <i class="fas fa-times me-1"></i> Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                Tidak ada UMKM yang menunggu verifikasi
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Section Manajemen Users -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-users text-primary me-2"></i>
                            Manajemen Pengguna
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px;">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        @if($user->id !== auth()->id())
                                            <tr>
                                                <td class="fw-medium">{{ $user->name }}</td>
                                                <td>
                                                    <span class="badge 
                                                        {{ $user->role === 'admin' ? 'bg-purple' : 'bg-secondary' }}">
                                                        {{ $user->role }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($user->role === 'user')
                                                        <form action="{{ route('users.promote', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-outline-success"
                                                                    onclick="return confirm('Promote user menjadi admin?')">
                                                                <i class="fas fa-arrow-up me-1"></i> Promote
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('users.demote', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-outline-warning"
                                                                    onclick="return confirm('Demote admin menjadi user?')">
                                                                <i class="fas fa-arrow-down me-1"></i> Demote
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @else
                <!-- Tampilan Default untuk User Regular -->
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <h5 class="card-title text-muted">
                            {{ __("You're logged in!") }}
                        </h5>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Pratinjau UMKM -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pratinjau UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="previewContent">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat data UMKM...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadUmkmData(umkmId) {
            // Tampilkan loading state
            document.getElementById('previewContent').innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data UMKM...</p>
                </div>
            `;

            fetch(`/umkm/${umkmId}/preview`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const umkm = data.data;
                        const previewContent = `
                            <div class="row">
                                <div class="col-md-12 text-center mb-3">
                                    <img src="${umkm.product_photo}" alt="${umkm.name}" 
                                         class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Nama UMKM:</strong><br>
                                    ${umkm.name}
                                </div>
                                <div class="col-md-6">
                                    <strong>Pemilik:</strong><br>
                                    ${umkm.owner}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Kategori:</strong><br>
                                    <span class="badge bg-primary">${umkm.category}</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Telepon:</strong><br>
                                    ${umkm.phone}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <strong>Alamat:</strong><br>
                                    ${umkm.address}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <strong>Deskripsi:</strong><br>
                                    ${umkm.description}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Lokasi:</strong> <a href="${umkm.gmaps_embed}">${umkm.gmaps_embed}</a><br>
                                </div>
                            </div>
                        `;
                        
                        document.getElementById('previewContent').innerHTML = previewContent;
                    } else {
                        document.getElementById('previewContent').innerHTML = `
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Gagal memuat data UMKM
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('previewContent').innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Terjadi kesalahan saat memuat data
                        </div>
                    `;
                });
        }

        // Reset modal content ketika modal ditutup
        document.getElementById('previewModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('previewContent').innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data UMKM...</p>
                </div>
            `;
        });
    </script>

    <style>
        .bg-purple {
            background-color: #6f42c1 !important;
            color: white !important;
        }
        .table-responsive {
            border-radius: 0.375rem;
        }
        .btn-group-sm > .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    </style>
</x-app-layout>