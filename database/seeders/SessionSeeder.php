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
        for ($i=0; $i < 5; $i++) { 
            $sessions = new Session;
            $sessions->fill([
                'title' => 'Testing',
                'description' => 'Testing description',
                'file' => 'materi_mtk.pdf',
                "user_id" => $i+1,
                "course_id" => $i+1,
                "class_id" => $i+1,
            ]);
            $sessions->save();
        }
    }
}
