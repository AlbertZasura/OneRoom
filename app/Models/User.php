<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

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

    public function humanizeRole()
    {
        switch ($this->role) {
            case 'teacher':
                return 'Guru';
                break;
            case 'student':
                return 'Siswa';
                break;
            default:
                return $this->role;
                break;
        }
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name','like','%'.$search.'%');
        });

        $query->when($filters['role'] ?? false, function($query, $role){
            return $query->where('role', $role);
        });
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

    public function examsUsers($exam_id){
        return $this->exams()->wherePivot('exam_id',$exam_id);
    }

    public function usersCorses(){
        return $this->belongsToMany(Course::class,'courses_classes_users', 'user_id', 'course_id')->withPivot('class_id')->withTimestamps(); 
    }
    
    public function course($class){
        return $this->usersCorses()->wherePivot('class_id',$class); 
    }

    public function usersClasses(){
        return $this->belongsToMany(Classes::class,'courses_classes_users', 'user_id', 'class_id')->withPivot('course_id')->withTimestamps(); 
    }

    public function absents(){
        return $this->hasMany(Absent::class);
    }

    public function absent_schedule($schedule_id){
        return $this->absents()->where('schedule_id',$schedule_id);
    }

    public function check_absent_today(){
        return $this->absents()->whereDate('created_at', now())->first(); 
    }

    public function check_absent($date){
        return $this->absents()->whereDate('created_at', $date)->first(); 
    }
}
