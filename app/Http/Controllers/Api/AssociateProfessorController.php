<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\AssociateProfessor;
use App\Models\AcademicCourse;

class AssociateProfessorController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');
        $options = AssociateProfessor::query();

        if (! $form['academic_course']) {
            return [];
        }

        // if a category has been selected, only show articles in that category
        if ($form['academic_course']) {
            $options = $options->where('academic_course_id', $form['academic_course']);
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
        return AssociateProfessor::find($id);
    }

}