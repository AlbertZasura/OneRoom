<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->limit(3)->get();
        $schedules = Schedule::with(['class','course'])->whereIn('class_id',Auth::user()->classes->pluck('id'))->whereDate('date',now())->whereTime('start_time','>',now())->orderBy('start_time')->get();
        return view('dashboard', [
            'messages' => $messages,
            'schedules' => $schedules
        ]);
    }
}
