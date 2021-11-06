<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Session;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
                $crs = Course::find(request()->input('selectCourseId'));
                
                $user_have_class = $teacher->find(request()->input("selectTeacherId"))->usersClasses;
                // dd($user_have_class->first()->pivot);

                // dd($crs->usersId(request()->input("selectTeacherId")));
                // dd($course->users->first()->pivot);
                return view('materi.admin_course',[
                    'selectedTeacher' => $teacher->find(request()->input("selectTeacherId")),
                    'selectedCourse' => $course->find(request()->input("selectCourseId")),
                    'teacher' => $teacher,
                    'course' => $course,
                    'class' => $class,
                    'exist_class' => $user_have_class,
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
            $course = $cls->courses;
            // $course = Auth::user()->usersCorses;
            $userClass = Auth::user()->usersClasses;
            
            
            return view('materi.index', [
                'course' => $course,
                'cls' => $cls,
                'user_class' => $userClass->unique()
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
        $user = User::find(Auth::id());
        $c = Course::all();
        $ses = $course->sessions;
        $cls = $user->classes;
        $userClass = $user->usersClasses;
        return view('materi.show', ['ses' => $ses, 'course' => $c, 'courseId' => $course->id, 'cls' => $cls, 'user_class' => $userClass]);
    }

    public function showTeacherCourse(){

        $user = User::find(Auth::id());
        $class = Classes::find(request()->input('class_id'));
        $courseTeacher = $class->classesCourse;
        $cls = $user->classes;
        $userClass = $user->usersClasses->unique();
        $course = $courseTeacher->first();
        $session = $course->sessionClasses(request()->input('class_id'))->get();
        return view('materi.show', [
            'ses' => $session, 
            'user_class' => $userClass, 
            'course_teacher' => $courseTeacher->unique(),
            'seletedClass' => $class
        ]);
    }

    public function filterTeacherSession(){

        
        $user = User::find(Auth::id());
        $class = Classes::find(request()->input('class_id'));
        $courseTeacher = $class->classesCourse;
        $cls = $user->classes;
        $userClass = $user->usersClasses->unique();
        $course = $courseTeacher->find(request()->input('course_id'));
        // $session = $course->sessions->where('class_id','like', request()->input('class_id'))->get();
        $session = $course->sessionClasses(request()->input('class_id'))->get();

        // dd($session);
        // if($session != null){
        //     $session = $session->sessions;
        // }
        // dd($courseTeacher);
        return view('materi.show', [
            'ses' => $session, 
            'user_class' => $userClass, 
            'course_teacher' => $courseTeacher->unique(), 
            'selected_course' => Course::find(request()->input('course_id')),
            'seletedClass' => $class
        ]);
    }

    public function insertSession(Request $request){

        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file_upload' => 'required|file|max:10000', // max 10MB
        ]);

        $todayDate = Carbon::now();
        $DateFormat = Carbon::parse($todayDate)->format('Y-m-d');
        $TimeFormat = Carbon::parse($todayDate)->format('H-i-s');

        $file = $request->file('file_upload');
        $fileName =  Auth::id()."_".$DateFormat."_".$TimeFormat."_".$file->getClientOriginalName();
        if($request->file('file_upload')){
            $file->storeAs('public/file', $fileName);
            Session::create([
                'title' => $request->title,
                'description' => $request->description,
                'file' => $fileName,
                'user_id' =>Auth::id(),
                'course_id' => request()->input('course_id'),
                'class_id' => request()->input('class_id')
            ]);
    
            return redirect()->route('courses.index')->with('success','Message created successfully.');

        }else{
            abort("no file upload");
        }
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
    public function assignCourse(){

        $course = Course::find(request()->input('selectCourseId'));

        $course->users()->attach(request()->input('selectTeacherId'), ['class_id' => request()->input('selectedClass')]);


        return redirect()->route('courses.index')->with('success','Berhasil Mapping Guru dan pelajarannya.');
    }

    public function teacherClassDelete(){

        $teacher =  User::find(request()->input("user_id"));
        
        $user_have_class = $teacher->usersClasses->where("id","like",request()->input("class_id"))->first()->pivot->delete();
        // $user_have_class = $teacher->usersClasses();
        // dd($user_have_class);

        return redirect()->route('courses.index')->with('success','Berhasil Menghapus Mapping Guru dengan kelas.');
    }

}
