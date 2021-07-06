<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceType extends Model
{
    use HasFactory;

    const PEMASUKAN_ID = 0;
    const PENGELUARAN_ID = 1;

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
