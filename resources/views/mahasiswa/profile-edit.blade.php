<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - SIPESMA</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logounfari.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffffffff 0%, #ebd7b4ff 100%);
            min-height: 100vh;
        }
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #A0522D;
        }
        .btn-primary {
            background: #A0522D;
            border: none;
        }
        .btn-primary:hover {
            background: #8B4513;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: #6c4838ff;">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-mortarboard me-2"></i>SIPESMA</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="card shadow">
                    <div class="card-header" style="background: #A0522D; color: white;">
                        <h4 class="mb-0"><i class="bi bi-person-gear me-2"></i>Edit Profil Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mahasiswa.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Profile Photo Section -->
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    @if(Auth::user()->photo)
                                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="profile-photo" alt="Profile Photo">
                                    @else
                                        <div class="profile-photo d-flex align-items-center justify-content-center bg-light">
                                            <i class="bi bi-person-circle" style="font-size: 60px; color: #A0522D;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Foto Profil</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    <div class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB</div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">NIM</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->nim }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No HP</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ Auth::user()->no_hp }}">
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <h5 class="mb-3"><i class="bi bi-key me-2"></i>Ganti Password</h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Password Lama</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                                <i class="bi bi-eye" id="current_password_icon"></i>
                                            </button>
                                        </div>
                                        <div class="form-text">Kosongkan jika tidak ingin mengganti password</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Password Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                                                <i class="bi bi-eye" id="new_password_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password_confirmation')">
                                                <i class="bi bi-eye" id="new_password_confirmation_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-2"></i>Update Profil
                                </button>
                                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '_icon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                passwordField.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
</body>
</html>