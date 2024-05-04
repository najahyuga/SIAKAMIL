<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semesters extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'startDate',
        'endDate',
        'education_levels_id'
    ];

    public function education_levels()
    {
        return $this->belongsTo(EducationLevels::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classrooms::class);
    }
}
