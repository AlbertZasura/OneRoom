<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
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
            $schedules = new Schedule;
            $schedules->fill([
                "date" => now(),
                "start_date" => now()->toDateTimeString(),
                "end_date" => "2021-09-27 14:14:39",
                "course_id" => $i
            ]);
            $schedules->save();
        }
    }
}
