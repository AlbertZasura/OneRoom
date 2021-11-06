<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=[
            "KKM","Absent"
         ];

        $values=[
            "75","07:30"
         ];

        $types=[
            "number","time"
         ];

        for ($i=0; $i < count($names) ; $i++) { 
            $contents = new Content();
            $contents->fill([
                'name' => $names[$i],
                'value'=> $values[$i],
                'type'=> $types[$i],
            ]);
            $contents->save();
        }
    }
}
