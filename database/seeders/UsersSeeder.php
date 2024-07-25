<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(30)->create();

        $user = User::create([
            'username'  => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => 'password'
        ]);

        $roles = Roles::whereIn('level', ['admin', 'guru', 'siswa'])->pluck('id');

        $user->roles()->attach($roles);
    }
}
