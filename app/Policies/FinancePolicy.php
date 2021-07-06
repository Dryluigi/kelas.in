<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Kelas;
use App\Models\Finance\Finance;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinancePolicy
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
        return $this->isLeaderOrFinancialManager($account, $kelas);
    }

    public function edit(Account $account, Finance $finance, Kelas $kelas)
    {
        return $this->isLeaderOrFinancialManager($account, $kelas);
    }

    public function delete(Account $account, Finance $finance, Kelas $kelas)
    {
        return $this->isLeaderOrFinancialManager($account, $kelas);
    }

    private function isLeaderOrFinancialManager(Account $account, Kelas $kelas)
    {
        $isLeader = $account->isLeader($kelas);
        $isFinancialManager = $account->isFinancialManager($kelas);

        return $isLeader || $isFinancialManager;
    }
}
