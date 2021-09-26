<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 5; $i++) { 
            $courses = new Course;
            $courses->fill([
                "name" => "Name blablabla",
            ]);
            $courses->save();
        }
    }
}
