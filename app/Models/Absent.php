<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->whereHas('user',function($query) use ($search){
                return $query->where('name','like','%'.$search.'%');
            });
        });
    }
    
    public function schedule(){
        return $this->belongsTo(Schedule::class); 
    }

    public function user(){
        return $this->belongsTo(User::class); 
    }

    
}
