<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'pengajar',
        'day_id',
        'start',
        'end',
        'course_group_id',
        'class_id'
    ];

    public function courseGroup()
    {
        return $this->belongsTo(CourseGroup::class, 'course_group_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }
}
