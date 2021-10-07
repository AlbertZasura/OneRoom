<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::with('users')->latest()->get();
        return view('classes.index', [
            'classes' => $classes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('messages.create');
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

        Classes::create($request->all());

        return redirect()->route('classes.index')->with('success','Class created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        $classes = Classes::with('users')->latest()->get();
        return view('classes.show', ['class' => $class, 'classes' => $classes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        
        return view('messages.edit', ['classes' => $classes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $classes)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $classes->update($request->all());
        return redirect()->route('classes.index')->with('success','Classes updated successfully.');
    }

    public function user_list(Classes $class)
    {
        $users = User::doesntHave('classes')->where('role','!=','0')->get();
        return view('classes.assign_user', [
            'class' => $class,
            'users' => $users,
        ]);
    }

    public function assign_user(Request $request,Classes $class,User $user )
    {
        $type=$request->input('type');
        if ($type==='attach') {
            $class->users()->attach($user);
        }else if ($type==='detach') {
            $class->users()->detach($user);
        }
        return redirect()->route('classes.show',$class->id)->with('success','Kelas berhasil dirubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success','Class deleted successfully');
    }
}
