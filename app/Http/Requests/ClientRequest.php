<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'country_id' => ['required', 'exists:countries,id'],
            'name'       => ['required', 'unique:clients,name']
        ];
    }

    public function messages() {
        return [
            'country_id.required' => 'Country is required',
            'name.required' => 'Name is required',
        ];
    }
}
