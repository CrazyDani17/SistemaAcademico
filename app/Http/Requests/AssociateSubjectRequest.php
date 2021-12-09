<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Validation\Rule;
use App\Models\AssociateSubject;

class AssociateSubjectRequest extends FormRequest
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
            'curriculum' => 'required',
            'academic_year' => 'required',
            'academic_semester' => 'required',
            'subject' => ['required',function ($attribute, $value, $fail) {
                $associate_subjects_array = AssociateSubject::all()->toArray();
                //$associate_subjects = AssociateSubject::all();
                //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
                //$out->writeln($associate_subjects_array[0]);
                $full_name = $this->curriculum . "-" . $this->academic_year. "-". $this->academic_semester."-". $value;
                for($i=0; $i< sizeof($associate_subjects_array); $i++){
                    //$other_full_name = $associate_subjects_array[$i][0] . "-" . $associate_subjects_array[$i][1] . "-" . $associate_subjects_array[$i][2]. "-". $associate_subjects_array[$i][4];
                    $associate_subject = implode(",", $associate_subjects_array[$i]);
                    $associate_subject = explode(",", $associate_subject);
                    $other_full_name = $associate_subject[1] . "-" . $associate_subject[2] . "-" . $associate_subject[3]. "-". $associate_subject[4];
                    if ($full_name == $other_full_name) {
                        $fail('Esta asignatura ya fue asignada.');
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
