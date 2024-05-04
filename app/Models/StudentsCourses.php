<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsCourses extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_value',
        'status',
        'students_id',
        'courses_id'
    ];

    public function students()
    {
        return $this->belongsToMany(Students::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class);
    }
}
