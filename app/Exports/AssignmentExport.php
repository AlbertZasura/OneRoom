<?php

namespace App\Exports;

use App\Models\Assignment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AssignmentExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    
    public function view(): View
    {
        return view('assignments.export', [
            'users' => Assignment::where('id',$this->id)->first()->users
        ]);
    }
}
