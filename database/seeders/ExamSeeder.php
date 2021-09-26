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
                        'title' => 'UTS Matematika',
                        'type' => 'ujian tengah semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-09-26 15:10:12',
                        'file' => 'soal_mtk.pdf',
                        "course_id" => 1,
                        "user_id" => 1,
                        "class_id" => 1,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'Ulangan IPA',
                        'type' => 'ulangan',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-10-26 15:10:12',
                        'file' => 'soal_ipa.pdf',
                        "course_id" => 1,
                        "user_id" => 1,
                        "class_id" => 2,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ],
                    [
                        'title' => 'UAS IPS',
                        'type' => 'ujian akhir semester',
                        'start_date' => now()->toDateTimeString(),
                        'end_date' => '2021-11-26 15:10:12',
                        'file' => 'soal_ips.pdf',
                        "course_id" => 1,
                        "user_id" => 1,
                        "class_id" => 3,
                        "created_at" =>  now()->toDateTimeString(),
                        "updated_at" => now()->toDateTimeString(),
                    ]
                ]);
                
            }
        }
        