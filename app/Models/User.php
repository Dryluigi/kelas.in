<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Kelas;

class User extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(Account::class, 'id', 'id');
    }
}
