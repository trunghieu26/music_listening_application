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
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'name' => 'required',
            'gender' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'name.required' => 'Name is required',
            'gender.required' => 'Gender is required',
        ];
    }
}
