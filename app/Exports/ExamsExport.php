<?php

namespace App\Exports;

use App\Models\Exam;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExamsExport implements  FromView, ShouldAutoSize, WithStrictNullComparison
{
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exams.export', [
            'users' => Exam::where('id',$this->id)->first()->users
        ]);
    }
}
