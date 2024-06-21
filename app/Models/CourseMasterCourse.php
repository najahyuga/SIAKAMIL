<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMasterCourse extends Model
{
    use HasFactory;
    protected $table = 'course_master_course';

    protected $fillable = [
        'course_id',
        'master_course_id',
    ];

    // Relationships if needed

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function masterCourse()
    {
        return $this->belongsTo(MasterCourses::class);
    }
}
