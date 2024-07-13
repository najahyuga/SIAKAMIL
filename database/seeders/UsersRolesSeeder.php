<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allRoles = Roles::all();

        // Loop semua pengguna
        User::all()->each(function ($user) use ($allRoles) {
            // Atur peran untuk setiap pengguna
            if ($user->id <= 5) {
                // Pengguna dengan ID 1 hingga 5 akan memiliki peran admin dan guru
                $roles = $allRoles->whereIn('level', ['admin', 'guru'])->pluck('id');
            } elseif ($user->id <= 10) {
                // Pengguna dengan ID 6 hingga 10 akan memiliki peran guru
                $roles = $allRoles->where('level', 'guru')->pluck('id');
            } elseif ($user->id <= 25) {
                // Pengguna dengan ID 11 hingga 25 akan memiliki peran siswa
                $roles = $allRoles->where('level', 'siswa')->pluck('id');
            } else {
                // Pengguna dengan ID 26 hingga lebih akan memiliki peran calonSiswa
                $roles = $allRoles->where('level', 'calonSiswa')->pluck('id');
            }

            // Lampirkan peran ke pengguna
            $user->roles()->attach($roles);
        });
    }
}
