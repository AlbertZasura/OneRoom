<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function scopeFilter($query, array $filters){
        $query->when($filters['course'] ?? false, function($query, $course){
            return $query->where('course_id',$course);
        });

        $query->when($filters['weekday'] ?? false, function($query, $weekday){
            return $query->where(DB::raw("DAYOFWEEK(date)"), $weekday);
        });
    }

    public function course(){
        return $this->belongsTo(Course::class); 
    }

    public function class(){
        return $this->belongsTo(Classes::class); 
    }
}
