<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function users(){
        return $this->belongsToMany(User::class,'classes_users','class_id','user_id');
    }

    public function assignments(){
        return $this->hasMany(Assignment::class,'class_id');
    }

    public function courses(){
        return $this->belongsToMany(Course::class,'classes_courses','class_id','course_id');
    }
    
}
