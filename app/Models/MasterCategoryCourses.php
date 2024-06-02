<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCategoryCourses extends Model
{
    use HasFactory;

    protected $fillabel = ['name'];

    public function masterCourses()
    {
        return $this->hasMany(MasterCourses::class);
    }
}
