<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSidang extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sidang';

    protected $fillable = [
        'sidang_registration_id',
        'tanggal',
        'jam',
        'ruang'
    ];

    public function sidangRegistration()
    {
        return $this->belongsTo(SidangRegistration::class);
    }
}