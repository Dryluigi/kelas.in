<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Kelas;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class KelasPolicy
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

    public function show(Account $account, Kelas $kelas)
    {
        return $kelas->containsUser($account);
    }

    public function addUser(Account $account, Kelas $kelas)
    {
        return $this->isLeader($account, $kelas);
    }

    public function updateUser(Account $account, Kelas $kelas)
    {
        return $this->isLeader($account, $kelas);
    }

    public function deleteUser(Account $account, Kelas $kelas)
    {
        return $this->isLeader($account, $kelas);
    }

    public function deleteClass(Account $account, Kelas $kelas)
    {
        return $this->isLeader($account, $kelas);
    }

    public function updateClass(Account $account, Kelas $kelas)
    {
        return $this->isLeader($account, $kelas);
    }

    public function createCourses(Account $account, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    public function updateCourses(Account $account, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    public function deleteCourses(Account $account, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    private function isLeader(Account $account, Kelas $kelas)
    {
        $leader = $kelas->leader()->first();

        return $leader->id === $account->id;
    }

    private function isLeaderOrSecretary(Account $account, Kelas $kelas)
    {
        $isLeader = $account->isLeader($kelas);
        $isSecretary = $account->isSecretary($kelas);

        return $isLeader || $isSecretary;
    }
}
