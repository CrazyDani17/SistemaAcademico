<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfessorRequest extends FormRequest
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
            'names' => 'required', 
            'last_name' => 'required', 
            'second_last_name' => 'required',
            //'email' => 'required',
            'email'=> 'required|unique:App\Models\Professor,email,'.$Id,
            'dni' => 'required|size:8', 
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