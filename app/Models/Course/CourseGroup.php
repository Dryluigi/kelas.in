<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Day;

class CourseGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'course_group_id', 'id');
    }

    public function getCoursesByDay(Day $day)
    {
        return $this->courses()->where('day_id', $day->id)->get();
    }
}
