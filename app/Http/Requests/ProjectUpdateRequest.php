<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'client_id' => ['required', 'exists:clients,id'],
            'lead_id'   => ['required', 'exists:leads,id'],
            'name'      => ['required'],
            'status'    => ['boolean']
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'Client field is required',
            'lead_id.required' => 'Lead field is required',
            'client_id.exists' => 'Please select valid client',
            'lead_id.exists' => 'Please select valid lead',
            'name.required' => 'Name is required',
        ];
    }
}
