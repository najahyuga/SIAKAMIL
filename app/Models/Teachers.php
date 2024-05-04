<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'gender',
        'dateOfBirth',
        'image',
        'status',
        'education_levels_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function education_levels()
    {
        return $this->belongsTo(EducationLevels::class);
    }

    public function courses()
    {
        return $this->hasMany(Courses::class);
    }
}
