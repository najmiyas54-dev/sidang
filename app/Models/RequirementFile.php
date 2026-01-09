<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementFile extends Model
{
    protected $fillable = [
        'sidang_registration_id',
        'file_type',
        'file_name',
        'file_path',
        'status',
        'admin_note'
    ];

    public function sidangRegistration()
    {
        return $this->belongsTo(SidangRegistration::class);
    }
}
