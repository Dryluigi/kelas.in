<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Account;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'leader']);
    }

    public function index(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);
        
        return view('settings.index')->with($data);
    }

    public function editLeader(Kelas $kelas)
    {
        $members = $kelas->accounts()->get();
        $members = $members->filter(function ($value, $key) {
            return $value->id != auth()->user()->id;
        });

        $data = $this->getTemplateData($kelas);
        $data['members'] = $members;
        
        return view('settings.editLeader')->with($data);
    }

    public function updateLeader(Request $request, Kelas $kelas)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        
        $newLeader = Account::where('email', $request->email)->first();

        $kelas->accounts()
            ->updateExistingPivot($newLeader->id, [
                'role_id' => env('KETUA_ID', '0')
        ]);

        $kelas->accounts()
            ->updateExistingPivot(auth()->user()->id, [
                'role_id' => env('ANGGOTA_ID', '1')
        ]);

        $data = $this->getTemplateData($kelas);

        return redirect()->route('classes.show', $data['class'])->with($data);
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
