<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[A-Z][a-z]{1,13}$/'],
            'last_name' => ['required', 'regex:/^([A-Z][a-z]{1,30}\s?)+$/'],
            'email' => 'required|email',
            'address' => 'required',
            'password' => 'required|min:8',
            'active' => 'required',
            'role_id' => 'required|exists:roles,id'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'name.max' => 'Name must not be longer than :max characters.',
            'name.regex' => 'Name must start with a capital letter!',
            'last_name.regex' => 'Last name must start with a capital letter!',
            'last_name.max' => 'Last name must not be longer than :max characters.',
            'password.min' => 'Password must have al least 8 characters',
            'role_id.exists' => 'Selected role does not exist in the database.'
        ];
    }
}
