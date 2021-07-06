<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\ClassMember;
use App\Models\Kelas;
use App\Models\ClassAccount;
use App\Models\Assignment;
use App\Models\Post\Post;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }

    public function classes()
    {
        return $this->belongsToMany(Kelas::class, 'class_account', 'account_id', 'class_id')
            ->withPivot('nomor_induk', 'nomor_presensi', 'role_id')
            ->withTimestamps();
    }

    public function class(Kelas $kelas)
    {
        return $this->classes()->where('class_id', $kelas->id);
    }

    public function classAccounts()
    {
        return $this->hasMany(ClassAccount::class);
    }

    public function isLeader(Kelas $kelas)
    {
        $user = $this->getUserByRoleAndClass($kelas, env('KETUA_ID', '0'));

        return $user != null;
    }

    public function isSecretary(Kelas $kelas)
    {
        $user = $this->getUserByRoleAndClass($kelas, env('SEKRETARIS_ID', '2'));

        return $user != null;
    }

    public function isFinancialManager(Kelas $kelas)
    {
        $user = $this->getUserByRoleAndClass($kelas, env('BENDAHARA_ID', '3'));

        return $user != null;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function assignments()
    {
        $assignments = Assignment::join('courses', 'assignments.course_id', 'courses.id')
            ->join('classes', 'courses.class_id', 'classes.id')
            ->join('class_account', 'class_account.class_id', 'classes.id')
            ->join('accounts', 'class_account.account_id', 'accounts.id')
            ->where('accounts.id', $this->id)
            ->get();

        return $assignments;
    }

    private function getUserByRoleAndClass(Kelas $kelas, $role_id)
    {
        return $this->classes()
            ->where('class_id', $kelas->id)
            ->wherePivot('role_id', $role_id)
            ->first();
    }
}
