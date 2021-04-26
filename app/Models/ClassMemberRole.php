<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassMemberRole extends Model
{
    use HasFactory;

    protected $table = 'class_member_roles';

    protected $fillable = [
        'id',
        'role'
    ];

    public static function getRoleById($id)
    {
        return DB::table('class_member_roles')
                ->select('role')
                ->where('id', $id)
                ->first()
                ->role;
    }
}
