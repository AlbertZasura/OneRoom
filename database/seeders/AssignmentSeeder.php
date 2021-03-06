<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignments')->insert(
            [
                [
                    'title' => 'UTS Matematika',
                    'deadline' => now()->toDateTimeString(),
                    'file' => 'soal_mtk.pdf',
                    "course_id" => 1,
                    "user_id" => 1,
                    "class_id" => 1,
                    "created_at" =>  now()->toDateTimeString(),
                    "updated_at" => now()->toDateTimeString(),
                ],
                [
                    'title' => 'Ulangan IPA',
                    'deadline' => now()->toDateTimeString(),
                    'file' => 'soal_ipa.pdf',
                    "course_id" => 1,
                    "user_id" => 1,
                    "class_id" => 2,
                    "created_at" =>  now()->toDateTimeString(),
                    "updated_at" => now()->toDateTimeString(),
                ],
                [
                    'title' => 'UAS IPS',
                    'deadline' => now()->toDateTimeString(),
                    'file' => 'soal_ips.pdf',
                    "course_id" => 1,
                    "user_id" => 1,
                    "class_id" => 3,
                    "created_at" =>  now()->toDateTimeString(),
                    "updated_at" => now()->toDateTimeString(),
                ]
            ]
        );
    }
}
