<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function class(){
        return $this->belongsTo(Classes::class,'class_id');
    }

    public function courses(){
        return $this->belongsToMany(Course::class,'courses_exams', 'exam_id', 'course_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'exams_users','exam_id', 'user_id')->withPivot('id','notes','score','file')->withTimestamps();
    }

    public function usersExams($user_id){
        return $this->users()->wherePivot('user_id',$user_id);
    }
    
}
