<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\User;
use Illuminate\Http\Request;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absents = Absent::all();
        return view('messages.index', [
            'absents' => $absents
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
            'created_at' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'course_id' => 'required'
        ]);

        $user = User::find(1)->first();
        Absent::create([
            'created_at' => $user->created_at,
            'status' => $request->status,
            'user_id' => $user->id,
            'course_id' => $request->course_id
        ]);

        return redirect()->route('absents.index')->with('success','Absent created successfully.');
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
        $request->validate([
            'created_at' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'course_id' => 'required'
        ]);

        $user = User::find(1)->first();
        $absent->update([
            'created_at' => $user->created_at,
            'status' => $request->status,
            'user_id' => $user->id,
            'course_id' => $request->course_id
        ]);

        return redirect()->route('absents.index')->with('success','Absent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absent $absent)
    {
        $absent->delete();
        return redirect()->route('absents.index')
                        ->with('success','Absent deleted successfully');
    }
}
