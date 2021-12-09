<?php

namespace App\Exports;

use App\Models\Schedule;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

//class ScheduleExport implements FromCollection
class ScheduleExport implements FromView, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return Schedule::all();
    }*/

    public function __construct($curriculum,$academic_year,$academic_semester,$shifts)
    {
        $this->curriculum = $curriculum;
        $this->academic_year = $academic_year;
        $this->academic_semester = $academic_semester;
        $this->shifts = $shifts;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 30,  
            'C' => 30, 
            'D' => 30,   
            'E' => 30,  
            'F' => 30, 
            'G' => 30,           
        ];
    }


    public function view(): View
    {
        return view('schedule.excel', [
            'curriculum' => $this->curriculum,
            'academic_year' => $this->academic_year,
            'academic_semester' => $this->academic_semester,
            'curriculum_id' => $this->curriculum->id,
            'academic_year_id' => $this->academic_year->id,
            'academic_semester_id' => $this->academic_semester->id,
            'shifts' => $this->shifts,
        ]);
    }
}
