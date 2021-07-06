<?php

namespace App\Policies;

use App\Models\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseGroupPolicy
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

    public function create(Account $account, CourseGroup $courseGroup, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    public function show(Account $account, $courseGroup, $kelas)
    {   
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    public function edit(Account $account, CourseGroup $courseGroup, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    public function delete(Account $account, $courseGroup, $kelas)
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
