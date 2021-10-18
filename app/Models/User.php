<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'role',
        'identification_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $roles = [
        'admin',
        'teacher',
        'student'
    ];

    public function getRoleAttribute($value)
    {
        return Arr::get($this->roles, $value);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function assignments(){
        return $this->belongsToMany(Assignment::class,'assignments_users','user_id','assignment_id')->withPivot('notes', 'score', 'file')->withTimestamps(); 
    }

    public function classes(){
        return $this->belongsToMany(Classes::class,'classes_users','user_id','class_id')->withTimestamps(); 
    }

    public function exams(){
        return $this->belongsToMany(Exam::class,'exams_users', 'user_id', 'exam_id')->withPivot('id', 'notes','score','file')->withTimestamps();
    }

    public function examsId($id){
        return $this->exams()->wherePivot('id',$id);
    }

}
