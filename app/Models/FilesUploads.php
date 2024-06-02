<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesUploads extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    public function teachers()
    {
        return $this->hasOne(Teachers::class);
    }

    public function students()
    {
        return $this->hasOne(Students::class);
    }
}
