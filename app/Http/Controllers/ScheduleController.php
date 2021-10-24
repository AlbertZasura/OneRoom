<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedulesChart(){
        $schedules = Schedule::whereIn('class_id',Auth::user()->classes->pluck('id'));
        return view('schedules.chart', [
            'schedules' => $schedules->get(),
            'schedules_group' => $schedules->get()->groupBy('date'),
            'current' => $schedules->whereDate('date',now())->whereTime('start_time','>',now())->orderBy('start_time')->get()
        ]);
    }
    
     public function listClass(){
        return view('schedules.list_class', [
            'classes' => Classes::latest()->filter(request(['search']))->get()
        ]);
    }

     public function index(Classes $class)
    {
        $schedules = Schedule::where('class_id',$class->id)->filter(request(['course','weekday']))->orderBy('date')->get();
        return view('schedules.index', [
            'schedules' => $schedules,
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
        // return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Classes $class,Request $request)
    {
        $request->validate([
            'course' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        Schedule::create([
            'class_id' => $class->id,
            'course_id' => $request->course,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        return redirect()->route('classes.schedules.index', $class)->with('success',"Jadwal kelas {$class->name} berhasil dibuat!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        // return view('messages.show', ['schedule' => $schedule]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        // return view('messages.edit', ['schedule' => $schedule]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Classes $class, Schedule $schedule,Request $request)
    {
        $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        $schedule->update([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        return redirect()->route('classes.schedules.index', $class)->with('success',"Jadwal kelas {$class->name} untuk Mata Pelajaran {$schedule->course->name} berhasil dirubah!");
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class, Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('classes.schedules.index', $class)->with('success',"Jadwal kelas {$class->name} berhasil dihapus!");
    }
}
