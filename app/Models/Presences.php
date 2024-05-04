<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presences extends Model
{
    use HasFactory;

    protected $fillable = [
        'deadline',
        'courses_id'
    ];

    public function courses()
    {
        return $this->belongsTo(Courses::class);
    }
}
