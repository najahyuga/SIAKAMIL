<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classrooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'semesters_id'
    ];

    public function semesters()
    {
        return $this->belongsTo(Semesters::class);
    }

    public function students()
    {
        return $this->hasMany(Students::class);
    }

    public function courses()
    {
        return $this->hasMany(Courses::class, 'classrooms_id');
    }

    // Relasi ke HistoryStudentClassroom
    public function historyStudents()
    {
        return $this->hasMany(HistoryStudentClassroom::class, 'classrooms_id');
    }
}
