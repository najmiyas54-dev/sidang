<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - SIPESMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary no-print">
        <div class="container">
            <a class="navbar-brand" href="#">SIPESMA</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>BUKTI PENDAFTARAN SIDANG</h3>
                        <p class="mb-0">SIPESMA - Sistem Pendaftaran Sidang Mahasiswa</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>Nama Mahasiswa</strong></td>
                                <td>: {{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>NIM</strong></td>
                                <td>: {{ $user->nim }}</td>
                            </tr>
                            <tr>
                                <td><strong>Program Studi</strong></td>
                                <td>: {{ $user->prodi ?? 'Belum diisi' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Sidang</strong></td>
                                <td>: {{ ucwords(str_replace('_', ' ', $registration->jenis_sidang)) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Judul</strong></td>
                                <td>: {{ $registration->judul }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dosen Pembimbing</strong></td>
                                <td>: {{ $registration->dosen_pembimbing }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Daftar</strong></td>
                                <td>: {{ $registration->created_at->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: 
                                    @if($registration->status == 'menunggu')
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    @elseif($registration->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @if($registration->keterangan)
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>: {{ $registration->keterangan }}</td>
                            </tr>
                            @endif
                        </table>
                        
                        <div class="text-center mt-4 no-print">
                            <button onclick="window.print()" class="btn btn-primary">
                                <i class="bi bi-printer"></i> Cetak Bukti
                            </button>
                            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                        
                        <div class="text-end mt-5">
                            <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>