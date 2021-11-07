<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create course
        DB::table('courses')->insert([
            [
                "name" => "Matematika",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString()
            ],
            [
                "name" => "Bahasa Indonesia",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString()
            ],
            [
                "name" => "Bahasa Inggris",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString()
            ],
            [
                "name" => "Biologi",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString()
            ],
            [
                "name" => "Fisika",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString()
            ],
            [
                "name" => "Kimia",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString()
            ]
        ]);

        //integration course with class
        // for ($i=1; $i < 6 ; $i++) { 
        //     $course=Course::find($i);
        //     $course->classes()->attach($i);
        // }

    }
}
