<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Kelas;
use App\Models\Course\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(Account $account, Course $course, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    private function isLeaderOrSecretary($account, $kelas)
    {
        $isLeader = $account->isLeader($kelas);
        $isSecretary = $account->isSecretary($kelas);

        return $isLeader || $isSecretary;
    }
}
