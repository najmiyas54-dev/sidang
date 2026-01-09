<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen - SIPESMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; font-family: 'Inter', sans-serif; }
        .navbar { background: linear-gradient(135deg, #A0522D 0%, #D2B48C 50%, #F5DEB3 100%); }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .stats-card { background: white; border-radius: 12px; padding: 24px; }
        .table th { background: #F5DEB3; color: #8B4513; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-mortarboard-fill me-2"></i>SIPESMA - Dosen
            </a>
            <div class="d-flex align-items-center text-white">
                <span class="me-3">{{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="bi bi-people fs-1 text-primary mb-2"></i>
                    <h3 class="text-primary">{{ $totalBimbingan }}</h3>
                    <p class="text-muted">Total Bimbingan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="bi bi-clock fs-1 text-warning mb-2"></i>
                    <h3 class="text-warning">{{ $menungguReview }}</h3>
                    <p class="text-muted">Menunggu Review</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="bi bi-check-circle fs-1 text-success mb-2"></i>
                    <h3 class="text-success">{{ $sudahDisetujui }}</h3>
                    <p class="text-muted">Sudah Disetujui</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i>Daftar Mahasiswa Bimbingan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jenis Sidang</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bimbinganList as $bimbingan)
                            <tr>
                                <td>{{ $bimbingan->user->nim }}</td>
                                <td>{{ $bimbingan->user->name }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucwords(str_replace('_', ' ', $bimbingan->jenis_sidang)) }}</span>
                                </td>
                                <td>{{ Str::limit($bimbingan->judul, 40) }}</td>
                                <td>
                                    @if($bimbingan->pembimbing_status == 'pending')
                                        <span class="badge bg-warning">Menunggu Review</span>
                                    @elseif($bimbingan->pembimbing_status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $bimbingan->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('dosen.detail', $bimbingan->id) }}" class="btn btn-sm btn-primary me-1">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    @if($bimbingan->pembimbing_status == 'pending')
                                        <button class="btn btn-sm btn-success me-1" onclick="approveRegistration({{ $bimbingan->id }}, 'approved')">Setujui</button>
                                        <button class="btn btn-sm btn-danger" onclick="approveRegistration({{ $bimbingan->id }}, 'rejected')">Tolak</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Registration Approval -->
    <div class="modal fade" id="approvalModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Persetujuan Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="approvalForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="approvalStatus" name="status">
                        <div class="mb-3">
                            <label class="form-label">Catatan (opsional)</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Berikan catatan untuk mahasiswa..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function approveRegistration(regId, status) {
            document.getElementById('approvalForm').action = `/dosen/registration/${regId}/approve`;
            document.getElementById('approvalStatus').value = status;
            new bootstrap.Modal(document.getElementById('approvalModal')).show();
        }
    </script>
</body>
</html>