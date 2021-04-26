<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Kelas;
use App\Models\ClassMember;

class User extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(Account::class, 'id', 'id');
    }

    public function classMembers()
    {
        return $this->hasMany(ClassMember::class, 'user_id', 'id');
    }

    // public function classes()
    // {
    //     return $this->hasManyThrough(Kelas::class, ClassMember::class);
    // }
}
