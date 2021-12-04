<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name','like','%'.$search.'%');
        });
    }
    
    public function users(){
        return $this->belongsToMany(User::class,'classes_users','class_id','user_id')->withTimestamps(); 
    }

    public function students(){
        return $this->users()->where('role',2); 
    }

    public function teachers(){
        return $this->users()->where('role',1); 
    }

    public function assignments(){
        return $this->hasMany(Assignment::class,'class_id');
    }

    // public function courses(){
    //     return $this->belongsToMany(Course::class,'classes_courses','class_id','course_id')->withTimestamps(); 
    // }
    public function courses(){
        return $this->belongsToMany(Course::class,'courses_classes_users','class_id','course_id')->withTimestamps(); 
    }

    public function classesCourse(){
        return $this->belongsToMany(Course::class,'courses_classes_users','class_id','course_id')->withPivot('user_id')->withTimestamps(); 
    }
    
    public function schedules(){
        return $this->hasMany(Schedule::class,'class_id');
    }

    public function usersCourse(){
        return $this->belongsToMany(Classes::class,'courses_classes_users', 'class_id', 'user_id')->withPivot('course_id')->withTimestamps(); 
    }

    public function teachersCourses($user_id){
        return $this->classesCourse()->wherePivot('user_id',$user_id);
    }

}
