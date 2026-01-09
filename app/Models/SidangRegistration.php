<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_sidang',
        'judul',
        'dosen_pembimbing',
        'file_persyaratan',
        'status',
        'keterangan',
        'tempat_kp',
        'durasi',
        'bidang_penelitian',
        'dosen_pembimbing_2',
        'progress',
        'admin_status',
        'pembimbing_status',
        'admin_notes',
        'pembimbing_notes',
        'admin_reviewed_at',
        'pembimbing_reviewed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->hasOne(JadwalSidang::class);
    }
}