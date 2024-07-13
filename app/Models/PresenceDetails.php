<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'presences_id',
        'students_id',
        'marked_by_teacher',
        'presence_date'
    ];

    public function presences()
    {
        return $this->belongsTo(Presences::class);
    }

    public function students()
    {
        return $this->belongsTo(Students::class, 'students_id');
    }
}
