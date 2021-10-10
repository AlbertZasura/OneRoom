<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function sessions(){
        return $this->hasMany(Session::class);
    }

    public function classes(){
        return $this->belongsToMany(Classes::class,'classes_courses','course_id','class_id')->withTimestamps(); 
    }

    public function assignments(){
        return $this->hasMany(Assignment::class);
    }

}
