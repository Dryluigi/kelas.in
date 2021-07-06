<?php

namespace App\Models\Chore;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\AssignedUserChore;

class ChoreGroup extends Model
{
    use HasFactory;

    const CHORE_GROUP_ACTIVE = 1;
    const CHORE_GROUP_NOT_ACTIVE = 0;

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'is_active',
    ];

    public function chores()
    {
        return $this->hasMany(Chore::class);
    }

    public function assignedUserChores()
    {
        return $this->hasMany(AssignedUserChore::class);
    }

    public function class()
    {
        return $this->belongsTo(Kelas::class);
    }
}
