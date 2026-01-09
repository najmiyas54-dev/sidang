<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPESMA - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 50%, #d2691e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }
        .login-container {
            position: relative;
            z-index: 1;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 50%, #d2691e 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white" opacity="0.1"/><circle cx="80" cy="80" r="2" fill="white" opacity="0.1"/><circle cx="60" cy="30" r="1" fill="white" opacity="0.1"/></svg>');
        }
        .login-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        .login-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        .form-floating {
            margin-bottom: 1.5rem;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #ff7e5f;
            box-shadow: 0 0 0 0.2rem rgba(255, 126, 95, 0.25);
        }
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-select:focus {
            border-color: #ff7e5f;
            box-shadow: 0 0 0 0.2rem rgba(255, 126, 95, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 50%, #d2691e 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 126, 95, 0.3);
            color: white;
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .alert {
            border-radius: 12px;
            border: none;
        }
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 70%;
            right: 10%;
            animation-delay: 2s;
        }
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 40%;
            left: 80%;
            animation-delay: 4s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card">
                    <div class="login-header">
                        <i class="bi bi-mortarboard-fill" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <h1>SIPESMA</h1>
                        <p>Sistem Pendaftaran Sidang Mahasiswa</p>
                    </div>
                    
                    <div class="p-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
                                <label for="nim"><i class="bi bi-person-badge me-2"></i>NIM</label>
                            </div>
                            
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                            </div>
                            
                            <div class="mb-4">
                                <label for="role" class="form-label"><i class="bi bi-people me-2"></i>Login sebagai</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="mahasiswa">👨‍🎓 Mahasiswa</option>
                                    <option value="admin">👨‍💼 Admin</option>
                                    <option value="dosen">👨‍🏫 Dosen</option>
                                </select>
                            </div>
                            
                            @if($errors->any())
                                <div class="alert alert-danger d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            
                            <button type="submit" class="btn btn-login w-100">
                                <i class="bi bi-box-arrow-in-right me-2"></i>LOGIN
                            </button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <small class="text-muted">
                                <i class="bi bi-shield-check me-1"></i>
                                Sistem aman dan terpercaya
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>