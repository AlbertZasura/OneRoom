<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
    use App\Models\Message;
use Nette\Utils\Random;

class MessageSeeder extends Seeder
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
            $messages = new Message;
            $messages->fill([
                "user_id" => rand(1,10),
                'title' => "PENGUMUMAN",
                'content' => $faker->text,
                'file' => 'soal_mtk.pdf'
            ]);
            $messages->save();
        }
    }
}
