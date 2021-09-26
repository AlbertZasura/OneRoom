<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 5; $i++) { 
            $classes = new Classes;
            $classes->fill([
                'name' => $faker->name()
            ]);
            $classes->save();
        }
    }
}
