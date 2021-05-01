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

        $data = $this->getTemplateData($kelas);
        
        return view('classes.show')->with($data);
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

        $data = $data = $this->getTemplateData($kelas);
        $data['members'] = $members;
        
        return view('classes.users.users')->with($data);
    }

    public function invite(Kelas $kelas)
    {
        $roles = Kelas::getAllRoles();
        $user = auth()->user();

        $data = $this->getTemplateData($kelas);
        $data['roles'] = $roles;
        
        return view('classes.users.invite')->with($data);
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

            $data = $this->getTemplateData($kelas);
            $data['success'] = 'Berhasil menambahkan anggota';
            
            return redirect()->route('classes.users', $kelas)->with($data);

        } else {
            return back()->with(['fail' => 'Email tidak ditemukan.']);
        }
    }

    public function editUser(Kelas $kelas, Account $account)
    {
        $roles = Kelas::getAllRoles();
        $user = auth()->user();

        $data = $this->getTemplateData($kelas);

        $data['targetUser'] = $account;
        $data['class'] = $data['targetUser']->classes()->where('account_id', $account->id)->first();
        $data['roles'] = $roles;
        
        return view('classes.users.edit')->with($data);
    }

    public function updateUser(Kelas $kelas, Account $account, Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required',
        ]);

        $kelas->accounts()
            ->where('account_id', $account->id)
            ->update($request->only('nomor_induk', 'nomor_presensi', 'role_id'));

        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Berhasil update data anggota';
        
        return redirect()->route('classes.users', $kelas)->with($data);
    }

    public function deleteUser(Kelas $kelas, Account $account, Request $request)
    {
        $this->authorize('deleteUser', $kelas);

        $account->posts()->update([
            'user_id' => null,
        ]);

        $kelas->accounts()->detach($account);

        return back()->with(['success' => 'Anggota berhasil dihapus']);
    }

    public function showUser(Kelas $kelas, Account $account)
    {
        $userClass = $kelas->accounts()
            ->where('account_id', $account->id)
            ->first();
        
        $data = $this->getTemplateData($kelas);
        $data['userClass'] = $userClass;
        
        return view('classes.users.show')->with($data);
    }

    public function editProfile(Kelas $kelas)
    {
        $userClass = $kelas->accounts()
            ->where('account_id', auth()->user()->id)
            ->first();
        
        $data = $this->getTemplateData($kelas);
        $data['userClass'] = $userClass;
        
        return view('classes.users.editProfile')->with($data);
    }

    public function updateProfile(Request $request, Kelas $kelas)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);

        auth()->user()
            ->user()
            ->update($request->only('nama', 'alamat', 'nomor_telepon'));

        $kelas->accounts()
            ->updateExistingPivot(auth()->user()->id, $request->only('nomor_induk', 'nomor_presensi'));
        
        $data = $this->getTemplateData($kelas);

        return redirect()->route('classes.users.show', [$kelas, auth()->user()])->with($data);
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
