<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'gender'                 => 'required|numeric',
            'name'                   => 'required|max:255|unique:shaadi_customers,name',
            'first_name'             => 'required|max:255',
            'last_name'              => 'required|max:255',
            'mobile'                 => 'required|max:255|unique:shaadi_customers,mobile',
            'country_id'             => 'required|numeric',
            'city_id'                => 'required|numeric',
            'state_id'               => 'required|numeric',
            'DOB'                    => 'required|date_format:Y-m-d',
            'email'                  => 'required|email|max:255|unique:shaadi_customers,email',
            'password'               => 'required|min:6',
            'RegistrationsReasonsID' => 'required|numeric',
            'MaritalStatusID'        => 'required|numeric',
            'second_marraige'        => 'required|numeric',
            'read_policy'            => 'required'
        ];
    }
}
