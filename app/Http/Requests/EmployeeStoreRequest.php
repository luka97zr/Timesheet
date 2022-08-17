<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'name'  => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'status'=> ['required', 'boolean'],
            'role_id'=> ['required', 'exists:roles,id']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'User with that email already exists',
            'status.required' => 'Status is required',
            'status.boolean' => 'Status value is wrong',
            'role_id.required' => 'Role is required',
        ];
    }
}
