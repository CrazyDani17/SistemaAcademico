<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCurriculumRequest extends FormRequest
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
            'name' => 'required|unique:App\Models\Curriculum,name,'.$Id,
            'year_of_creation' => 'required',
            'number_of_years' => 'required',
            'number_of_semesters' => 'required'
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
