<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function sessions(){
        return $this->hasMany(Session::class);
    }

    public function users(){
        return $this->belongsToMany(Classes::class,'courses_classes_users', 'course_id', 'user_id')->withPivot('class_id')->withTimestamps(); 
    }

    public function usersId($user_id){
        return $this->users()->wherePivot('user_id',$user_id);
    }

    public function classes(){
        return $this->belongsToMany(Classes::class,'classes_courses','course_id','class_id')->withTimestamps(); 
    }

    public function userClasses($user){
        return $this->classes()->whereRelation('users','users.id','==',$user); 
    }

    public function assignments(){
        return $this->hasMany(Assignment::class);
    }

    public function classAssignments($class){
        return $this->assignments()->whereIn('class_id', $class);
    }

    public function exams(){
        return $this->belongsToMany(Exam::class,'courses_exams','course_id', 'exam_id');
    }

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }

}
