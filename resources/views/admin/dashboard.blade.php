<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#">Admin - Sidang Skripsi</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Dashboard Admin</h2>
        
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Mahasiswa</h5>
                        <p class="card-text">Kelola data mahasiswa</p>
                        <a href="{{ route('admin.mahasiswa') }}" class="btn btn-primary">Kelola</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Verifikasi Pendaftaran</h5>
                        <p class="card-text">Verifikasi pendaftaran sidang</p>
                        <a href="{{ route('admin.verifikasi') }}" class="btn btn-warning">Verifikasi</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jadwal Sidang</h5>
                        <p class="card-text">Tentukan jadwal sidang</p>
                        <a href="{{ route('admin.jadwal') }}" class="btn btn-success">Jadwal</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan</h5>
                        <p class="card-text">Lihat laporan sidang</p>
                        <a href="{{ route('admin.laporan') }}" class="btn btn-info">Laporan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>