<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryStudentClassroom extends Model
{
    use HasFactory;

    protected $table = 'history_student_classroom';

    protected $fillable = [
        'classrooms_id',
        'students_id',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classrooms::class, 'classrooms_id');
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'students_id');
    }
}
