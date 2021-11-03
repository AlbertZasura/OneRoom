<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Classes;
use App\Models\Course;
use App\Exports\AssignmentExport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course()
    {
        $courses = Course::whereHas('classes.users',function(Builder $query){
            $query->where('user_id',Auth::user()->id);
        })->get();
        return view('assignments.course', [
            'courses' => $courses
        ]);
    }

    public function index(Course $course)
    {
        $user = Auth::user();
        $courses = Course::whereHas('classes.users',function(Builder $query) use ($user){
            $query->where('user_id',$user->id);
        })->get();
        // $assignments = is_null($course->classes->first()) ? '': $course->classes->first()->assignments ;
        switch(Auth::user()->role){
            case 'student':
                $assignments = Assignment::where('course_id',$course->id)->where('class_id',$user->classes->first()->id);
                break;
            case 'teacher':
                $classes = Classes::whereRelation('users','users.id',$user->id)->whereRelation('courses','courses.id',$course->id)->get();
                $assignments = Assignment::where('course_id',$course->id)->whereIn('class_id',$user->classes->pluck('id'));
                if (request('class')) {
                    $assignments =$assignments->where('class_id',request('class'));
                }else{
                    $assignments =$assignments->where('class_id',$classes->first()->id);
                }
                break;
        }

        
        return view('assignments.index', [
            'course' => $course,
            'courses' => $courses,
            'assignments'=> $assignments->latest()->get(),
            'classes' => $classes ?? 'null'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Htt p\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'deadline' => 'required',
            'file' => 'required|file|max:10000', // max 10MB
        ]);
        
        $file = $request->file('file');
        $fileName =  now()->format('Y-m-d-H-i-s')."".Auth::id()."_".$file->getClientOriginalName();
        $file->storeAs('public/file', $fileName);
        Assignment::create([
                'title' => $request->title,
                'deadline' => Carbon::parse($request->deadline)->format('Y-m-d H:i:s'),
                'file' => 'app/public/file/'.$fileName,
                'user_id' =>Auth::id(),
                'course_id' => $course->id,
                'class_id' => $request->class
            ]);
        return back()->with('success','Tugas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Assignment $assignment)
    {
        $this->authorize('view', $assignment);
        $users= $assignment->users()->paginate(25);
        return view('assignments.show', [
            'assignment' => $assignment,
            'course' => $course,
            'users'=> $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Assignment $assignment)
    {
        $this->authorize('delete', $assignment);
        $assignment->delete();
        return redirect()->route('course.assignments.index',$course)->with('success','Tugas berhasil dihapus!');
    }

    public function download(Assignment $assignment)
    {
        $type=request()->input('type');
        $user=request()->input('u');
        $time=request()->input('t');
        if ($type==='answer') {
            $pathToFile = storage_path($assignment->usersFile($time)->first()->pivot->file);
        }else if ($type==='question') {
            $pathToFile = storage_path($assignment->file);
        }
        return response()->download($pathToFile);
    }

    public function upload(Request $request,Assignment $assignment)
    {
        $request->validate([
            'notes' => 'required',
            'file' => 'required|file|max:10000' // max 10MB
        ]);
        
        $file = $request->file('file');
        $fileName =  now()->format('Y-m-d-H-i-s')."".Auth::id()."_".$file->getClientOriginalName();
        $file->storeAs('public/file', $fileName);
        $assignment->users()->attach(Auth::user()->id,[
            'file' => 'app/public/file/'.$fileName,
            'notes' => $request->notes
        ]);
        return back()->with('success','Tugas berhasil dikumpulkan!');
    }

    public function scoring(Request $request,Assignment $assignment)
    {
        $request->validate([
            'score' => 'required'
        ]);
        $assignment->usersFile($request->t)->updateExistingPivot($request->u,[
            'score' => $request->score
        ]);

        return back()->with('success','Tugas berhasil dinilai.');
    }

    public function export(Assignment $assignment){
        return Excel::download(new AssignmentExport($assignment->id), "Daftar Siswa kelas {$assignment->class->name} - Tugas {$assignment->title}.xlsx");
    }
}
