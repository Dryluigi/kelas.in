<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'jumlah',
        'finance_type_id',
        'class_id',
    ];

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }

    public function financeType()
    {
        return $this->belongsTo(FinanceType::class);
    }
}
