<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Kelas;

class ClassAccount extends Model
{
    use HasFactory;

    protected $table = 'class_account';

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }

    public function assignments()
    {
        return $this->hasManyThrough(Assignment::class, ClassAccount::class, 'class_id', 'assignment_id', 'id', 'id');
    }
}
