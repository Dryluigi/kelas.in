<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Kelas;
use App\Models\Chore\Chore;

class AssignedUserChoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function destroy(Request $request, Kelas $kelas, Chore $userChore, Account $account)
    {
        $this->authorize('delete', [$userChore, $kelas]);
        
        $userChore->accounts()->detach($account);

        // $data = $this->getTemplateData($kelas);
        // $data['success'] = 'Data piket anggota berhasil dihapus';
        
        return back()->with(['success' => 'Data piket anggota berhasil dihapus']);

    }

    private function getTemplateData(Kelas $kelas)
    {
        return [
            'user' => auth()->user(),
            'class' => $kelas,
            'role' => $kelas->getUserRole(auth()->user()),
        ];
    }
}
