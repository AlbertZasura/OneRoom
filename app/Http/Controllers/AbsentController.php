<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\AbsentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Alert;
use App\Models\Content;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function absentGrid(){
        $this->authorize('absentGrid', Absent::class);
        $classes = Auth::user()->classes;
        $schedules = Schedule::with('course')->whereIn('class_id',Auth::user()->classes->pluck('id'))->filter(request(['class']));
        return view('absents.grid', [
            'schedules' => $schedules->get(),
            'classes' => $classes
        ]);
    }
    
     public function course()
    {
        $this->authorize('course', Absent::class);
        $courses = Course::whereHas('classes.users',function(Builder $query){
            $query->where('user_id',Auth::user()->id);
        })->get();
        if ($courses->isEmpty()){
            return view('warnings/warningPage');
        }else{
            return view('absents.course', [
                'courses' => $courses
            ]);
        }
    }
    
     public function index(Course $course)
    {
        $this->authorize('viewAny', Absent::class);
        $user = Auth::user();
        $courses = Course::whereHas('classes.users',function(Builder $query) use ($user){
            $query->where('user_id',$user->id);
        })->get();
        switch($user->role){
            case 'student':
                $schedules = Schedule::where('course_id',$course->id)->where('class_id',$user->classes->first()->id)->orderBy('date');
                break;
            case 'teacher':
                // $classes = Classes::whereRelation('users','users.id',$user->id)->whereRelation('courses','courses.id',$course->id)->get();
                // $assignments = Assignment::where('course_id',$course->id)->whereIn('class_id',$user->classes->pluck('id'));
                // if (request('class')) {
                //     $assignments =$assignments->where('class_id',request('class'));
                // }else{
                //     $assignments =$assignments->where('class_id',$classes->first()->id);
                // }
                // break;
        }

        return view('absents.index', [
            'courses' => $courses,
            'schedules'=> $schedules->get()
        ]);
    }

    public function listUser()
    {
        $this->authorize('listUser', Absent::class);
        $schedule = request('schedule') ? Schedule::findOrFail(request('schedule')) : "";
        $role = Auth::user()->role;
        switch($role){
            case 'teacher':
                $users = $schedule->class->students()->filter(request(['search']));
                break;
            case 'admin':
                $users = User::where('role',1)->filter(request(['search']));
                break;
        }
        return view('absents.list_user', [
            'schedule' => $schedule,
            'users' => $users->paginate(25)->appends(['date' => request('date'), 'schedule' => request('schedule')]),
            'role' => $role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, Request $request)
    {
        $this->authorize('create', Absent::class);
        $role = Auth::user()->role;
        $max_absent= Content::where('name','=','Absent')->first()->value;
        switch($role){
            case 'teacher':
                Absent::create([
                    'status' => time()>strtotime($max_absent)? 'Telat':'Hadir',
                    'user_id' => Auth::user()->id
                ]);
                break;
            case 'student':
                $schedule=Schedule::find($request->schedule_id);
                Absent::create([
                    'status' => 'Hadir',
                    'user_id' => Auth::user()->id,
                    'schedule_id' => $schedule->id
                ]);
                break;
        }
        
        Alert::success('Berhasil', 'Anda berhasil absent!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function show(Absent $absent)
    {
        return view('messages.show', ['absent' => $absent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function edit(Absent $absent)
    {
        return view('messages.edit', ['absent' => $absent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absent $absent)
    {
        $this->authorize('update', $absent);
        $request->validate([
            'created_at' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'course_id' => 'required'
        ]);

        $user = Auth::user();
        $absent->update([
            'created_at' => $user->created_at,
            'status' => $request->status,
            'user_id' => $user->id,
            'course_id' => $request->course_id
        ]);

        return redirect()->route('absents.index')->with('success','Absent updated successfully.');
    }

    public function export(){
        $this->authorize('export', Absent::class);
        $role = Auth::user()->role ==='teacher'?'Siswa':'Guru';
        $date = request('schedule') ? Schedule::findOrFail(request('schedule'))->created_at : request('date');
        return Excel::download(new AbsentsExport(request(['search','schedule'])), "Daftar Absent {$role} Tanggal {$date}.xlsx");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    
}
