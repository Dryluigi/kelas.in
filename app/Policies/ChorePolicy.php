<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Kelas;
use App\Models\Chore\Chore;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChorePolicy
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

    public function edit(Account $account, Chore $chore, Kelas $kelas)
    {
        return $this->isLeaderOrSecretary($account, $kelas);
    }

    public function delete(Account $account, Chore $chore, Kelas $kelas)
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
