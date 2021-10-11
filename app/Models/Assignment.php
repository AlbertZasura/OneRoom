<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $kkm=75;
    public function class(){
        return $this->belongsTo(Classes::class,'class_id');
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'assignments_users','assignment_id','user_id')->withPivot('notes', 'score', 'file')->withTimestamps();
    }

    public function usersFile($time){
        return $this->users()->wherePivot('created_at',$time);
    }
}
