<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class ClassMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_induk',
        'nomor_presensi',
        'role_id',
        'user_id',
        'class_id'
    ];

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }
}
