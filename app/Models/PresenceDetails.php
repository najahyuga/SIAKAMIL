<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'presences_id'
    ];

    public function presences()
    {
        return $this->belongsTo(Presences::class);
    }
}
