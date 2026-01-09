<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - SIPESMA</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logounfari.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f8fafc; }
        
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            padding: 8px 16px;
            border-radius: 8px;
            margin: 0 4px;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white !important;
        }
        
        .main-content {
            margin-top: 80px;
            padding: 24px;
        }
        
        .welcome-section {
            background: linear-gradient(135deg, #A0522D 0%, #D2B48C 100%);
            border-radius: 16px;
            padding: 32px;
            color: white;
            margin-bottom: 32px;
        }
        
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
            height: 100%;
        }
        .stats-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .announcement-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 4px solid #A0522D;
        }
        
        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        
        .nav-pills .nav-link {
            border-radius: 8px;
            margin-right: 8px;
            color: #8B4513;
            font-weight: 500;
            padding: 8px 16px;
        }
        .nav-pills .nav-link.active {
            background: #A0522D;
            color: white;
        }
        
        .table th {
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(135deg, #A0522D 0%, #D2B48C 50%, #F5DEB3 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="https://www.instagram.com/unfaribdg?igsh=NTZoZ2Nlc2k3MjVk">
                <i class="bi bi-mortarboard-fill me-2" style="font-size: 1.5rem;"></i>
                <span class="fw-bold">SIPESMA</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="showContent('dashboard')">
                            <i class="bi bi-house-door me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showContent('kp')">
                            <i class="bi bi-briefcase me-1"></i> Kerja Praktik
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showContent('proposal')">
                            <i class="bi bi-file-text me-1"></i> Proposal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showContent('skripsi')">
                            <i class="bi bi-book me-1"></i> Skripsi
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center position-relative" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell me-2"></i>
                            @if($notifications->where('is_read', false)->count() > 0)
                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                    {{ $notifications->where('is_read', false)->count() }}
                                </span>
                            @endif
                            Notifikasi
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                            @if($notifications->count() > 0)
                                @foreach($notifications as $notif)
                                <li>
                                    <div class="dropdown-item-text {{ $notif->is_read ? '' : 'bg-light' }}">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-{{ $notif->type == 'success' ? 'check-circle text-success' : 'x-circle text-danger' }} me-2 mt-1"></i>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-semibold">{{ $notif->title }}</h6>
                                                <p class="mb-1 small">{{ $notif->message }}</p>
                                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @if(!$loop->last)<li><hr class="dropdown-divider"></li>@endif
                                @endforeach
                            @else
                                <li><div class="dropdown-item-text text-center py-3">Tidak ada notifikasi</div></li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://via.placeholder.com/32x32/ffffff/ff7e5f?text='.substr(Auth::user()->name, 0, 1) }}" 
                                 class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('mahasiswa.profile.edit') }}"><i class="bi bi-person-gear me-2"></i>Edit Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                        <p class="mb-0 opacity-90">{{ Auth::user()->nim }} • {{ Auth::user()->prodi ?? 'Program Studi belum diisi' }}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="d-flex align-items-center justify-content-end">
                            <i class="bi bi-calendar3 me-2"></i>
                            <span>{{ now()->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Announcements & Registration History -->
            <div class="row mb-4" id="announcements-section">
                <!-- Pengumuman - Kiri -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header" style="background: #F5DEB3; border-bottom: 1px solid #D2B48C;">
                            <h5 class="mb-0" style="color: #8B4513;"><i class="bi bi-megaphone me-2"></i>Pengumuman Terbaru</h5>
                        </div>
                        <div class="card-body">
                            @if($announcements->count() > 0)
                                @foreach($announcements as $announcement)
                                <div class="border-start border-3 ps-3 mb-3" style="border-color: #A0522D !important;">
                                    <h6 class="fw-semibold mb-1" style="color: #8B4513;">{{ $announcement->title }}</h6>
                                    <p class="mb-1 text-muted small">{{ $announcement->content }}</p>
                                    <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                                </div>
                                @if(!$loop->last)<hr class="my-3">@endif
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-info-circle text-muted fs-1"></i>
                                    <p class="text-muted mt-2">Belum ada pengumuman</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Riwayat Pendaftaran - Kanan -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header" style="background: #F5DEB3; border-bottom: 1px solid #D2B48C;">
                            <h5 class="mb-0" style="color: #8B4513;"><i class="bi bi-clock-history me-2"></i>Riwayat Pendaftaran</h5>
                        </div>
                        <div class="card-body">
                            @if($registrations->count() > 0)
                                @foreach($registrations->take(4) as $reg)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-medium">{{ ucwords(str_replace('_', ' ', $reg->jenis_sidang)) }}</h6>
                                        <p class="mb-1 text-muted small">{{ Str::limit($reg->judul, 35) }}</p>
                                        <small class="text-muted">{{ $reg->created_at->format('d M Y') }}</small>
                                    </div>
                                    <div class="ms-2">
                                        @if($reg->status == 'menunggu')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif($reg->status == 'diterima')
                                            <span class="badge bg-success">Diterima</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </div>
                                </div>
                                @if(!$loop->last && $loop->index < 3)<hr class="my-2">@endif
                                @endforeach
                                @if($registrations->count() > 4)
                                    <div class="text-center mt-3">
                                        <small class="text-muted">+{{ $registrations->count() - 4 }} lainnya</small>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-inbox text-muted fs-1"></i>
                                    <p class="text-muted mt-2">Belum ada riwayat pendaftaran</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

                <!-- Dashboard Content -->
                <div id="dashboard-content" class="content-section">
                    <!-- Quick Stats -->
                    <div class="row mb-4">
                        <div class="col-lg-4 mb-3">
                            <div class="stats-card text-center" onclick="showContent('kp')" style="cursor: pointer;">
                                <div class="icon-wrapper mx-auto" style="background: rgba(160, 82, 45, 0.1);">
                                    <i class="bi bi-briefcase fs-4" style="color: #A0522D;"></i>
                                </div>
                                <h6 class="text-muted mb-1">Kerja Praktik</h6>
                                <h4 class="mb-0 fw-bold" style="color: #A0522D;">{{ $kpStatus }}</h4>
                                @if($kpRegistration)
                                    <small class="text-muted">Klik untuk detail</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="stats-card text-center" onclick="showContent('proposal')" style="cursor: pointer;">
                                <div class="icon-wrapper mx-auto" style="background: rgba(210, 180, 140, 0.3);">
                                    <i class="bi bi-file-text fs-4" style="color: #D2B48C;"></i>
                                </div>
                                <h6 class="text-muted mb-1">Proposal</h6>
                                <h4 class="mb-0 fw-bold" style="color: #D2B48C;">{{ $proposalStatus }}</h4>
                                @if($proposalRegistration)
                                    <small class="text-muted">Klik untuk detail</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="stats-card text-center" onclick="showContent('skripsi')" style="cursor: pointer;">
                                <div class="icon-wrapper mx-auto" style="background: rgba(245, 222, 179, 0.5);">
                                    <i class="bi bi-book fs-4" style="color: #F5DEB3;"></i>
                                </div>
                                <h6 class="text-muted mb-1">Skripsi</h6>
                                <h4 class="mb-0 fw-bold" style="color: #CD853F;">{{ $skripsiStatus }}</h4>
                                @if($skripsiRegistration)
                                    <small class="text-muted">Klik untuk detail</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Content Tabs -->
                    <div class="content-card">
                        <div class="card-header" style="background: #F5DEB3; border-bottom: 1px solid #D2B48C;">
                            <ul class="nav nav-pills card-header-pills mb-0">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#" onclick="showTabContent('jadwal')" style="background: #A0522D; border-color: #A0522D;">📅 Jadwal Sidang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="showTabContent('statistik')" style="color: #8B4513;">📊 Statistik</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="jadwal-tab" class="tab-content-item">
                                @if($jadwalSidang)
                                    <div class="alert border-0" style="background: rgba(160, 82, 45, 0.1); border-left: 4px solid #A0522D !important;">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="bi bi-calendar-check fs-1" style="color: #A0522D;"></i>
                                            </div>
                                            <div class="col">
                                                <h5 class="mb-2" style="color: #8B4513;">Jadwal Sidang Anda</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <strong>Tanggal:</strong><br>
                                                        {{ date('d F Y', strtotime($jadwalSidang->tanggal)) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Waktu:</strong><br>
                                                        {{ $jadwalSidang->jam }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Ruangan:</strong><br>
                                                        {{ $jadwalSidang->ruang }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
                                        <h5 class="text-muted mt-3">Belum ada jadwal sidang</h5>
                                        <p class="text-muted">Jadwal akan muncul setelah pendaftaran disetujui admin</p>
                                    </div>
                                @endif
                            </div>

                            <div id="statistik-tab" class="tab-content-item" style="display: none;">
                                <div class="row text-center">
                                    <div class="col-md-4 mb-3">
                                        <div class="p-4 bg-success bg-opacity-10 rounded">
                                            <i class="bi bi-check-circle text-success fs-1"></i>
                                            <h3 class="mt-2 mb-1 text-success">{{ $registrations->where('status', 'diterima')->count() }}</h3>
                                            <p class="text-muted mb-0">Diterima</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="p-4 bg-warning bg-opacity-10 rounded">
                                            <i class="bi bi-clock text-warning fs-1"></i>
                                            <h3 class="mt-2 mb-1 text-warning">{{ $registrations->where('status', 'menunggu')->count() }}</h3>
                                            <p class="text-muted mb-0">Menunggu</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="p-4 bg-danger bg-opacity-10 rounded">
                                            <i class="bi bi-x-circle text-danger fs-1"></i>
                                            <h3 class="mt-2 mb-1 text-danger">{{ $registrations->where('status', 'ditolak')->count() }}</h3>
                                            <p class="text-muted mb-0">Ditolak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KP Content -->
                <div id="kp-content" class="content-section" style="display: none;">
                    <div class="content-card">
                        @if($kpRegistration)
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="mb-4"><i class="bi bi-briefcase me-2"></i>Status Kerja Praktik</h4>
                                    
                                    <!-- Info Umum -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Pendaftaran</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Status:</strong> 
                                                        @if($kpRegistration->status == 'menunggu')
                                                            <span class="badge bg-warning">⏳ Menunggu Verifikasi</span>
                                                        @elseif($kpRegistration->status == 'diterima')
                                                            <span class="badge bg-success">✅ Diterima</span>
                                                        @else
                                                            <span class="badge bg-danger">❌ Ditolak</span>
                                                        @endif
                                                    </p>
                                                    <p class="mb-2"><strong>Judul:</strong> {{ $kpRegistration->judul }}</p>
                                                    <p class="mb-0"><strong>Dosen Pembimbing:</strong> {{ $kpRegistration->dosen_pembimbing }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Tanggal Daftar:</strong> {{ $kpRegistration->created_at->format('d M Y') }}</p>
                                                    <p class="mb-2"><strong>Tempat KP:</strong> {{ $kpRegistration->tempat_kp ?? 'Belum diisi' }}</p>
                                                    <p class="mb-0"><strong>Durasi:</strong> {{ $kpRegistration->durasi ?? 'Belum diisi' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Persyaratan -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-warning text-dark">
                                            <h6 class="mb-0"><i class="bi bi-file-check me-2"></i>Status Persyaratan</h6>
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
                                                        @if($kpDocuments->count() > 0)
                                                            @foreach($kpDocuments as $doc)
                                                            <tr>
                                                                <td>{{ $doc->document_name }}</td>
                                                                <td>
                                                                    @if($doc->status == 'pending')
                                                                        <span class="badge bg-warning">⏳ Review</span>
                                                                    @elseif($doc->status == 'approved')
                                                                        <span class="badge bg-success">✅ Diterima</span>
                                                                    @else
                                                                        <span class="badge bg-danger">❌ Ditolak</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($doc->admin_notes)
                                                                        <span class="{{ $doc->status == 'rejected' ? 'text-danger' : 'text-muted' }}">{{ $doc->admin_notes }}</span>
                                                                    @else
                                                                        <span class="text-muted">{{ $doc->status == 'pending' ? 'Sedang diverifikasi' : 'Dokumen sesuai' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">Lihat</a>
                                                                    @if($doc->status == 'rejected')
                                                                        <button class="btn btn-sm btn-warning" onclick="uploadUlang('{{ $doc->document_type }}')">Upload Ulang</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4" class="text-center text-muted">Belum ada dokumen yang diupload</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Jadwal Sidang -->
                                    @if($kpRegistration->status == 'diterima')
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Jadwal Sidang</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($jadwalSidang)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <strong>Tanggal:</strong><br>
                                                        {{ date('d F Y', strtotime($jadwalSidang->tanggal)) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Waktu:</strong><br>
                                                        {{ $jadwalSidang->jam }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Ruangan:</strong><br>
                                                        {{ $jadwalSidang->ruang }}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-center py-3">
                                                    <i class="bi bi-calendar-x text-muted fs-1"></i>
                                                    <p class="text-muted mt-2">Jadwal sidang belum ditentukan</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <h4 class="mb-4"><i class="bi bi-briefcase me-2"></i>Pendaftaran Kerja Praktik</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="{{ route('mahasiswa.register.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="jenis_sidang" value="kerja_praktik">
                                        
                                        <div class="card mb-4">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Data Kerja Praktik</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Judul Kerja Praktik</label>
                                                    <input type="text" class="form-control" name="judul" required>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Tempat KP</label>
                                                        <input type="text" class="form-control" name="tempat_kp" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Durasi</label>
                                                        <select class="form-control" name="durasi" required>
                                                            <option value="">Pilih Durasi</option>
                                                            <option value="2 bulan">2 Bulan</option>
                                                            <option value="3 bulan">3 Bulan</option>
                                                            <option value="4 bulan">4 Bulan</option>
                                                            <option value="6 bulan">6 Bulan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Dosen Pembimbing</label>
                                                    <input type="text" class="form-control" name="dosen_pembimbing" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card mb-4">
                                            <div class="card-header bg-warning text-dark">
                                                <h6 class="mb-0"><i class="bi bi-upload me-2"></i>Upload Persyaratan</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Permohonan Seminar KP</label>
                                                        <input type="file" class="form-control" name="surat_permohonan" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Selesai Bimbingan</label>
                                                        <input type="file" class="form-control" name="surat_bimbingan" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Penilaian Perusahaan</label>
                                                        <input type="file" class="form-control" name="penilaian_perusahaan" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Draft Laporan KP</label>
                                                        <input type="file" class="form-control" name="draft_laporan" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Kartu Bimbingan KP</label>
                                                        <input type="file" class="form-control" name="kartu_bimbingan" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Bebas Keuangan</label>
                                                        <input type="file" class="form-control" name="bebas_keuangan" accept=".pdf" required>
                                                    </div>
                                                </div>
                                                <small class="text-muted">Semua file harus dalam format PDF, maksimal 5MB per file</small>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-send me-2"></i>Daftar Kerja Praktik
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title">📋 Persyaratan KP</h6>
                                            <ul class="list-unstyled small">
                                                <li>• Surat permohonan seminar KP</li>
                                                <li>• Surat keterangan selesai bimbingan</li>
                                                <li>• Daftar penilaian perusahaan/instansi</li>
                                                <li>• Hard copy draf laporan (2 eks)</li>
                                                <li>• Kartu bimbingan KP asli</li>
                                                <li>• Surat bebas kewajiban keuangan</li>
                                                <li>• Kirim soft file ke akademik@stmikjabar.ac.id</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Proposal Content -->
                <div id="proposal-content" class="content-section" style="display: none;">
                    <div class="content-card">
                        @if($proposalRegistration)
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="mb-4"><i class="bi bi-file-text me-2"></i>Status Proposal</h4>
                                    
                                    <!-- Info Umum -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Pendaftaran</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Status:</strong> 
                                                        @if($proposalRegistration->status == 'menunggu')
                                                            <span class="badge bg-warning">⏳ Menunggu Verifikasi</span>
                                                        @elseif($proposalRegistration->status == 'diterima')
                                                            <span class="badge bg-success">✅ Diterima</span>
                                                        @else
                                                            <span class="badge bg-danger">❌ Ditolak</span>
                                                        @endif
                                                    </p>
                                                    <p class="mb-2"><strong>Judul:</strong> {{ $proposalRegistration->judul }}</p>
                                                    <p class="mb-0"><strong>Dosen Pembimbing:</strong> {{ $proposalRegistration->dosen_pembimbing }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Tanggal Daftar:</strong> {{ $proposalRegistration->created_at->format('d M Y') }}</p>
                                                    <p class="mb-0"><strong>Bidang Penelitian:</strong> {{ $proposalRegistration->bidang_penelitian ?? 'Belum diisi' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Persyaratan -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-warning text-dark">
                                            <h6 class="mb-0"><i class="bi bi-file-check me-2"></i>Status Persyaratan</h6>
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
                                                        @if($proposalDocuments->count() > 0)
                                                            @foreach($proposalDocuments as $doc)
                                                            <tr>
                                                                <td>{{ $doc->document_name }}</td>
                                                                <td>
                                                                    @if($doc->status == 'pending')
                                                                        <span class="badge bg-warning">⏳ Review</span>
                                                                    @elseif($doc->status == 'approved')
                                                                        <span class="badge bg-success">✅ Diterima</span>
                                                                    @else
                                                                        <span class="badge bg-danger">❌ Ditolak</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($doc->admin_notes)
                                                                        <span class="{{ $doc->status == 'rejected' ? 'text-danger' : 'text-muted' }}">{{ $doc->admin_notes }}</span>
                                                                    @else
                                                                        <span class="text-muted">{{ $doc->status == 'pending' ? 'Sedang diverifikasi' : 'Dokumen sesuai' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">Lihat</a>
                                                                    @if($doc->status == 'rejected')
                                                                        <button class="btn btn-sm btn-warning" onclick="uploadUlang('{{ $doc->document_type }}')">Upload Ulang</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4" class="text-center text-muted">Belum ada dokumen yang diupload</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Jadwal Sidang -->
                                    @if($proposalRegistration->status == 'diterima')
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Jadwal Sidang</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($jadwalSidang)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <strong>Tanggal:</strong><br>
                                                        {{ date('d F Y', strtotime($jadwalSidang->tanggal)) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Waktu:</strong><br>
                                                        {{ $jadwalSidang->jam }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Ruangan:</strong><br>
                                                        {{ $jadwalSidang->ruang }}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-center py-3">
                                                    <i class="bi bi-calendar-x text-muted fs-1"></i>
                                                    <p class="text-muted mt-2">Jadwal sidang belum ditentukan</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <h4 class="mb-4"><i class="bi bi-file-text me-2"></i>Pendaftaran Proposal</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="{{ route('mahasiswa.register.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="jenis_sidang" value="proposal">
                                        
                                        <div class="card mb-4">
                                            <div class="card-header bg-success text-white">
                                                <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Data Proposal</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Judul Proposal</label>
                                                    <textarea class="form-control" name="judul" rows="2" required></textarea>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Bidang Penelitian</label>
                                                        <select class="form-control" name="bidang_penelitian" required>
                                                            <option value="">Pilih Bidang</option>
                                                            <option value="Sistem Informasi">Sistem Informasi</option>
                                                            <option value="Jaringan Komputer">Jaringan Komputer</option>
                                                            <option value="Artificial Intelligence">Artificial Intelligence</option>
                                                            <option value="Mobile Development">Mobile Development</option>
                                                            <option value="Web Development">Web Development</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Dosen Pembimbing</label>
                                                        <input type="text" class="form-control" name="dosen_pembimbing" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card mb-4">
                                            <div class="card-header bg-warning text-dark">
                                                <h6 class="mb-0"><i class="bi bi-upload me-2"></i>Upload Persyaratan</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Permohonan Seminar Proposal</label>
                                                        <input type="file" class="form-control" name="surat_permohonan_proposal" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Selesai Bimbingan</label>
                                                        <input type="file" class="form-control" name="surat_bimbingan_proposal" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Draft Laporan Proposal</label>
                                                        <input type="file" class="form-control" name="draft_laporan_proposal" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Bebas Keuangan</label>
                                                        <input type="file" class="form-control" name="bebas_keuangan_proposal" accept=".pdf" required>
                                                    </div>
                                                </div>
                                                <small class="text-muted">Semua file harus dalam format PDF, maksimal 5MB per file</small>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-send me-2"></i>Daftar Proposal
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title">📋 Persyaratan Proposal</h6>
                                            <ul class="list-unstyled small">
                                                <li>• Surat permohonan seminar proposal skripsi</li>
                                                <li>• Surat keterangan selesai bimbingan</li>
                                                <li>• Hard copy draf laporan (2 eks)</li>
                                                <li>• Surat bebas kewajiban keuangan</li>
                                                <li>• Kirim soft file ke akademik@stmikjabar.ac.id</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Skripsi Content -->
                <div id="skripsi-content" class="content-section" style="display: none;">
                    <div class="content-card">
                        @if($skripsiRegistration)
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="mb-4"><i class="bi bi-book me-2"></i>Status Skripsi</h4>
                                    
                                    <!-- Info Umum -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-danger text-white">
                                            <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Pendaftaran</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Status:</strong> 
                                                        @if($skripsiRegistration->status == 'menunggu')
                                                            <span class="badge bg-warning">⏳ Menunggu Verifikasi</span>
                                                        @elseif($skripsiRegistration->status == 'diterima')
                                                            <span class="badge bg-success">✅ Diterima</span>
                                                        @else
                                                            <span class="badge bg-danger">❌ Ditolak</span>
                                                        @endif
                                                    </p>
                                                    <p class="mb-2"><strong>Judul:</strong> {{ $skripsiRegistration->judul }}</p>
                                                    <p class="mb-0"><strong>Dosen Pembimbing 1:</strong> {{ $skripsiRegistration->dosen_pembimbing }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Tanggal Daftar:</strong> {{ $skripsiRegistration->created_at->format('d M Y') }}</p>
                                                    <p class="mb-2"><strong>Dosen Pembimbing 2:</strong> {{ $skripsiRegistration->dosen_pembimbing_2 ?? 'Tidak ada' }}</p>
                                                    <p class="mb-0"><strong>Progress:</strong> {{ $skripsiRegistration->progress ?? 'Dalam pengerjaan' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Persyaratan -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-warning text-dark">
                                            <h6 class="mb-0"><i class="bi bi-file-check me-2"></i>Status Persyaratan</h6>
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
                                                        @if($skripsiDocuments->count() > 0)
                                                            @foreach($skripsiDocuments as $doc)
                                                            <tr>
                                                                <td>{{ $doc->document_name }}</td>
                                                                <td>
                                                                    @if($doc->status == 'pending')
                                                                        <span class="badge bg-warning">⏳ Review</span>
                                                                    @elseif($doc->status == 'approved')
                                                                        <span class="badge bg-success">✅ Diterima</span>
                                                                    @else
                                                                        <span class="badge bg-danger">❌ Ditolak</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($doc->admin_notes)
                                                                        <span class="{{ $doc->status == 'rejected' ? 'text-danger' : 'text-muted' }}">{{ $doc->admin_notes }}</span>
                                                                    @else
                                                                        <span class="text-muted">{{ $doc->status == 'pending' ? 'Sedang diverifikasi' : 'Dokumen sesuai' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">Lihat</a>
                                                                    @if($doc->status == 'rejected')
                                                                        <button class="btn btn-sm btn-warning" onclick="uploadUlang('{{ $doc->document_type }}')">Upload Ulang</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4" class="text-center text-muted">Belum ada dokumen yang diupload</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Jadwal Sidang -->
                                    @if($skripsiRegistration->status == 'diterima')
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Jadwal Sidang</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($jadwalSidang)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <strong>Tanggal:</strong><br>
                                                        {{ date('d F Y', strtotime($jadwalSidang->tanggal)) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Waktu:</strong><br>
                                                        {{ $jadwalSidang->jam }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>Ruangan:</strong><br>
                                                        {{ $jadwalSidang->ruang }}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-center py-3">
                                                    <i class="bi bi-calendar-x text-muted fs-1"></i>
                                                    <p class="text-muted mt-2">Jadwal sidang belum ditentukan</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <h4 class="mb-4"><i class="bi bi-book me-2"></i>Pendaftaran Skripsi</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="{{ route('mahasiswa.register.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="jenis_sidang" value="skripsi">
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Judul Skripsi</label>
                                            <textarea class="form-control" name="judul" rows="2" required></textarea>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Dosen Pembimbing 1</label>
                                                <input type="text" class="form-control" name="dosen_pembimbing" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Dosen Pembimbing 2</label>
                                                <input type="text" class="form-control" name="dosen_pembimbing_2">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Progress Pengerjaan</label>
                                            <select class="form-control" name="progress" required>
                                                <option value="">Pilih Progress</option>
                                                <option value="Bab 1-2 (30%)">Bab 1-2 (30%)</option>
                                                <option value="Bab 1-3 (60%)">Bab 1-3 (60%)</option>
                                                <option value="Bab 1-4 (80%)">Bab 1-4 (80%)</option>
                                                <option value="Lengkap (100%)">Lengkap (100%)</option>
                                            </select>
                                        </div>
                                        
                                        <div class="card mb-4">
                                            <div class="card-header bg-warning text-dark">
                                                <h6 class="mb-0"><i class="bi bi-upload me-2"></i>Upload Persyaratan</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Transkrip Nilai</label>
                                                        <input type="file" class="form-control" name="transkrip_nilai" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Sertifikat KP</label>
                                                        <input type="file" class="form-control" name="sertifikat_kp" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Permohonan Sidang Skripsi</label>
                                                        <input type="file" class="form-control" name="surat_permohonan_skripsi" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Selesai Bimbingan</label>
                                                        <input type="file" class="form-control" name="surat_bimbingan_skripsi" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Draft Skripsi Lengkap</label>
                                                        <input type="file" class="form-control" name="draft_skripsi" accept=".pdf" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Surat Bebas Keuangan</label>
                                                        <input type="file" class="form-control" name="bebas_keuangan_skripsi" accept=".pdf" required>
                                                    </div>
                                                </div>
                                                <small class="text-muted">Semua file harus dalam format PDF, maksimal 5MB per file</small>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-send"></i> Daftar Skripsi
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title">📋 Persyaratan Skripsi</h6>
                                            <ul class="list-unstyled small">
                                                <li>• Minimal 140 SKS</li>
                                                <li>• IPK minimal 2.75</li>
                                                <li>• Lulus seminar proposal</li>
                                                <li>• Draft skripsi min 80%</li>
                                                <li>• Sertifikat KP</li>
                                                <li>• Transkrip nilai</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Check for new notifications every 30 seconds
        setInterval(function() {
            fetch('/mahasiswa/check-notifications')
                .then(response => response.json())
                .then(data => {
                    if (data.hasNew) {
                        // Vibrate phone if supported
                        if (navigator.vibrate) {
                            navigator.vibrate([200, 100, 200]);
                        }
                        
                        // Show browser notification if supported
                        if (Notification.permission === 'granted') {
                            new Notification('SIPESMA - Notifikasi Baru', {
                                body: 'Anda memiliki notifikasi baru dari admin',
                                icon: '/favicon.ico'
                            });
                        }
                        
                        // Reload page to show new notification
                        setTimeout(() => location.reload(), 1000);
                    }
                });
        }, 30000);
        
        // Request notification permission on page load
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }
        
        function showContent(section) {
            // Hide all content sections
            document.querySelectorAll('.content-section').forEach(el => el.style.display = 'none');
            
            // Show selected section
            document.getElementById(section + '-content').style.display = 'block';
            
            // Hide/show announcements section based on section
            const announcementsSection = document.getElementById('announcements-section');
            
            if (section === 'dashboard') {
                if (welcomeSection) welcomeSection.style.display = 'block';
                if (announcementsSection) announcementsSection.style.display = 'flex';
            } else {
                if (welcomeSection) welcomeSection.style.display = 'none';
                if (announcementsSection) announcementsSection.style.display = 'none';
            }
            
            // Update active nav
            document.querySelectorAll('.navbar-nav .nav-link').forEach(el => el.classList.remove('active'));
            event.target.classList.add('active');
        }

        function showTabContent(tab) {
            // Hide all tab content
            document.querySelectorAll('.tab-content-item').forEach(el => el.style.display = 'none');
            
            // Show selected tab
            document.getElementById(tab + '-tab').style.display = 'block';
            
            // Update active tab
            document.querySelectorAll('.nav-pills .nav-link').forEach(el => el.classList.remove('active'));
            event.target.classList.add('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>