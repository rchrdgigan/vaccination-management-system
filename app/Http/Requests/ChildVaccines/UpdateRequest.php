<?php

namespace App\Http\Requests\ChildVaccines;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'has_inj_1st_dose' => 'nullable',
            'has_inj_2nd_dose' => 'nullable',
            'has_inj_3rd_dose' => 'nullable',
            'inj_1st_date' => 'nullable',
            'inj_2nd_date' => 'nullable',
            'inj_3rd_date' => 'nullable',
            'status' => 'nullable',
        ];
    }
}
