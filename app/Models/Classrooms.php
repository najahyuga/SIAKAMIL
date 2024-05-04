<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classrooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'semesters_id'
    ];

    public function semesters()
    {
        return $this->belongsTo(Semesters::class);
    }
}
