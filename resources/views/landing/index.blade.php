<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SIPESMA - Sistem Pendaftaran Sidang Mahasiswa</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">SIPESMA</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                        <li class="nav-item"><a class="nav-link" href="#panduan">Panduan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" class="btn btn-outline-primary ms-2 px-3">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-9 align-self-end">
                        <h1 class="text-white font-weight-bold mb-3">Sistem Pendaftaran Sidang Mahasiswa</h1>
                        <p class="text-white-75 fs-5 mb-4">Daftar sidang KP, Proposal, dan Skripsi dengan mudah</p>
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-4">Platform digital untuk memudahkan mahasiswa dalam proses pendaftaran dan penjadwalan sidang. Akses informasi jadwal, persyaratan, dan pengumuman dalam satu tempat.</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a class="btn btn-light btn-lg px-4" href="{{ route('login') }}">Masuk Sekarang</a>
                            <a class="btn btn-outline-light btn-lg px-4" href="#tentang">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Tentang -->
        <section class="page-section" id="tentang" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="mt-0 mb-4">Mengapa Memilih SIPESMA?</h2>
                        <p class="text-muted mb-4">SIPESMA hadir untuk mempermudah proses administrasi sidang mahasiswa. Tidak perlu lagi antri panjang atau bingung dengan prosedur yang rumit.</p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi-check-circle-fill text-success me-2"></i>
                                    <span>Pendaftaran Online</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi-check-circle-fill text-success me-2"></i>
                                    <span>Notifikasi Real-time</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi-check-circle-fill text-success me-2"></i>
                                    <span>Tracking Status</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi-check-circle-fill text-success me-2"></i>
                                    <span>Akses 24/7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="bg-white p-4 rounded shadow-sm">
                            <i class="bi-laptop fs-1 text-primary mb-3 d-block"></i>
                            <h4>Dashboard Terintegrasi</h4>
                            <p class="text-muted mb-0">Kelola semua kebutuhan sidang dalam satu platform yang mudah digunakan</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Fitur -->
        <section class="page-section bg-light" id="fitur">
            <div class="container px-4 px-lg-5">
                <div class="text-center mb-5">
                    <h2 class="mt-0">Fitur Unggulan</h2>
                    <p class="text-muted">Semua yang Anda butuhkan untuk proses sidang yang lancar</p>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="mb-3"><i class="bi-calendar-check fs-1 text-warning"></i></div>
                                <h4 class="card-title">Pendaftaran Sidang</h4>
                                <p class="card-text text-muted">Daftar sidang KP, Proposal, dan Skripsi dengan proses yang simple dan cepat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="mb-3"><i class="bi-bell fs-1 text-info"></i></div>
                                <h4 class="card-title">Notifikasi</h4>
                                <p class="card-text text-muted">Dapatkan update terbaru tentang jadwal, pengumuman, dan status sidang Anda</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="mb-3"><i class="bi-file-earmark-text fs-1 text-success"></i></div>
                                <h4 class="card-title">Dokumen Digital</h4>
                                <p class="card-text text-muted">Upload dan kelola semua dokumen persyaratan sidang secara digital</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Panduan -->
        <section class="page-section" id="panduan">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <h2 class="mt-0 mb-4">Cara Menggunakan SIPESMA</h2>
                        <div class="timeline">
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">1</span>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1">Login dengan NIM</h5>
                                    <p class="text-muted mb-0">Masuk menggunakan NIM dan password yang telah diberikan</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">2</span>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1">Pilih Jenis Sidang</h5>
                                    <p class="text-muted mb-0">Tentukan apakah akan mendaftar KP, Proposal, atau Skripsi</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">3</span>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1">Upload Dokumen</h5>
                                    <p class="text-muted mb-0">Lengkapi semua persyaratan dan dokumen yang diperlukan</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">4</span>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1">Tunggu Konfirmasi</h5>
                                    <p class="text-muted mb-0">Pantau status pendaftaran dan jadwal sidang di dashboard</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1 mb-5 mb-lg-0">
                        <div class="bg-gradient-primary-to-secondary text-white rounded p-5">
                            <h3 class="text-white mb-4">Butuh Bantuan?</h3>
                            <p class="mb-4">Tim support kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami jika mengalami kesulitan.</p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi-envelope me-2"></i>
                                        <small>support@sipesma.ac.id</small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi-telephone me-2"></i>
                                        <small>(021) 123-4567</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h5>SIPESMA</h5>
                        <p class="text-white-50 mb-0">Sistem Pendaftaran Sidang Mahasiswa yang memudahkan proses administrasi akademik.</p>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h6 class="text-uppercase mb-3">Menu</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="text-white-50 text-decoration-none" href="#tentang">Tentang</a></li>
                            <li><a class="text-white-50 text-decoration-none" href="#fitur">Fitur</a></li>
                            <li><a class="text-white-50 text-decoration-none" href="#panduan">Panduan</a></li>
                            <li><a class="text-white-50 text-decoration-none" href="{{ route('login') }}">Login</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h6 class="text-uppercase mb-3">Kontak</h6>
                        <p class="text-white-50 mb-1">Universitas XYZ</p>
                        <p class="text-white-50 mb-1">Jl. Pendidikan No. 123</p>
                        <p class="text-white-50 mb-0">Jakarta, Indonesia</p>
                    </div>
                </div>
                <hr class="my-4" />
                <div class="text-center">
                    <p class="text-white-50 mb-0">&copy; 2024 SIPESMA. Semua hak dilindungi.</p>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
