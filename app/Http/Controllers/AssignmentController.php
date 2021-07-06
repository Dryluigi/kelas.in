<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);
        $data['activeAssignments'] = $kelas->activeAssignments()->get();
        $data['oldAssignments'] = $kelas->oldAssignments()
            ->orderBy('deadline', 'DESC')
            ->limit(5)
            ->get();
        $data['activeCourseGroup'] = $kelas->activeCourseGroup()->first();
        
        return view('assignments.index')->with($data);
    }

    public function create(Kelas $kelas)
    {
        $this->authorize('create', [Assignment::class, $kelas]);
        
        $data = $this->getTemplateData($kelas);
        $data['courses'] = $kelas->courses()->get();
        
        return view('assignments.create')->with($data);
    }

    public function store(Request $request, Kelas $kelas)
    {
        $this->validate($request, [
            'judul' => 'required',
            'course_id' => 'required',
        ]);

        $course = $kelas->courses()->where('id', $request->course_id)->first();

        if($course) {
            $course->assignments()->create($request->only(
                'judul', 
                'deskripsi', 
                'deadline',
            ));

            $data = $this->getTemplateData($kelas);
            $data['success'] = 'Tugas berhasil ditambahkan';

            return redirect()->route('classes.assignments', $kelas)->with($data);

        } else {
            return back()->with(['fail' => 'Gagal menambahkan tugas. Mata pelajaran tidak ditemukan!']);
        }
    }

    public function show(Kelas $kelas, Assignment $assignment)
    {
        dd('this is show');
    }

    public function edit(Kelas $kelas, Assignment $assignment)
    {
        $this->authorize('edit', [$assignment, $kelas]);
        
        $data = $this->getTemplateData($kelas);
        $data['assignment'] = $assignment;
        $data['courses'] = $kelas->courses()->get();

        return view('assignments.edit')->with($data);
    }

    public function update(Request $request, Kelas $kelas, Assignment $assignment)
    {
        $this->authorize('update', [$assignment, $kelas]);
        
        $this->validate($request, [
            'judul' => 'required',
            'course_id' => 'required',
        ]);
        
        $course = $kelas->courses()->where('id', $request->course_id)->first();

        if($course) {
            $course->assignments()->update($request->only(
                'judul', 
                'deskripsi', 
                'deadline',
            ));

            $data = $this->getTemplateData($kelas);
            $data['success'] = 'Tugas berhasil diperbarui';

            return redirect()->route('classes.assignments', $kelas)->with($data);

        } else {
            return back()->with(['fail' => 'Gagal memperbarui tugas. Mata pelajaran tidak ditemukan!']);
        }
    }

    public function destroy(Request $request, Kelas $kelas, Assignment $assignment)
    {
        $this->authorize('delete', [$assignment, $kelas]);
        
        $assignment->delete();

        return back()->with(['success' => 'Tugas berhasil dihapus']);
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
