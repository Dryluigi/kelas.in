<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Post\Post;
use App\Models\Course\Course;
use App\Models\Course\CourseGroup;

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
        return $this->accounts()->wherePivot('role_id', env('KETUA_ID', '0'));
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'class_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'class_id', 'id');
    }

    public function courseGroups()
    {
        return $this->hasMany(CourseGroup::class, 'class_id', 'id');
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
            ->where('id', function ($query) use ($class, $account) {
            $query->select('role_id')
                    ->from('class_account')
                    ->where('class_id', $class->id)
                    ->where('account_id', $account->id);
        })->first();
    }

    public function containsUser(Account $account)
    {
        $user = DB::table('class_account')
            ->where('class_id', $this->id)
            ->where('account_id', $account->id)
            ->first();
        
        return $user != null;
    }

    public function getCourses(CourseGroup $courseGroup, Day $day)
    {
        return $this->courseGroups()
            ->where('class_id', $this->id)
            ->where('id', $courseGroup->id)
            ->courses()
            ->where('day_id', $day->id)
            ->get();
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
