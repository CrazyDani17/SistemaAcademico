<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Shift;
use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
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
        $routeSegmentWithId = empty(config('backpack.base.route_prefix')) ? '2' : '3';

        $Id = $this->get('id') ?? \Request::instance()->segment($routeSegmentWithId);
        
        return [
            'name' => 'required', 
            'acronym' => 'required', 
            'order' => 'required',
            //'star_time' => 'required',
            'star_time'=> ['required',function ($attribute, $value, $fail) {
                $start_times = Shift::get('star_time')->toArray();
                $end_times = Shift::get('end_time')->toArray();

                for($i=0; $i< sizeof($start_times); $i++){
                    if (strtotime(implode($start_times[$i]))<strtotime($value) && strtotime($value)<strtotime(implode($end_times[$i]))) {
                        $fail('La hora de inicio se solapa.');
                    }
                }
            },],
            'end_time' => ['required',function ($attribute, $value, $fail) {
                $start_times = Shift::get('star_time')->toArray();
                $end_times = Shift::get('end_time')->toArray();

                for($i=0; $i< sizeof($start_times); $i++){
                    if (strtotime(implode($start_times[$i]))<strtotime($value) && strtotime($value)<strtotime(implode($end_times[$i]))) {
                        $fail('La hora de fin se solapa.');
                    }
                }
            },],
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
