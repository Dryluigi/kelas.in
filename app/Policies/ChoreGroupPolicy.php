<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Kelas;
use App\Models\Chore\ChoreGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChoreGroupPolicy
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

    public function edit(Account $account, ChoreGroup $choreGroup, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    private function isLeaderOrSecretary(Account $account, Kelas $kelas)
    {
        $isLeader = $account->isLeader($kelas);
        $isSecretary = $account->isSecretary($kelas);

        return $isLeader || $isSecretary;
    }
}
