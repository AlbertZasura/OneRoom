<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch(Auth::user()->role){
            case 'teacher':
                $classes = Auth::user()->classes;
                break;
            case 'admin':
                $classes = Classes::with('users')->latest()->get();
                break;
            default:
                $classes = Auth::user()->classes;
                break;

        }
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
        switch(Auth::user()->role){
            case 'teacher':
                $classes = Auth::user()->classes;
                break;
            case 'admin':
                $classes = Classes::with('users')->latest()->get();
                break;
        }
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
        
        // return view('messages.edit', ['classes' => $classes]);
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
        $this->authorize('user_list', Classes::class);
        $users = User::where( function (Builder $query) use ($class){
            $query->where('role',1)->where( function (Builder $q) use ($class){
                $q->whereRelation('classes','classes.id','!=',$class->id)->orDoesntHave('classes');
            });
        })->orWhere( function (Builder $query){
             $query->doesntHave('classes')->where('role',2);
        })->get();
        

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
