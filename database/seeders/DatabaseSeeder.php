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
        \App\Models\User::factory(500)->create();
        $this->call([
            MessageSeeder::class,
            ClassesSeeder::class,
            CourseSeeder::class,
            SessionSeeder::class,
            ScheduleSeeder::class,
            // AbsentSeeder::class,
            ExamSeeder::class,
            AssignmentSeeder::class,
            UserSeeder::class,
            ContentSeeder::class
        ]);
    }
}
