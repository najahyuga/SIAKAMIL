<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presences extends Model
{
    use HasFactory;

    protected $fillable = [
        'deadline',
        'courses_id',
        'created_by',
        'is_for_teacher'
    ];

    public function presenceDetails()
    {
        return $this->hasMany(PresenceDetails::class);
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'courses_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
