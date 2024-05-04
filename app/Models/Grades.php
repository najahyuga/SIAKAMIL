<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
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
}
