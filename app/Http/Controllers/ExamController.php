<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('messages.index', [
            'exam' => $exam
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
            'user_id' => User::find(1)->first()->id,
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
    public function show(Exam $exam)
    {
        return view('messages.show', ['exam' => $exam]);
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
            'user_id' => User::find(1)->first()->id,
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
