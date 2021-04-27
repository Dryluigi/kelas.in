<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassMember;
use Illuminate\Support\Facades\DB;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'nama',
        'deskripsi',
        'instansi',
        'cover_image',
    ];

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'class_account', 'class_id', 'account_id')
            ->withPivot('nomor_induk', 'nomor_presensi', 'role_id')
            ->withTimestamps();
    }

    public function leader()
    {
        return $this->accounts()->wherePivot('role_id', '0');
    }

    public function findClassDataByAccountId($accountId)
    {
        return DB::table('class_account')
            ->select('nomor_induk', 'nomor_presensi', 'role_id')
            ->where('account_id', $accountId)
            ->where('class_id', $this->id)
            ->first();
    }

    public function getUserRole(Account $account)
    {
        $class = $this;

        return DB::table('class_member_roles')
            ->select('role')
            ->where('id', function ($query) use ($class, $account) {
            $query->select('role_id')
                    ->from('class_account')
                    ->where('class_id', $class->id)
                    ->where('account_id', $account->id);
        })->first()->role;
    }

    public function containsUser(Account $account)
    {
        $user = DB::table('class_account')
            ->where('class_id', $this->id)
            ->where('account_id', $account->id)
            ->first();
        
        return $user != null;
    }

    public static function getAllRoles()
    {
        return DB::table('class_member_roles')->get();
    }

    public static function findByAccountId($accountId)
    {
        return self::whereIn('id', function ($query) use ($accountId) {
            $query->select('class_id')
                ->from('class_account')
                ->where('account_id', $accountId);
        })->get();
    }
}
