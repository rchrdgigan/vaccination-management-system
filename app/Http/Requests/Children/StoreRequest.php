<?php

namespace App\Http\Requests\Children;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'child_name' => ['required'],
            'mother_name' => ['required'],
            'father_name' => ['required'],
            'reg_date' => ['required'],
            'birth_date' => ['required'],
            'birth_place' => ['required'],
            'weight' => ['required'],
            'height' => ['required'],
            'brgy_id' => ['required', 'exists:barangays,id'],
            'gender' => ['required'],
        ];
    }
}
