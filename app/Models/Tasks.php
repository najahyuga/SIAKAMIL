<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'deadline',
        'file',
        'courses_id',
        'master_courses_id',
    ];

    public function courses()
    {
        return $this->belongsTo(Courses::class);
    }

    public function tasksDetails()
    {
        return $this->hasMany(TasksDetails::class);
    }

    public function masterCourses()
    {
        return $this->belongsTo(MasterCourses::class, 'master_courses_id');
    }
}
