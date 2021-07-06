<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Assignment;
use App\Models\Day;
use Carbon\Carbon;

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

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function activeAssignments()
    {
        $todayDatetime = Carbon::now()->toDateTimeString();

        return $this->assignments()->where('deadline', '>', $todayDatetime);
    }
}
