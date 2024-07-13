<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'teachers_id',
        'classrooms_id'
    ];

    public function teachers()
    {
        return $this->belongsTo(Teachers::class, 'teachers_id');
    }

    public function classrooms()
    {
        return $this->belongsTo(Classrooms::class, 'classrooms_id');
    }

    public function masterCourses()
    {
        return $this->belongsToMany(MasterCourses::class, 'course_master_course', 'course_id', 'master_course_id');
    }

    public function students()
    {
        return $this->belongsToMany(Students::class, 'students_courses')
        ->withPivot('result_value', 'status')
        ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }

    public function presence()
    {
        return $this->hasMany(Presences::class);
    }

    public function courseMaster()
    {
        return $this->hasMany(CourseMasterCourse::class,'course_id','id');
    }
}
