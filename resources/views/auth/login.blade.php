<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPESMA</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logounfari.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffffffff 0%, #ebd7b4ff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .login-header {
            background: #6c4838ff;
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 16px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #c5957fff;
            box-shadow: 0 0 0 0.2rem rgba(160, 82, 45, 0.15);
        }
        .btn-primary {
            background: #A0522D;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background: #8B4513;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="login-card">
                        <div class="login-header">
                            <i class="bi bi-mortarboard fs-2 mb-2"></i>
                            <h4 class="mb-1">SIPESMA</h4>
                            <small class="opacity-75">Sistem Informasi Pendaftaran Sidang</small>
                        </div>
                        <div class="p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Login sebagai</label>
                                    <select class="form-select" name="role" required onchange="changeFields(this.value)">
                                        <option value="">Pilih Role</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="pembimbing">Pembimbing</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                
                                <div id="loginFields" style="display: none;">
                                    <!-- Mahasiswa -->
                                    <div id="mahasiswaFields" style="display: none;">
                                        <div class="mb-3">
                                            <label class="form-label">NIM</label>
                                            <input type="text" class="form-control" id="nim_mahasiswa" placeholder="Masukkan NIM">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password_mahasiswa" placeholder="Masukkan Password">
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_mahasiswa')">
                                                    <i class="bi bi-eye" id="password_mahasiswa_icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Pembimbing -->
                                    <div id="pembimbingFields" style="display: none;">
                                        <div class="mb-3">
                                            <label class="form-label">NIP</label>
                                            <input type="text" class="form-control" id="nip_pembimbing" placeholder="Masukkan NIP">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password_pembimbing" placeholder="Masukkan Password">
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_pembimbing')">
                                                    <i class="bi bi-eye" id="password_pembimbing_icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Admin -->
                                    <div id="adminFields" style="display: none;">
                                        <div class="mb-3">
                                            <label class="form-label">NIP</label>
                                            <input type="text" class="form-control" id="nip_admin" placeholder="Masukkan NIP">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email_admin" placeholder="Masukkan Email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password_admin" placeholder="Masukkan Password">
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_admin')">
                                                    <i class="bi bi-eye" id="password_admin_icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                    </button>
                                </div>
                            </form>
                        </div>
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
        
        function changeFields(role) {
            const loginFields = document.getElementById('loginFields');
            const mahasiswaFields = document.getElementById('mahasiswaFields');
            const pembimbingFields = document.getElementById('pembimbingFields');
            const adminFields = document.getElementById('adminFields');
            
            // Hide all
            mahasiswaFields.style.display = 'none';
            pembimbingFields.style.display = 'none';
            adminFields.style.display = 'none';
            
            // Clear all inputs and remove name attributes
            document.querySelectorAll('input').forEach(input => {
                input.value = '';
                input.removeAttribute('required');
                input.removeAttribute('name');
            });
            
            if (role) {
                loginFields.style.display = 'block';
                document.getElementById(role + 'Fields').style.display = 'block';
                
                // Set required attributes and name attributes based on role
                if (role === 'mahasiswa') {
                    document.getElementById('nim_mahasiswa').setAttribute('required', 'required');
                    document.getElementById('nim_mahasiswa').setAttribute('name', 'nim');
                    document.getElementById('password_mahasiswa').setAttribute('required', 'required');
                    document.getElementById('password_mahasiswa').setAttribute('name', 'password');
                } else if (role === 'pembimbing') {
                    document.getElementById('nip_pembimbing').setAttribute('required', 'required');
                    document.getElementById('nip_pembimbing').setAttribute('name', 'nip');
                    document.getElementById('password_pembimbing').setAttribute('required', 'required');
                    document.getElementById('password_pembimbing').setAttribute('name', 'password');
                } else if (role === 'admin') {
                    document.getElementById('nip_admin').setAttribute('required', 'required');
                    document.getElementById('nip_admin').setAttribute('name', 'nip');
                    document.getElementById('email_admin').setAttribute('required', 'required');
                    document.getElementById('email_admin').setAttribute('name', 'email');
                    document.getElementById('password_admin').setAttribute('required', 'required');
                    document.getElementById('password_admin').setAttribute('name', 'password');
                }
            } else {
                loginFields.style.display = 'none';
            }
        }
    </script>
</body>
</html>