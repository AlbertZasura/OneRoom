<?php

namespace App\Exports;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsentsExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $schedule = $this->filters['schedule'] ? Schedule::findOrFail($this->filters['schedule']) : "";
        $role = Auth::user()->role;
        switch($role){
            case 'teacher':
                $users = $schedule->class->students()->filter($this->filters);
                break;
            case 'admin':
                $users = User::where('role',1)->filter($this->filters);
                break;
        }
        return view('Absents.export', [
            'schedule' => $schedule,
            'users' => $users->get(),
            'role' => $role
        ]);
    }
}
