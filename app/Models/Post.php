<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function class(){
        return $this->belongsTo(Classes::class,'class_id');
    }
}
