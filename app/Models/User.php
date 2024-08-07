<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teacher()
    {
        return $this->hasOne(Teachers::class, 'users_id');
    }

    public function student()
    {
        return $this->hasOne(Students::class, 'users_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'users_roles');
    }

    // Cek jik users memiliki peran tertentu
    public function hasRole($level)
    {
        return $this->roles()->where('level', $level)->exists();
    }

    public function formSiswa()
    {
        return $this->hasOne(FormSiswa::class, 'users_id');
    }
}
