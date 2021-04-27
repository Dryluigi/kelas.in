<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Account;
use App\Models\ClassMemberRole;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function show(Kelas $kelas) 
    {
        $this->authorize('show', $kelas);
        
        $accountClassData = $kelas->findClassDataByAccountId(auth()->user()->id);
        $user = auth()->user();
        
        return view('classes.show')->with([
            'user' => $user,
            'class' => $kelas,
            'role' => $kelas->getUserRole($user),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:255',
            'instansi' => 'max:255',
        ]);
        
        $kelas = Kelas::create($request->only('nama', 'deskripsi', 'instansi'));

        $kelas->accounts()->attach(auth()->user(), [
            'role_id' => 0
        ]);

        return redirect()->route('profile.classes');
    }

    public function create()
    {
        return view('classes.create')->with([
            'user' => auth()->user(),
        ]);
    }

    public function users(Kelas $kelas)
    {
        $user = auth()->user();
        $members = $kelas->accounts()->with('user')->get();
        foreach($members as $member) {
            $role_id = $member->pivot->role_id;
            $member->pivot->role = ClassMemberRole::getRoleById($role_id);
        }
        
        return view('classes.users')->with([
            'user' => auth()->user(),
            'class' => $kelas,
            'role' => $kelas->getUserRole($user),
            'members' => $members,
        ]);
    }

    public function invite(Kelas $kelas)
    {
        $roles = Kelas::getAllRoles();
        $user = auth()->user();
        
        return view('classes.invite')->with([
            'user' => auth()->user(),
            'class' => $kelas,
            'role' => $kelas->getUserRole($user),
            'roles' => $roles,
        ]);
    }

    public function addUser(Kelas $kelas, Request $request)
    {
        $this->authorize('addUser', $kelas);
        
        $this->validate($request, [
            'email' => 'required|email',
            'role_id' => 'required',
        ]);

        $user = Account::where('email', $request->email)->first();

        if($user) {
            $user->classes()->attach($kelas, [
                'nomor_induk' => $request->nomor_induk,
                'nomor_presensi' => $request->nomor_presensi,
                'role_id' => $request->role_id,
            ]);
            
            return redirect()->route('classes.users', $kelas)->with([
                'user' => auth()->user(),
                'class' => $kelas,
            ]);

        } else {
            return back()->with(['fail' => 'Email tidak ditemukan.']);
        }
    }

    public function deleteUser(Kelas $kelas, Account $account, Request $request)
    {
        $this->authorize('deleteUser', $kelas);
        
        dd('t e r d e l e t e');
    }
}
