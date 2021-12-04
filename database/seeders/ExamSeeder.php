<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Exam;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('exams')->insert(
                [
                    [
                        'title' => 'UTS Matematika Diskrit',
                        'type' => 'ujian tengah semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-09-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 1,
                        "course_id" => 1,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'Ulangan Sistem Pencernaan',
                        'type' => 'ulangan',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-10-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 2,
                        "course_id" => 4,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'UAS English Conversation',
                        'type' => 'ujian akhir semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-11-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 3,
                        "course_id" => 3,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'UTS Biologi Pengenalan',
                        'type' => 'ujian tengah semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-09-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 4,
                        "course_id" => 4,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'Ulangan Fisika Hukum Newton',
                        'type' => 'ulangan',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-10-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 5,
                        "course_id" => 5,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'UAS Fisika Pesawat Sederhana',
                        'type' => 'ujian akhir semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-11-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 6,
                        "course_id" => 5,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'UTS Aljabar Linear',
                        'type' => 'ujian tengah semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-09-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 1,
                        "course_id" => 1,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'Ulangan Mutasi Genetik dan Perkambangbiakan',
                        'type' => 'ulangan',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-10-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 2,
                        "course_id" => 4,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'UAS Reaksi Kimia dan molekul hidrogen',
                        'type' => 'ujian akhir semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-11-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 3,
                        "course_id" => 6,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'UTS Penggunaan Kata Sambung',
                        'type' => 'ujian tengah semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-09-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 1,
                        "course_id" => 2,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'Ulangan Penarapan kata majemuk',
                        'type' => 'ulangan',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-10-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 2,
                        "course_id" => 2,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'UAS Ion Molekul Hidrogen Dan Molekul Hidrogen',
                        'type' => 'ujian akhir semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-11-26 15:10:12',
                        'file' => asset('img/Logo-OneRoom.png'),
                        "user_id" => 1,
                        "class_id" => 3,
                        "course_id" => 6,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                ]
            );

            for ($i=0; $i < 12 ; $i++) { 
                for ($j=30; $j>$i+1 ; $j--) { 
                    $class=Exam::find($i+1);
                    $class->users()->attach($j);
                }
            }

    }
}




    

        