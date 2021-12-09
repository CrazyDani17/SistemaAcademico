<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassTypology;
use App\Models\AssociateProfessor;

class ClassTypologyController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');
        $options = ClassTypology::query();
        $typology_ids = [];

        if (! $form['associate_professor']) {
            return [];
        }

        // if a category has been selected, only show articles in that category
        if ($form['associate_professor']) {
            $associate_professor = AssociateProfessor::find($form['associate_professor']);
            foreach($associate_professor->associate_subject->class_typology_hour as $class_typology_hour){
                $typology_ids[] = $class_typology_hour->class_typology->id;
            }
            
            $options = $options->whereIn('id', $typology_ids);
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