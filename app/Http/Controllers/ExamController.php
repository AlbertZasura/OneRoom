<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Exam;
use App\Models\User;
use App\Models\Classes;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Exports\ExamsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', App\Models\Exam::class);
        $exam = Exam::all();

        $course = '';
        $exType = '';
        $class = '';

        $exam_type = DB::table('exams')
                        ->select('type', DB::raw('count(*) as total'))
                        ->groupBy('type')
                        ->get();

        return view('exams.index', [
            'exam' => $exam,
            'examType' => $exam_type,
            'course' => $course,
            'exType'  => $exType,
            'class' => $class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', App\Models\Exam::class);
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //ga kepake
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            "end_date" => 'required',
            "file" => 'required',
            "course_id" => 'required',
            "user_id" => 'required',
            "class_id" => 'required'
        ]);

        Exam::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'file' => $request->file,
            'course_id' => $request->course_id,
            'class_id' => $request->class_id
        ]);

        return redirect()->route('exams.index')->with('success','Exam created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */

     //download soal
    public function downloadExamsUser($id, Exam $exam){
        $this->authorize('downloadExamQuestions', $exam);

        $user = User::find(Auth::id());

        // dd($user->examsId($id));

        $exam = Exam::find($id);

        // $user->examsId(request()->input('pivotId'));

        // dd($exam->usersExams($user->id));
        // $exam_file = $exam->usersExams($user->id)->first()->pivot;
        
       
        $file_path = public_path('storage/file/'.$exam->file);
        return response()->download($file_path);

    }

    //download jawaban 
    public function downloadExamStudent(Exam $exam){
        $this->authorize('downloadExamAnswer', $exam);
       
        $user = User::find(request()->input('user_id'));

        $exam = Exam::find(request()->input('e'));

        $exam->usersExams(request()->input('user_id'));
        
        $exam_file = $exam->usersExams(request()->input('user_id'))->first()->pivot;

        $file_path = public_path('storage/file/'.$exam_file->file);

        return response()->download($file_path);
    }

    //siswa
    public function submitExams(Request $request){
        $this->authorize('submitExam', App\Models\Exam::class);

        $request->validate([
            'file_upload' => 'required|file|max:10000', // max 10MB
        ]);

        $todayDate = Carbon::now();
        $DateFormat = Carbon::parse($todayDate)->format('Y-m-d');
        $TimeFormat = Carbon::parse($todayDate)->format('H-i-s');
        $user = User::find(Auth::user()->id);
        // dd($user->id);
        // dd($user->exams());
        $file = $request->file('file_upload');
        $fileName =  Auth::id()."_".$DateFormat."_".$TimeFormat."_".$file->getClientOriginalName();
        if($request->file('file_upload')){
            $file->storeAs('public/file', $fileName);
            $user->exams()->attach($request->e, ['file' => $fileName, 'notes' => $request->notes]);

            // Session::create([
            //     'title' => $request->title,
            //     'description' => $request->description,
            //     'file' => $fileName,
            //     'user_id' =>Auth::id(),
            //     'course_id' => $request->coId
            // ]);
    
            return redirect()->route('exams.index')->with('success','exams created successfully.');

        }else{
            dd("no file upload");
        }

    }

    //guru
    public function assignExamScore(Request $request, $id, Exam $exam){
        $this->authorize('update', $exam);

        // dd(request()->input('pivotId'));
        // $exam_id
        // dd(request()->input('e'));
        $user = User::find($id);
        // dd($user->exams()->first()->pivot);
        // $user->exams()->attach($request->e, ['score' => $request->score]);
        $user->examsId(request()->input('pivotId'))->updateExistingPivot($request->e, ['score' => $request->score]);



        // dd($id);
        // $exam_user = Exam::find($id);
        // dd($exam_user->users);
        // $exam_user->users->attach($user_id, ['score' => $request->score]);

        
        return redirect()->route('examsubmitlist', $request->e)->with('success','Score successfully created.');    
        
        
    }

    //list yg udah submit
    public function userSubmitList($exam_id){
        $this->authorize('viewListSubmit', App\Models\Exam::class);
        $exam_user = Exam::find($exam_id);

        $t = $exam_user->users;

        // dd($exam_user->users);
        return view('exams.detail_exam', [
            'userList' => $t, 'exam_id' => $exam_id,
        ]);
    }

    //GURU
    public function createExams(Request $request){
        $this->authorize('create', App\Models\Exam::class);

        $request->validate([
            'title' => 'required',
            'startDate' => 'required',
            'deadline' => 'required',
        ]);

        $todayDate = Carbon::now();
        $DateFormat = Carbon::parse($todayDate)->format('Y-m-d');
        $TimeFormat = Carbon::parse($todayDate)->format('H-i-s');
        $file = $request->file('file_upload');
        $fileName =  Auth::id()."_".$DateFormat."_".$TimeFormat."_".$file->getClientOriginalName();
        
        $user = User::find(Auth::user()->id);

        if($request->file('file_upload')){
            $file->storeAs('public/file', $fileName);
            
            Exam::create([
                'title' => $request->title,
                'type' => request()->input('type'),
                'start_date' => $request->startDate,
                'end_date' => $request->deadline,
                'file' => $fileName,
                'user_id' =>Auth::id(),
                'class_id' => request()->input('class_id'),
            ]);

            $last_exam = Exam::latest('created_at')->first();

            $last_exam->courses()->attach(request()->input('course_id'));

    
            return redirect()->route('exams.index')->with('success','Ujian Berhasil Dibuat.');

        }else{
            dd("no file upload");
        }

        


        
    }

    //guru siswa
    public function filterExam($type, $course_id){
        $this->authorize('view', App\Models\Exam::class);

        $ex = Exam::where('type','like', $type)->first();

        $exam = DB::table('exams')->where('type','like', $type)->get();

        $course = $ex->courses;

        $exType = $type;

        $exam_type = DB::table('exams')
                        ->select('type', DB::raw('count(*) as total'))
                        ->groupBy('type')
                        ->get();

        
        return view('exams.show', [
            'exam' => $exam,
            'examType' => $exam_type,
            'course' => $course,
            'exType'  => $exType
        ]);
    }

    //keseluruhan
    public function listExam($type){
        $this->authorize('viewAny', App\Models\Exam::class);
        if(request()->input('class_id')){
            $exam = Exam::where('type','like', $type)->where('class_id', 'like', request()->input('class_id'))->get();
        }else{
            $exam = Exam::where('type','like', $type)->get();
        }

        $ex = Exam::where('type','like', $type)->first();
        $c = Course::find(request()->input('course_id'));
        
        if(request()->input('course_id')){
            $exam = $c->exams->where('type','like', $type);
        }
        
        if(request()->input('course_id') && request()->input('class_id')){
            $exam = $c->exams->where('type','like', $type)->where('class_id', 'like', request()->input('class_id'));
        }
        
        
        // $course = Course::all();
        $course = Auth::user()->usersCorses->unique();

        // $class = Classes::all();
        $class = Auth::user()->usersClasses->unique();

        $exType = $type;

        $exam_type = DB::table('exams')
                        ->select('type', DB::raw('count(*) as total'))
                        ->groupBy('type')
                        ->get();

        
        return view('exams.show', [
            'exam' => $exam,
            'examType' => $exam_type,
            'course' => $course,
            'exType'  => $exType,
            'class' => $class
        ]);
    }

    //guru siswa
    public function show(Exam $exam)
    {
        $this->authorize('view', $exam);
        $exam = Exam::all();

        $exam_type = DB::table('exams')
                        ->select('type', DB::raw('count(*) as total'))
                        ->groupBy('type')
                        ->get();

        
        return view('exams.show', [
            'exam' => $exam,
            'examType' => $exam_type
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    //ga kepake
    public function edit(Exam $exam)
    {
        return view('messages.edit', ['exam' => $exam]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */

     //ga kepake
    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            "end_date" => 'required',
            "file" => 'required',
            "course_id" => 'required',
            "user_id" => 'required',
            "class_id" => 'required'
        ]);

        $exam->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'file' => $request->file,
            'course_id' => $request->course_id,
            'class_id' => $request->class_id
        ]);

        return redirect()->route('exams.index')->with('success','Exam updated successfully.');
    }

    //guru
    public function export(Exam $exam){
        $this->authorize('exportScore', $exam);
        return Excel::download(new ExamsExport($exam->id), "Daftar Siswa kelas {$exam->class->name} - Ujian {$exam->title}.xlsx");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    //guru
    public function destroy(Exam $exam)
    {
        $this->authorize('delete', $exam);
        $exam->delete();
        return redirect()->route('exams.index')
                        ->with('success','Exam deleted successfully');
    }
}
