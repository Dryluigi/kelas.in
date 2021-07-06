<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Kelas;
use App\Models\Day;
use App\Models\Chore\Chore;
use App\Models\Chore\ChoreGroup;

class AssignedUserChore extends Model
{
    use HasFactory;

    protected $table = 'chore_user';

    public $timestamps = false;

    protected $fillable = [
        'account_id',
        'class_id',
        'chore_id',
        'day_id',
        'jam',
        'chore_group_id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }

    public function chore()
    {
        return $this->belongsTo(Chore::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function choreGroup()
    {
        return $this->belongsTo(ChoreGroup::class);
    }
}
