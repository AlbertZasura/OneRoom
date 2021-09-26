<?php

namespace Database\Seeders;

use App\Models\Absent;
use Illuminate\Database\Seeder;

class AbsentSeeder extends Seeder
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
            $absents = new Absent;
            $absents->fill([
                "status" => "Hadir",
                "course_id" => $i,
                "user_id" => $i
            ]);
            $absents->save();
        }
    }
}
