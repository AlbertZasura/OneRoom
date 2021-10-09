<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use App\Models\Classes;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $session = Session::all();
        $course = Course::all();
        

        return view('materi.index', [
            'session' => $session, 
            'course' => $course
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
        
        
        // $this->validate($request, [
        //     'file_upload' => 'required|file|max:10000', // max 10MB
        // ]);

       

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
                'course_id' => $request->coId
            ]);
    
            return redirect()->route('session.index')->with('success','Message created successfully.');

        }else{
            abort("no file upload");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        return view('materi.show', ['session' => $session]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        return view('messages.edit', ['session' => $session]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Session::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => 'teste.txt',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('session.index')->with('success','Message created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return redirect()->route('session.index')
                        ->with('success','Message deleted successfully');
    }
}
