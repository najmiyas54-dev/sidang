<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#">Admin SIPESMA</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Verifikasi Pendaftaran Sidang</h2>
        
        <div class="card">
            <div class="card-body">
                @if($registrations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mahasiswa</th>
                                    <th>Jenis Sidang</th>
                                    <th>Judul</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrations as $reg)
                                <tr>
                                    <td>{{ $reg->user->name }}<br><small>{{ $reg->user->nim }}</small></td>
                                    <td>{{ ucwords(str_replace('_', ' ', $reg->jenis_sidang)) }}</td>
                                    <td>{{ $reg->judul }}</td>
                                    <td>{{ $reg->dosen_pembimbing }}</td>
                                    <td>
                                        @if($reg->status == 'menunggu')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($reg->status == 'diterima')
                                            <span class="badge bg-success">Diterima</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($reg->status == 'menunggu')
                                            <button class="btn btn-sm btn-success" onclick="verifikasi({{ $reg->id }}, 'diterima')">Terima</button>
                                            <button class="btn btn-sm btn-danger" onclick="verifikasi({{ $reg->id }}, 'ditolak')">Tolak</button>
                                        @endif
                                        @if($reg->file_persyaratan)
                                            <a href="{{ asset('storage/'.$reg->file_persyaratan) }}" class="btn btn-sm btn-info" target="_blank">Download</a>
                                        @endif
                                        @if($reg->status == 'diterima' && !$reg->jadwal)
                                            <a href="{{ route('admin.jadwal.create', $reg->id) }}" class="btn btn-sm btn-primary">Buat Jadwal</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">Belum ada pendaftaran sidang.</div>
                @endif
            </div>
        </div>
    </div>

    <script>
    function verifikasi(id, status) {
        let keterangan = '';
        if(status == 'ditolak') {
            keterangan = prompt('Masukkan alasan penolakan:');
            if(!keterangan) return;
        }
        
        fetch(`/admin/verifikasi/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({status: status, keterangan: keterangan})
        }).then(() => location.reload());
    }
    </script>
</body>
</html>