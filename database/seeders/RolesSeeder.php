<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'guru', 'siswa', 'calonSiswa'];
        foreach ($roles as $level) {
            Roles::factory()->create(['level' => $level]);
        }
    }
}
