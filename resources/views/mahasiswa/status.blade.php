<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">SIPESMA</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Status Pendaftaran Sidang</h2>
        
        <div class="card">
            <div class="card-body">
                @if($registrations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Jenis Sidang</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Keterangan</th>
                                    <th>Jadwal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrations as $reg)
                                <tr>
                                    <td>{{ ucwords(str_replace('_', ' ', $reg->jenis_sidang)) }}</td>
                                    <td>{{ $reg->judul }}</td>
                                    <td>
                                        @if($reg->status == 'menunggu')
                                            <span class="badge bg-warning">⏳ Menunggu</span>
                                        @elseif($reg->status == 'diterima')
                                            <span class="badge bg-success">✅ Diterima</span>
                                        @else
                                            <span class="badge bg-danger">❌ Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $reg->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $reg->keterangan ?? '-' }}</td>
                                    <td>
                                        @if($reg->jadwal)
                                            {{ $reg->jadwal->tanggal }} {{ $reg->jadwal->jam }}<br>
                                            Ruang: {{ $reg->jadwal->ruang }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        Belum ada pendaftaran sidang. <a href="{{ route('mahasiswa.register') }}">Daftar sekarang</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>