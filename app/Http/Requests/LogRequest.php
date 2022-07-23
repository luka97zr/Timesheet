<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data.*.date'          => ['required','date_format:Y-m-d'],
            'data.*.hours'         => ['required','numeric','gt:0'],
            'data.*.description'   => ['max: 255','string','nullable'],
            'data.*.category_project_id'   => ['required'],
        ];
    }
}
