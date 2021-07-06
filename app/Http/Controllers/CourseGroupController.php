<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Course\CourseGroup;

class CourseGroupController extends Controller
{
    const COURSE_GROUP_ACTIVE = 1;
    const COURSE_GROUP_NOT_ACTIVE = 0;
    
    public function index(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);

        $data['groups'] = $this->getIndexGroupsData($kelas);
        
        return view('course-groups.index')->with($data);
    }

    public function create(Kelas $kelas)
    {
        $this->authorize('createCourses', $kelas);
        
        $data = $this->getTemplateData($kelas);
        
        return view('course-groups.create')->with($data);
    }
    
    public function store(Request $request, Kelas $kelas)
    {
        $this->authorize('createCourses', $kelas);
        
        $this->validate($request, [
            'nama' => 'required',
        ]);
        
        $is_active = $this->convertIsActiveInput($request->is_active);
        $input = $request->only('nama', 'deskripsi');
        $input['is_active'] = $is_active;
        
        if($is_active) {
            $kelas->courseGroups()->update(['is_active' => self::COURSE_GROUP_NOT_ACTIVE]);
        }

        $kelas->courseGroups()->create($input);
        
        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Kelompok mata pelajaran berhasil dibuat';

        return redirect()->route('classes.courses', $kelas)->with($data);
    }

    public function show(Kelas $kelas, CourseGroup $courseGroup)
    {   
        $this->authorize('show', [$courseGroup, $kelas]);
        
        $data = $this->getTemplateData($kelas);
        $data['group'] = $this->getShowGroupData($kelas, $courseGroup);
        
        return view('course-groups.show')->with($data);
    }

    public function edit(Kelas $kelas, CourseGroup $courseGroup)
    {
        $this->authorize('edit', $courseGroup);

        $data = $this->getTemplateData($kelas);
        $data['group'] = $courseGroup;

        return view('course-groups.edit')->with($data);
    }

    public function update(Request $request, Kelas $kelas, CourseGroup $courseGroup)
    {
        $this->authorize('edit', $courseGroup);
        
        $this->validate($request, [
            'nama' => 'required',
        ]);

        $is_active = $this->convertIsActiveInput($request->is_active);
        $input = $request->only('nama', 'deskripsi');
        $input['is_active'] = $is_active;
        
        if($is_active) {
            $kelas->courseGroups()->update(['is_active' => self::COURSE_GROUP_NOT_ACTIVE]);
        }

        $courseGroup->update($input);

        $data = $this->getTemplateData($kelas);
        $data['groups'] = $this->getIndexGroupsData($kelas);
        $data['success'] = 'Kelompok mata pelajaran berhasil diperbarui';

        return view('course-groups.index')->with($data);
    }

    public function destroy(Request $request, Kelas $kelas, CourseGroup $courseGroup)
    {
        $this->authorize('delete', [$courseGroup, $kelas]);
        
        $kelas->courseGroups()->where('id', $courseGroup->id)->delete();

        return back()->with(['success' => 'Hapus mata pelajaran berhasil']);
    }

    private function getTemplateData(Kelas $kelas)
    {
        return [
            'user' => auth()->user(),
            'class' => $kelas,
            'role' => $kelas->getUserRole(auth()->user()),
        ];
    }

    private function convertIsActiveInput($is_active)
    {
        return $is_active != null ? self::COURSE_GROUP_ACTIVE : self::COURSE_GROUP_NOT_ACTIVE;
    }

    private function getShowGroupData(Kelas $kelas, CourseGroup $courseGroup)
    {
        return $kelas->courseGroups()
            ->where('id', $courseGroup->id)
            ->with(['courses', 'courses.day', 'courses.assignments'])
            ->first();
    }

    private function getIndexGroupsData(Kelas $kelas)
    {
        return $kelas->courseGroups()->withCount('courses')->get();
    }
}
