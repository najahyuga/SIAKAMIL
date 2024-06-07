<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCourses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'master_category_courses_id',
    ];

    public function master_category_course()
    {
        return $this->belongsTo(MasterCategoryCourses::class, 'master_category_courses_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class, 'course_master_course', 'master_course_id', 'course_id');
    }
}
