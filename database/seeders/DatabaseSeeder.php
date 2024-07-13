<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UsersRolesSeeder::class);
        $this->call(FilesUploadsSeeder::class);
        $this->call(EducationLevelsSeeder::class);
        $this->call(TeachersSeeder::class);
        $this->call(SemestersSeeder::class);
        $this->call(ClassroomsSeeder::class);
        $this->call(StudentsSeeder::class);
        $this->call(MasterCategoryCoursesSeeder::class);
        $this->call(MasterCoursesSeeder::class);
    }
}
