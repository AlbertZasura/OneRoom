<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(30)->create();
        $this->call([
            MessageSeeder::class,
            UserSeeder::class,
            ClassesSeeder::class,
            CourseSeeder::class,
            SessionSeeder::class,
            ScheduleSeeder::class,
            // AbsentSeeder::class,
            ExamSeeder::class,
            AssignmentSeeder::class
        ]);
    }
}
