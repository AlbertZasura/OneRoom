<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Carbon\Carbon;
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
        for ($i=1; $i <= 6; $i++) { 
            for ($j=1; $j <= 6; $j++) { 
                $schedules = new Schedule;
                $dateTime = Carbon::create(now()->year, rand(now()->month,12), rand(1,30), rand(0,now()->hour), rand(0,60), 7, 'GMT');
                $endTime = $dateTime;
                $schedules->fill([
                    "date" => $dateTime,
                    "start_time" =>$dateTime,
                    "end_time" => now(),
                    "course_id" => $i,
                    "class_id" => $j 
                ]);
                $schedules->save();
            }
        }
    }
}
