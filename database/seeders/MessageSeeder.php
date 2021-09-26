<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
            $messages = new Message;
            $messages->fill([
                "user_id" => 1,
                'title' => 'Testing',
                'content' => "lorem blab labla"
            ]);
            $messages->save();
        }
    }
}
