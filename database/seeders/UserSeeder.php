<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Mahasiswa
        User::create([
            'name' => 'Ahmad Mahasiswa',
            'email' => 'mahasiswa@test.com',
            'nim' => '12345678',
            'prodi' => 'Teknik Informatika',
            'semester' => 8,
            'no_hp' => '081234567890',
            'role' => 'mahasiswa',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'Siti Mahasiswa',
            'email' => 'siti@test.com', 
            'nim' => '87654321',
            'prodi' => 'Sistem Informasi',
            'semester' => 6,
            'no_hp' => '081987654321',
            'role' => 'mahasiswa',
            'password' => Hash::make('password123')
        ]);

        // Pembimbing
        User::create([
            'name' => 'Dr. Dosen Pembimbing',
            'email' => 'pembimbing@test.com',
            'nip' => '198501012010011001',
            'role' => 'pembimbing',
            'password' => Hash::make('pembimbing123')
        ]);

        // Admin
        User::create([
            'name' => 'Admin TU',
            'email' => 'admin@test.com',
            'nip' => '198001012005011001',
            'role' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        // Sample Announcements
        \App\Models\Announcement::create([
            'title' => 'Pengumuman Jadwal Sidang',
            'content' => 'Jadwal sidang periode ini telah tersedia. Silakan cek jadwal masing-masing di menu sidang.',
            'type' => 'info',
            'is_active' => true
        ]);

        \App\Models\Announcement::create([
            'title' => 'Batas Waktu Pendaftaran',
            'content' => 'Batas waktu pendaftaran sidang adalah tanggal 31 Januari 2026. Pastikan semua berkas sudah lengkap.',
            'type' => 'warning',
            'is_active' => true
        ]);
    }
}