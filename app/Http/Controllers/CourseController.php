<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Session;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'admin'){

            $teacher =  User::where('role', 'like', 1)->get();
            $course = Course::all();
            // $class = Classes::all();

            if(request()->input("selectClass")){
                // $class = Classes::all();
                // dd($teacher->find(request()->input("selectTeacherId"))->classes);
                $class = $teacher->find(request()->input("selectTeacherId"))->classes;
                return view('materi.admin_course',[
                    'selectedTeacher' => $teacher->find(request()->input("selectTeacherId")),
                    'selectedCourse' => $course->find(request()->input("selectCourseId")),
                    'teacher' => $teacher,
                    'course' => $course,
                    'class' => $class
                ]);

            }else{
                $class = "";
                return view('materi.admin_course',[
                    'teacher' => $teacher,
                    'course' => $course,
                    'class' => $class
                ]);
            }

            
        }else{
            $cls = Auth::user()->classes->first();
            
            $course = Course::all();
            
            return view('materi.index', [
                'course' => $course,
                'cls' => $cls
            ]);

        }

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $user = Auth::user();
        Course::create([
            'user_id' => $user->id,
            'name' => $request->name
        ]);

        return redirect()->route('courses.index')->with('success','Course created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $c = Course::all();
        $ses = $course->sessions;
        $cls = Auth::user()->classes->first();
        return view('materi.show', ['ses' => $ses, 'course' => $c, 'courseId' => $course->id, 'cls' => $cls]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('messages.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $user = Auth::user();
        $course->update([
            'user_id' => $user->id,
            'name' => $request->name
        ]);

        return redirect()->route('courses.index')->with('success','Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')
                        ->with('success','Course deleted successfully');
    }

    public function downloadFile($id){
       
        $fl = Session::find($id);
       
        $file_path = public_path('storage/file/'.$fl->file);
        return response()->download($file_path);

    }

    public function createCourse(Request $request){

        $request->validate([
            'name' => 'required'
        ]);

        Course::create([
            'name' => $request->name
        ]);

        return redirect()->route('courses.index')->with('success','Mata Pelajaran Berhasil Dibuat.');

    }

}
