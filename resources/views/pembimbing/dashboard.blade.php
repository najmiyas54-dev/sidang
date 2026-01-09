<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembimbing - SIPESMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .navbar { background: linear-gradient(135deg, #A0522D 0%, #D2B48C 100%) !important; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .stats-card { background: linear-gradient(135deg, #A0522D 0%, #D2B48C 100%); color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-mortarboard me-2"></i>SIPESMA - Pembimbing
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">{{ Auth::user()->name }}</span>
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card stats-card">
                    <div class="card-body">
                        <h3><i class="bi bi-person-workspace me-2"></i>Dashboard Pembimbing</h3>
                        <p class="mb-0">Selamat datang, {{ Auth::user()->name }}. Kelola mahasiswa bimbingan Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-people fs-1 text-primary"></i>
                        <h4>{{ $mahasiswaBimbingan->count() }}</h4>
                        <p class="text-muted">Total Bimbingan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-hourglass fs-1 text-warning"></i>
                        <h4>{{ $mahasiswaBimbingan->count() }}</h4>
                        <p class="text-muted">Menunggu Review</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-calendar-event fs-1 text-info"></i>
                        <h4>{{ $jadwalSidang->count() }}</h4>
                        <p class="text-muted">Jadwal Sidang</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Mahasiswa Bimbingan -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-people me-2"></i>Mahasiswa Bimbingan</h5>
                    </div>
                    <div class="card-body">
                        @if($mahasiswaBimbingan->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Mahasiswa</th>
                                            <th>Jenis Sidang</th>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th>Tanggal Daftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mahasiswaBimbingan as $mhs)
                                        <tr>
                                            <td>
                                                <strong>{{ $mhs->user->name }}</strong><br>
                                                <small class="text-muted">{{ $mhs->user->nim }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ ucwords(str_replace('_', ' ', $mhs->jenis_sidang)) }}</span>
                                            </td>
                                            <td>{{ Str::limit($mhs->judul, 40) }}</td>
                                            <td>
                                                @if($mhs->status == 'menunggu')
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @elseif($mhs->status == 'diterima')
                                                    <span class="badge bg-success">Diterima</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $mhs->created_at->format('d M Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                <h6 class="text-muted mt-2">Belum ada mahasiswa bimbingan</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Chat with Admin -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-chat-dots me-2"></i>Chat dengan Admin</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="chat-container" style="height: 300px; overflow-y: auto; padding: 15px;">
                            @if($chats->count() > 0)
                                @foreach($chats as $chat)
                                <div class="mb-2 {{ $chat->sender_id == Auth::id() ? 'text-end' : '' }}">
                                    <div class="d-inline-block p-2 rounded {{ $chat->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }}" style="max-width: 80%;">
                                        {{ $chat->message }}
                                    </div>
                                    <div class="small text-muted">{{ $chat->created_at->format('H:i') }}</div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center text-muted">
                                    <i class="bi bi-chat fs-1"></i>
                                    <p>Belum ada pesan</p>
                                </div>
                            @endif
                        </div>
                        <div class="border-top p-3">
                            <form id="chatForm">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="messageInput" placeholder="Ketik pesan..." required>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-send"></i>
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
        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();
            
            if (message) {
                fetch('/pembimbing/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({message: message})
                }).then(() => {
                    messageInput.value = '';
                    location.reload();
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>