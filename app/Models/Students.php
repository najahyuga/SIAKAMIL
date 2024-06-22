<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'noAkteLahir',
        'nis',
        'nisn',
        'noHP',
        'agama',
        'gender',
        'dateOfBirth',
        'address',
        'status',
        'education_levels_id',
        'classrooms_id',
        'users_id',
        'files_uploads_id'
    ];

    public function education_levels()
    {
        return $this->belongsTo(EducationLevels::class);
    }

    public function classrooms()
    {
        return $this->belongsTo(Classrooms::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function files_uploads()
    {
        return $this->belongsTo(FilesUploads::class, 'files_uploads_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class, 'students_courses')
        ->withPivot('result_value', 'status')
        ->withTimestamps();
    }

    public function tasksDetails()
    {
        return $this->hasMany(TasksDetails::class);
    }

    public function getCourses() {
        return $this->belongsTo(Courses::class,'classrooms_id','classrooms_id');
    }
}
