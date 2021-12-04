<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
    use App\Models\Message;
use Nette\Utils\Random;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i=0; $i < 30; $i++) { 
            $messages = new Message;
            $messages->fill([
                "user_id" => rand(1,30),
                'title' => $faker->word,
                'content' => $faker->text,
                'file' => 'soal_mtk.pdf'
            ]);
            $messages->save();
        }

    }
}
