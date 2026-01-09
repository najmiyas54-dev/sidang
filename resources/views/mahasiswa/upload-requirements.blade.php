<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Persyaratan - SIPESMA</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logounfari.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .navbar { background: linear-gradient(135deg, #A0522D 0%, #D2B48C 100%) !important; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-mortarboard me-2"></i>SIPESMA - Upload Persyaratan
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background: #F5DEB3;">
                        <h5 class="mb-0" style="color: #8B4513;"><i class="bi bi-cloud-upload me-2"></i>Upload Persyaratan {{ ucwords(str_replace('_', ' ', $jenis_sidang)) }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-4">
                            @if($jenis_sidang == 'kerja_praktik')
                                <h5 class="fw-bold mb-3">📋 Upload Persyaratan Kerja Praktek:</h5>
                                <p class="mb-2">Silakan upload dokumen-dokumen berikut sesuai dengan persyaratan yang telah ditetapkan:</p>
                            @else
                                <h5 class="fw-bold mb-3">📋 Upload Persyaratan Proposal Skripsi:</h5>
                                <p class="mb-2">Silakan upload dokumen-dokumen berikut sesuai dengan persyaratan yang telah ditetapkan:</p>
                            @endif
                            <div class="mt-3 p-3 bg-light rounded">
                                <small class="text-muted">
                                    <strong>Catatan:</strong> Semua file harus dalam format PDF. Pastikan semua dokumen sudah ditandatangani dan distempel sesuai ketentuan.
                                </small>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('mahasiswa.upload.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jenis_sidang" value="{{ $jenis_sidang }}">
                            
                            @if($jenis_sidang == 'kerja_praktik')
                                <div class="mb-3">
                                    <label class="form-label fw-bold">1. Laporan KP Lengkap <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="laporan_kp" accept=".pdf" required>
                                    <small class="text-muted">Format: PDF, Maksimal 10MB</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">2. Surat Keterangan Selesai KP <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="surat_selesai_kp" accept=".pdf" required>
                                    <small class="text-muted">Dari perusahaan tempat KP</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">3. Logbook KP <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="logbook_kp" accept=".pdf" required>
                                    <small class="text-muted">Yang telah ditandatangani pembimbing lapangan</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">4. Form Penilaian Pembimbing Lapangan <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="penilaian_pembimbing" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">5. Surat Pernyataan Keaslian Laporan <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="surat_keaslian" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">6. Sertifikat/Piagam KP</label>
                                    <input type="file" class="form-control" name="sertifikat_kp" accept=".pdf">
                                    <small class="text-muted">Opsional - jika tersedia</small>
                                </div>
                            @elseif($jenis_sidang == 'proposal')
                                <div class="mb-3">
                                    <label class="form-label fw-bold">1. Draft Proposal Skripsi <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="draft_proposal" accept=".pdf" required>
                                    <small class="text-muted">Format: PDF, Maksimal 15MB</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">2. Form Persetujuan Pembimbing <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="persetujuan_pembimbing" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">3. Transkrip Nilai Terbaru <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="transkrip_nilai" accept=".pdf" required>
                                    <small class="text-muted">IPK minimal 2.75</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">4. KRS Semester Berjalan <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="krs_semester" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">5. Surat Pernyataan Keaslian Proposal <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="surat_keaslian" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">6. Form Pengajuan Judul Skripsi <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="form_judul" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">7. Bukti Konsultasi dengan Pembimbing</label>
                                    <input type="file" class="form-control" name="bukti_konsultasi" accept=".pdf">
                                    <small class="text-muted">Opsional - kartu bimbingan atau log konsultasi</small>
                                </div>
                            @endif
                            
                            <button type="submit" class="btn" style="background: #A0522D; color: white;">
                                <i class="bi bi-upload me-2"></i>Upload Persyaratan
                            </button>
                            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>