<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
//use Backpack\NewsCRUD\app\Models\Address;
use App\Models\AssociateSubject;
use App\Models\AcademicYear;
use App\Models\Curriculum;

class AcademicYearController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');
        $associate_subjects = AssociateSubject::query();

        if (! $form['curriculum']) {
            return [];
        }

        // if a category has been selected, only show articles in that category
        if ($form['curriculum']) {
            $academic_years = $associate_subjects->where('curriculum_id', $form['curriculum'])->get('academic_year_id');
            $options = $academic_years;
            /*for($i;$i<sizeof($academic_years);$i++){
                
            }*/
        }

        // if a search term has been given, filter results to match the search term
        if ($search_term) {
            $results = $options->where('name', 'LIKE', '%'.$search_term.'%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }


        return $options->paginate(10);
    }

    public function show($id)
    {
        return AcademicYear::find($id);
    }

}