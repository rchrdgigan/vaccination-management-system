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
            'vaccine_id' => 'nullable',
            'vacc_dose_id' => 'nullable',
            'has_inj' => 'nullable',
            'inj_date' => 'nullable',
            'status' => 'nullable',
            'reason' => 'nullable',
        ];
    }
}
