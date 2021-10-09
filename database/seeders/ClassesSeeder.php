<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classNames=[
           "SMP 1","SMP 2","SMP 3",
           "SMA 1","SMA 2","SMA 3"
        ];

        for ($i=0; $i < count($classNames) ; $i++) { 
            $classes = new Classes;
            $classes->fill([
                'name' => $classNames[$i]
            ]);
            $classes->save();
        }

        for ($i=0; $i < count($classNames) ; $i++) { 
            for ($j=6; $j>$i ; $j--) { 
                $class=Classes::find($i+1);
                $class->users()->attach($j);
            }
        }
    }
}
