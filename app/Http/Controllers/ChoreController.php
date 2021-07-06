<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Account;
use App\Models\Day;
use App\Models\Chore\Chore;
use App\Models\Chore\ChoreGroup;

class ChoreController extends Controller
{
    public function __consruct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(Request $request, Kelas $kelas)
    {
        $chore_group_id = $request->query('chore_group_id');
        $day_id = $request->query('day_id');
        $data = $this->getTemplateData($kelas);

        if($chore_group_id !== null && $day_id !== null) {
            $data['assignedUserChores'] = $kelas->assignedUserChores()
            ->with([
                'account', 
                'chore', 
                'day',
                'account.user'
            ])
            ->where('chore_group_id', $chore_group_id)
            ->where('day_id', $day_id)
            ->get();    
        } else {
            $assignedUserChores = $kelas->assignedUserChores()
            ->with([
                'account', 
                'chore', 
                'day',
                'account.user',
                'choreGroup',
            ])
            ->get();
            $assignedUserChores = $assignedUserChores->filter( function ($assignedUserChore) {
                return $assignedUserChore->choreGroup->is_active === ChoreGroup::CHORE_GROUP_ACTIVE;
            });
            $data['assignedUserChores'] = $assignedUserChores;
        }

        $data['groups'] = $kelas->choreGroups()->get();
        $data['days'] = Day::all();

        // dd($data);

        return view('chores.index')->with($data);
    }

    public function create(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);
        $data['groups'] = $kelas->choreGroups()->get();
        $data['days'] = Day::all();

        return view('chores.create')->with($data);
    }

    public function store(Request $request, Kelas $kelas)
    {
        $this->validate($request, [
            'tugas' => 'required',
            'day_id' => 'required',
            'chore_group_id' => 'required',
        ]);

        $chore = Chore::create($request->only('tugas', 'chore_group_id'));

        return redirect()->route('classes.chores', $kelas)->with(['success' => 'Tugas piket berhasil dibuat']);
    }

    public function assignUser(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);
        $data['members'] = $kelas->accounts()->get();
        $data['chores'] = $kelas->chores()->get();
        $data['groups'] = $kelas->choreGroups()->get();
        $data['days'] = Day::all();
        
        return view('chores.assign-user')->with($data);
    }

    public function assign(Request $request, Kelas $kelas)
    {
        $this->validate($request, [
            'account_id' => 'required',
            'day_id' => 'required',
            'chore_id' => 'required',
        ]);

        $chore = $kelas->chores()->where('chores.id', $request->chore_id)->first();
        $user = $kelas->accounts()->where('account_id', $request->account_id)->first();

        if($chore && $user) {
            $pivotData = $request->only('day_id', 'jam', 'chore_group_id');
            $pivotData['class_id'] = $kelas->id;

            try {
                $chore->accounts()->attach($user, $pivotData);

            } catch (\Illuminate\Database\QueryException $e) {
                if ($e->errorInfo[0] === "23000") {
                    $chore->accounts()->updateExistingPivot($user, $pivotData);
                } else {
                    return back()->with(['fail' => 'TErjadi kesalahan!']);
                }

            }

            $data = $this->getTemplateData($kelas);
            $data['success'] = 'Anggota berhasil di-assign';

            return redirect()->route('classes.chores', $kelas)->with($data);
        } else {
            return back()->with(['fail' => 'Tugas piket tidak ditemukan!']);
        }
    }

    // public function destroy(Request $request, Kelas $kelas, Chore $chore)
    // {
    //     $this->authorize('delete', [$chore, $kelas]);


    // }

    private function getTemplateData(Kelas $kelas)
    {
        return [
            'user' => auth()->user(),
            'class' => $kelas,
            'role' => $kelas->getUserRole(auth()->user()),
        ];
    }
}
