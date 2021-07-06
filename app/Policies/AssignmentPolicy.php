<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Assignment;
use App\Models\Kelas;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
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

    public function create(Account $account, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    // public function show(Account $account, $courseGroup, $kelas)
    // {   
    //     return $this->isLeaderOrSecretary($account, $kelas);
    // }

    public function edit(Account $account, Assignment $assignment, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    public function update(Account $account, Assignment $assignment, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    public function delete(Account $account, Assignment $assignment, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    private function isLeaderOrSecretary(Account $account, $kelas)
    {
        $isLeader = $account->isLeader($kelas);
        $isSecretary = $account->isSecretary($kelas);

        return $isLeader || $isSecretary;
    }
}
