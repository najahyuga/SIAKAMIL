<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'teachers_id',
        'classrooms_id',
        'category_courses_id'
    ];

    public function teachers()
    {
        return $this->belongsTo(Teachers::class);
    }

    public function classrooms()
    {
        return $this->belongsTo(Classrooms::class);
    }

    public function category_courses()
    {
        return $this->belongsTo(CategoryCourses::class);
    }

    public function students()
    {
        return $this->belongsToMany(Students::class, 'students_courses')
        ->withPivot('result_value', 'status')
        ->withTimestamps();
    }
}
