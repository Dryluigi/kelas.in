<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Course\Course;
use App\Models\Course\CourseGroup;
use App\Models\Day;

class CourseController extends Controller
{
    const COURSE_GROUP_ACTIVE = 1;
    const COURSE_GROUP_NOT_ACTIVE = 0;
    
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request, Kelas $kelas)
    {
        extract($request->query());

        $data = $this->getTemplateData($kelas);
        $data['groups'] = $kelas->courseGroups()->get();
        $data['days'] = Day::all();
        
        if(isset($day_id) && isset($course_group_id)) {
            $day = Day::find($day_id);
            if($day)
                $data['courses'] = CourseGroup::find($course_group_id)->getCoursesByDay($day);
            else
                $data['courses'] = null;
        } else {
            if($data['groups']->count()) {
                $day = Day::find(0);
                $data['courses'] = CourseGroup::find($data['groups'][0]->id)->getCoursesByDay($day);
            } else {
                $data['courses'] = null;
            }
        }
        
        return view('courses.index')->with($data);
    }

    public function create(Kelas $kelas)
    {
        $this->authorize('createCourses', $kelas);

        $data = $this->getTemplateData($kelas);
        $data['groups'] = $kelas->courseGroups()->get();
        $data['days'] = Day::all();
        
        return view('courses.create')->with($data);
    }

    public function createGroup(Kelas $kelas)
    {
        $this->authorize('createCourses', $kelas);
        
        $data = $this->getTemplateData($kelas);
        
        return view('courses.createGroup')->with($data);
    }

    public function store(Kelas $kelas, Request $request)
    {
        $this->authorize('createCourses', $kelas);
        
        $this->validate($request, [
            'nama' => 'required',
        ]);

        $course = $kelas->courses()->create($request->only(
            'nama', 
            'pengajar', 
            'day_id', 
            'start', 
            'end',
            'course_group_id',
        ));

        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Mata pelajaran berhasil dibuat';

        return redirect()->route('classes.courses', $kelas)->with($data);
    }

    public function storeGroup(Kelas $kelas, Request $request)
    {
        $this->authorize('createCourses', $kelas);
        
        $this->validate($request, [
            'nama' => 'required',
        ]);
        
        $is_active = $request->is_active != null ? self::COURSE_GROUP_ACTIVE : self::COURSE_GROUP_NOT_ACTIVE;
        $input = $request->only('nama', 'deskripsi');
        $input['is_active'] = $is_active;
        
        if($is_active) {
            $kelas->courseGroups()->update(['is_active', self::COURSE_GROUP_NOT_ACTIVE]);
        }

        $kelas->courseGroups()->create($input);
        
        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Kelompok mata pelajaran berhasil dibuat';

        return redirect()->route('classes.courses', $kelas)->with($data);
    }

    public function show(Kelas $kelas, Course $course)
    {
        $data = $this->getTemplateData($kelas);
        $data['course'] = $kelas->courses()->where('id', $course->id)->first();

        if($data['course']) {
            $data['assignments'] = $data['course']->assignments()->get();
        }
        
        return view('courses.show')->with($data);
    }

    public function edit(Kelas $kelas, Course $course)
    {
        $this->authorize('updateCourses', $kelas);

        $course = $kelas->courses()->where('id', $course->id)->first();

        $data = $this->getTemplateData($kelas);
        $data['groups'] = $kelas->courseGroups()->get();
        $data['days'] = Day::all();
        $data['course'] = $course;
        
        return view('courses.edit')->with($data);
    }

    public function update(Request $request, Kelas $kelas, Course $course)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);

        $course->update($request->only('nama', 'pengajar', 'day_id', 'start', 'end', 'course_group_id'));
        
        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Data mata pelajaran berhasil di-update';

        return redirect()->route('classes.courses', $kelas)->with($data);
    }

    public function destroy(Kelas $kelas, Course $course)
    {
        $this->authorize('delete', [$course, $kelas]);
        
        $course = $kelas->courses()->where('id', $course->id)->first();

        $course->delete();

        $data = $this->getTemplateData($kelas);

        return redirect()->route('classes.courses', $kelas)->with($data);
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
