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
                "course_id" => $i + 1,
                "user_id" => $i + 1
            ]);
            $absents->save();
        }
    }
}
