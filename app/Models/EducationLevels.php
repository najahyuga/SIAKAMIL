<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevels extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function teachers(){
        return $this->hasMany(Teachers::class);
    }

    public function students() {
        return $this->hasMany(Students::class);
    }

}
