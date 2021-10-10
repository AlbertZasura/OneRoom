<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course()
    {
        $courses = Course::all(); 
        return view('assignments.course', [
            'courses' => $courses
        ]);
    }

    public function index(Course $course)
    {
        $courses = Course::all();  
        // dd($course->classes->first());
        $assignments = is_null($course->classes->first()) ? '': $course->classes->first()->assignments ;
        if (request('class')) {
            $assignments = Assignment::where('class_id',request('class'))->where('course_id',$course->id)->get();
        }
        
        return view('assignments.index', [
            'course' => $course,
            'courses' => $courses,
            'assignments'=> $assignments
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
        return back()->with('success','Tugas berhasil dibuat.');
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
        return view('assignments.show', [
            'assignment' => $assignment,
            'course' => $course
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
        return redirect()->route('course.assignments.index',$course)->with('success','Tugas berhasil dihapus');
    }

    public function download(Assignment $assignment)
    {
        $pathToFile = storage_path($assignment->file);
        return response()->download($pathToFile);
    }
}
