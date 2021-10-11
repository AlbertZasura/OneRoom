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

    public function courses(){
        return $this->belongsToMany(Course::class,'courses_exams', 'exam_id', 'course_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'exams_users','exam_id', 'user_id')->withPivot('id','notes','score','file')->withTimestamps();
    }
    
}
