<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Session;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 100; $i++) { 
            $sessions = new Session;
            $sessions->fill([
                'title' => $faker->sentence,
                'description' => $faker->text,
                'file' => asset('img/Logo-OneRoom.png'),
                "user_id" => $i+1,
                "course_id" => rand(1, 15),
                "class_id" => rand(1, 6),
            ]);
            $sessions->save();
        }
    }
}
