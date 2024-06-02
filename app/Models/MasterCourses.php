<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCourses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'master_category_courses_id',
    ];

    public function masterCategoryCourse()
    {
        return $this->belongsTo(MasterCategoryCourses::class);
    }
}
