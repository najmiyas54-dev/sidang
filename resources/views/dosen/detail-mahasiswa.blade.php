<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa - SIPESMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; font-family: 'Inter', sans-serif; }
        .navbar { background: linear-gradient(135deg, #A0522D 0%, #D2B48C 50%, #F5DEB3 100%); }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .table th { background: #F5DEB3; color: #8B4513; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dosen.dashboard') }}">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            <span class="text-white fw-bold">Detail Mahasiswa</span>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-person me-2"></i>Informasi Mahasiswa</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>NIM:</strong> {{ $registration->user->nim }}</p>
                        <p><strong>Nama:</strong> {{ $registration->user->name }}</p>
                        <p><strong>Jenis Sidang:</strong> {{ ucwords(str_replace('_', ' ', $registration->jenis_sidang)) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong> 
                            @if($registration->status == 'menunggu')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($registration->status == 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </p>
                        <p><strong>Tanggal Daftar:</strong> {{ $registration->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <p><strong>Judul:</strong> {{ $registration->judul }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="bi bi-file-check me-2"></i>Review Dokumen</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Dokumen</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $doc)
                            <tr>
                                <td>{{ $doc->document_name }}</td>
                                <td>
                                    @if($doc->status == 'pending')
                                        <span class="badge bg-warning">Review</span>
                                    @elseif($doc->status == 'approved')
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $doc->admin_notes ?? 'Belum ada catatan' }}</td>
                                <td>
                                    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">Lihat</a>
                                    <button class="btn btn-sm btn-success me-1" onclick="updateStatus({{ $doc->id }}, 'approved')">Terima</button>
                                    <button class="btn btn-sm btn-danger" onclick="updateStatus({{ $doc->id }}, 'rejected')">Tolak</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Notes -->
    <div class="modal fade" id="notesModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Catatan Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="reviewForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="reviewStatus" name="status">
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
        function updateStatus(docId, status) {
            document.getElementById('reviewForm').action = `/dosen/document/${docId}/update`;
            document.getElementById('reviewStatus').value = status;
            new bootstrap.Modal(document.getElementById('notesModal')).show();
        }
    </script>
</body>
</html>