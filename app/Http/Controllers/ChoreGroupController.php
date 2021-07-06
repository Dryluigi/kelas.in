<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Chore\ChoreGroup;

class ChoreGroupController extends Controller
{
    public function __consruct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);
        $data['groups'] = $kelas->choreGroups()->withCount('assignedUserChores')->get();
        
        return view('chore-groups.index')->with($data);
    }
    
    public function create(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);
        
        return view('chore-groups.create')->with($data);
    }

    public function store(Request $request, Kelas $kelas)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);

        $insertedData = $request->only('nama', 'deskripsi');

        if($request->is_active) {
            $kelas->choreGroups()->update(['is_active' => ChoreGroup::CHORE_GROUP_NOT_ACTIVE]);
            $insertedData['is_active'] = ChoreGroup::CHORE_GROUP_ACTIVE;
        }

        $kelas->choreGroups()->create($insertedData);
        
        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Kelompok piket berhasil dibuat';
        
        return redirect()->route('classes.chores', $kelas)->with($data);
    }

    public function show(Kelas $kelas, ChoreGroup $choreGroup)
    {
        $data = $this->getTemplateData($kelas);
        $data['group'] = ChoreGroup::where('id', $choreGroup->id)
            ->where('class_id', $kelas->id)
            ->with('assignedUserChores', 'assignedUserChores.account', 'assignedUserChores.day')
            ->first();
        
        return view('chore-groups.show')->with($data);
    }

    public function edit(Kelas $kelas, ChoreGroup $choreGroup)
    {
        $this->authorize('edit', [$choreGroup, $kelas]);
        
        $data = $this->getTemplateData($kelas);
        $data['group'] = $choreGroup;

        return view('chore-groups.edit')->with($data);
    }

    public function update(Request $request, Kelas $kelas, ChoreGroup $choreGroup)
    {
        $this->authorize('edit', [$choreGroup, $kelas]);

        $this->validate($request, [
            'nama' => 'required',
        ]);

        $updatedData = $request->only('nama', 'deskripsi');

        if($request->is_active) {
            $kelas->choreGroups()->update(['is_active' => ChoreGroup::CHORE_GROUP_NOT_ACTIVE]);
            $updatedData['is_active'] = ChoreGroup::CHORE_GROUP_ACTIVE;
        }

        $kelas->choreGroups()->where('id', $choreGroup->id)->update($updatedData);

        $data['success'] = 'Update data berhasil';

        return redirect()->route('classes.chore-groups', $kelas)->with($data);
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
