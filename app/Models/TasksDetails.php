<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'result',
        'tasks_id'
    ];

    public function tasks()
    {
        return $this->belongsTo(Tasks::class);
    }

    public function student()
    {
        return $this->belongsTo(Students::class);
    }
}
