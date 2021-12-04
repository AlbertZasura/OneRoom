<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\User;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // initialisasi
        $classNames=[
           "SMP 1","SMP 2","SMP 3",
           "SMA 1","SMA 2","SMA 3"
        ];

        // create class
        for ($i=0; $i < count($classNames) ; $i++) { 
            $classes = new Classes;
            $classes->fill([
                'name' => $classNames[$i]
            ]);
            $classes->save();
        }

        // assign user to class
        for ($i=0; $i < count($classNames) ; $i++) { 
            $teachers=User::where([['role',1],['status',1]])->inRandomOrder()->limit(5)->get();
            for ($j=0; $j<count($teachers); $j++) { 
                $class=Classes::find($i+1);
                $class->users()->attach($teachers[$j]->id);
            }
            $students=User::doesntHave('classes')->where([['role',2],['status',1]])->inRandomOrder()->limit(15)->get();
            for ($j=0; $j<count($students); $j++) { 
                $class=Classes::find($i+1);
                $class->users()->attach($students[$j]->id);
            }
        }
    }
}
