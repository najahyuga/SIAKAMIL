<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'file',
        'result',
        'students_id',
        'tasks_id',
    ];

    public function tasks()
    {
        return $this->belongsTo(Tasks::class, 'tasks_id');
    }

    public function students()
    {
        return $this->belongsTo(Students::class, 'students_id');
    }
}
