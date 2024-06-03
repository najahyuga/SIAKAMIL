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
        'status',
        'experience',
        'education_levels_id',
        'users_id',
        'files_uploads_id'
    ];

    public function education_levels()
    {
        return $this->belongsTo(EducationLevels::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files_uploads()
    {
        return $this->hasOne(FilesUploads::class);
    }

    public function courses()
    {
        return $this->hasMany(Courses::class);
    }
}
