<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sidang</title>
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
        <h2>Pendaftaran Sidang</h2>
        
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('mahasiswa.register.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis_sidang" class="form-label">Jenis Sidang</label>
                        <select class="form-control" id="jenis_sidang" name="jenis_sidang" required>
                            <option value="">Pilih Jenis Sidang</option>
                            <option value="kerja_praktik">Kerja Praktik</option>
                            <option value="proposal">Proposal</option>
                            <option value="skripsi">Skripsi</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing</label>
                        <input type="text" class="form-control" id="dosen_pembimbing" name="dosen_pembimbing" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="dokumen" class="form-label">File Persyaratan (PDF - Max 20MB)</label>
                        <input type="file" class="form-control" id="dokumen" name="dokumen" accept=".pdf" required onchange="validateFileSize(this)">
                        <div class="form-text">Ukuran file maksimal 20MB</div>
                    </div>
                    
                    <!-- Fields for Kerja Praktik -->
                    <div id="kp-fields" style="display: none;">
                        <div class="mb-3">
                            <label for="tempat_kp" class="form-label">Tempat KP</label>
                            <input type="text" class="form-control" id="tempat_kp" name="tempat_kp">
                        </div>
                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi (bulan)</label>
                            <input type="number" class="form-control" id="durasi" name="durasi">
                        </div>
                    </div>
                    
                    <!-- Fields for Proposal -->
                    <div id="proposal-fields" style="display: none;">
                        <div class="mb-3">
                            <label for="bidang_penelitian" class="form-label">Bidang Penelitian</label>
                            <input type="text" class="form-control" id="bidang_penelitian" name="bidang_penelitian">
                        </div>
                    </div>
                    
                    <!-- Fields for Skripsi -->
                    <div id="skripsi-fields" style="display: none;">
                        <div class="mb-3">
                            <label for="dosen_pembimbing_2" class="form-label">Dosen Pembimbing 2</label>
                            <input type="text" class="form-control" id="dosen_pembimbing_2" name="dosen_pembimbing_2">
                        </div>
                        <div class="mb-3">
                            <label for="progress" class="form-label">Progress (%)</label>
                            <input type="number" class="form-control" id="progress" name="progress" min="0" max="100">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function validateFileSize(input) {
            const maxSize = 20 * 1024 * 1024; // 20MB in bytes
            if (input.files[0] && input.files[0].size > maxSize) {
                alert('File terlalu besar! Maksimal 20MB.');
                input.value = '';
                return false;
            }
        }
        
        document.getElementById('jenis_sidang').addEventListener('change', function() {
            const value = this.value;
            
            // Hide all specific fields
            document.getElementById('kp-fields').style.display = 'none';
            document.getElementById('proposal-fields').style.display = 'none';
            document.getElementById('skripsi-fields').style.display = 'none';
            
            // Show relevant fields
            if (value === 'kerja_praktik') {
                document.getElementById('kp-fields').style.display = 'block';
            } else if (value === 'proposal') {
                document.getElementById('proposal-fields').style.display = 'block';
            } else if (value === 'skripsi') {
                document.getElementById('skripsi-fields').style.display = 'block';
            }
        });
    </script>
</body>
</html>