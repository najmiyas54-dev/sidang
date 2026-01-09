<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sidang_registration_id',
        'document_type',
        'document_name',
        'file_path',
        'status',
        'admin_notes',
        'verified_at',
        'verified_by'
    ];

    protected $casts = [
        'verified_at' => 'datetime'
    ];

    public function sidangRegistration()
    {
        return $this->belongsTo(SidangRegistration::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}