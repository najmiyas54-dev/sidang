# SIPESMA - Sistem Pendaftaran Sidang Mahasiswa

Sistem informasi untuk pendaftaran dan pengelolaan sidang mahasiswa (KP, Proposal, Skripsi) dengan workflow approval bertingkat.

## 🚀 Fitur Utama

### 👨‍🎓 Dashboard Mahasiswa
- **Pendaftaran Multi-Jenis**: KP, Proposal, Skripsi
- **Upload Dokumen**: Multiple file upload dengan tracking individual
- **Status Real-time**: Monitoring progress approval
- **Notifikasi**: Update otomatis dari admin/pembimbing

### 👨‍💼 Dashboard Admin
- **Verifikasi Pendaftaran**: Review dan approve/reject
- **Manajemen Dokumen**: Verifikasi dokumen mahasiswa
- **Penjadwalan**: Buat jadwal sidang
- **Pengumuman**: Broadcast info ke mahasiswa

### 👨‍🏫 Dashboard Pembimbing/Dosen
- **Review Bimbingan**: Lihat mahasiswa bimbingan
- **Approval Workflow**: Setujui/tolak setelah admin approve
- **Feedback Dokumen**: Review dan beri catatan

## 🔄 Workflow System

```
Mahasiswa Daftar → Admin Review → Pembimbing Approve → Jadwal Sidang
```

### Status Tracking:
- **Review Admin**: Menunggu verifikasi admin
- **Review Pembimbing**: Admin approved, menunggu pembimbing
- **Disetujui**: Siap dijadwalkan
- **Ditolak**: Ditolak di tahap admin/pembimbing

## 📋 Jenis Sidang & Dokumen

### Kerja Praktik (6 Dokumen)
- Surat Permohonan Seminar KP
- Surat Selesai Bimbingan
- Penilaian Perusahaan
- Draft Laporan KP
- Kartu Bimbingan KP
- Surat Bebas Keuangan

### Proposal (4 Dokumen)
- Surat Permohonan Seminar Proposal
- Surat Selesai Bimbingan
- Draft Laporan Proposal
- Surat Bebas Keuangan

### Skripsi (6 Dokumen)
- Transkrip Nilai
- Sertifikat KP
- Surat Permohonan Sidang Skripsi
- Surat Selesai Bimbingan
- Draft Skripsi Lengkap
- Surat Bebas Keuangan

## 🛠️ Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Blade Templates
- **Authentication**: Custom NIM/NIP based login
- **File Storage**: Laravel Storage (local/public)
- **Notifications**: Real-time browser notifications

## ⚙️ Installation

1. **Clone Repository**
```bash
git clone https://github.com/username/sipesma.git
cd sipesma
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Configuration**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sidang
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run Migrations**
```bash
php artisan migrate
```

6. **Storage Link**
```bash
php artisan storage:link
```

7. **Start Server**
```bash
php artisan serve
```

## 👥 User Roles

### Mahasiswa
- **Login**: NIM + Password
- **Access**: `/mahasiswa/dashboard`

### Admin
- **Login**: NIP + Email + Password
- **Access**: `/admin/dashboard`

### Pembimbing/Dosen
- **Login**: NIP + Password
- **Access**: `/dosen/dashboard`

## 📊 Database Schema

### Core Tables
- `users` - User management (mahasiswa, admin, dosen)
- `sidang_registrations` - Pendaftaran sidang dengan workflow
- `document_verifications` - Tracking dokumen individual
- `jadwal_sidang` - Penjadwalan sidang
- `announcements` - Pengumuman
- `notifications` - Notifikasi real-time

### Workflow Fields
- `admin_status` - Status review admin
- `pembimbing_status` - Status review pembimbing
- `admin_notes` / `pembimbing_notes` - Catatan feedback
- `admin_reviewed_at` / `pembimbing_reviewed_at` - Timestamp review

## 🎨 UI/UX Features

- **Responsive Design**: Mobile-friendly interface
- **Orange-Brown Theme**: Consistent color scheme
- **Interactive Cards**: Clickable dashboard elements
- **Real-time Updates**: Auto-refresh notifications
- **Progress Tracking**: Visual status indicators
- **File Management**: Upload, view, re-upload capabilities

## 🔐 Security Features

- **Role-based Access**: Middleware protection
- **File Validation**: PDF only, size limits
- **CSRF Protection**: Form security
- **Input Sanitization**: XSS prevention
- **Authentication**: Session-based login

## 📱 Responsive Features

- **Mobile Navigation**: Collapsible navbar
- **Touch-friendly**: Optimized for mobile devices
- **Progressive Enhancement**: Works without JavaScript
- **Fast Loading**: Optimized assets and queries

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure production database
3. Set up file storage (S3/local)
4. Configure web server (Apache/Nginx)
5. Set up SSL certificate
6. Configure cron jobs for notifications

### Performance Optimization
- Enable Laravel caching
- Optimize database queries
- Compress assets
- Use CDN for static files

## 📞 Support

Untuk bantuan teknis atau pertanyaan, hubungi:
- **Email**: admin@stmikjabar.ac.id
- **Phone**: +62-xxx-xxxx-xxxx

## 📄 License

This project is licensed under the MIT License.

---

**SIPESMA** - Streamlining Academic Defense Registration Process