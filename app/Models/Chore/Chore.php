<?php

namespace App\Models\Chore;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Chore extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tugas',
        'chore_group_id',
    ];

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'chore_user', 'chore_id', 'account_id')
            ->withPivot('class_id', 'day_id', 'jam', 'chore_group_id');
    }

    public function choreGroup()
    {
        return $this->belongsTo(ChoreGroup::class);
    }
}
