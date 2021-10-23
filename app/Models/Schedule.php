<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function course(){
        return $this->belongsTo(Course::class); 
    }

    public function class(){
        return $this->belongsTo(Classes::class); 
    }
}
