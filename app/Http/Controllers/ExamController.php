<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam = Exam::all();

        $course = '';
        $exType = '';

        $exam_type = DB::table('exams')
                        ->select('type', DB::raw('count(*) as total'))
                        ->groupBy('type')
                        ->get();

        return view('exams.index', [
            'exam' => $exam,
            'examType' => $exam_type,
            'course' => $course,
            'exType'  => $exType
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

    public function assignExamScore(Request $request, $id){

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

    public function userSubmitList($exam_id){

        $exam_user = Exam::find($exam_id);

        $t = $exam_user->users;

        // dd($exam_user->users);
        return view('exams.detail_exam', [
            'userList' => $t, 'exam_id' => $exam_id
        ]);
    }

    public function filterExam($type, $course_id){

        dd($course_id);

        $ex = Exam::where('type','like', $type)->first();

        $exam = DB::table('exams')->where('type','like', $type)->get();

        $course = $ex->courses;

        // dd($course);

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


    public function listExam($type){

        $ex = Exam::where('type','like', $type)->first();

        $exam = DB::table('exams')->where('type','like', $type)->get();

        $course = $ex->courses;

        // dd($course);

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

    public function show(Exam $exam)
    {
       
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')
                        ->with('success','Exam deleted successfully');
    }
}
