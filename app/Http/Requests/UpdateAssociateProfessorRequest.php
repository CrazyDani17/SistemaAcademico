<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Validation\Rule;
use App\Models\AssociateProfessor;

class UpdateAssociateProfessorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'associate_subject' => 'required',
            'professors' => 'required',
            'academic_course' => ['required',function ($attribute, $value, $fail) {
                $associate_professors_array = AssociateProfessor::all()->toArray();
                $routeSegmentWithId = empty(config('backpack.base.route_prefix')) ? '2' : '3';
                $Id = $this->get('id') ?? \Request::instance()->segment($routeSegmentWithId);
                //$associate_subjects = AssociateSubject::all();
                //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
                //$out->writeln($associate_subjects_array[0]);
                $full_name = $this->associate_subject . "-" . $value;
                for($i=0; $i< sizeof($associate_professors_array); $i++){
                    //$other_full_name = $associate_subjects_array[$i][0] . "-" . $associate_subjects_array[$i][1] . "-" . $associate_subjects_array[$i][2]. "-". $associate_subjects_array[$i][4];
                    $associate_professor = implode(",", $associate_professors_array[$i]);
                    $associate_professor = explode(",", $associate_professor);
                    $other_full_name = $associate_professor[1] . "-" . $associate_professor[2];
                    if($associate_professor[0]!=$Id){
                        if ($full_name == $other_full_name) {
                            $fail('Este curso ya fue asignado.');
                        }
                    }
                }
            },],
            //'subject_id' => [Rule::unique('associate_subjects')->where('academic_semester_id',$this->academic_semester_id)]
            //'academic_semester_id' => ['required',Rule::unique('associate_subjects')->where('subject_id',$this->subject_id)]
            //'academic_semester_id' => 'required|unique:associate_subjects, academic_semester_id, NULL, NULL, subject_id, ' . $this->subject_id,
            //'subject_id' => 'required|unique:associate_subjects, subject_id, NULL, NULL, academic_semester_id, ' . $this->academic_semester_id,
            //'subject_id' => 'unique:academic_years',
            //'name' => 'required|unique:academic_years',
            // 'name' => 'required|min:5|max:255'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
