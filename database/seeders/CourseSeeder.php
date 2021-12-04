<?php

namespace Database\Seeders;

use App\Models\Classes;
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
        //initialize course
        $courses=[
            "Matematika","Bahasa Indonesia","Bahasa Inggris",
            "Biologi","Fisika","Kimia",
            "PPKN","Agama","Sosiologi",
            "Seni Budaya","TIK","Sejarah",
            "Bahasa German","Bahasa Mandarin","Penjas"
         ];

        // create course
        for ($i=0; $i < count($courses) ; $i++) { 
            $course = new Course;
            $course->fill([
                'name' => $courses[$i]
            ]);
            $course->save();
        }

        //integration course with class
        $courses=Course::all();
        for ($i=1; $i < 7 ; $i++) { 
            $classes=Classes::find($i);
            foreach ($classes->teachers as $user) {
                $classes->classesCourse()->attach($courses[rand(0,14)]->id,['user_id' => $user->id]);
            }
        }

    }
}
