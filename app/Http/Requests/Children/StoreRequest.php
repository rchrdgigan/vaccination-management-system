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
            'family_no' => ['required'],
            'child_name' => ['required'],
            'mother_name' => ['required'],
            'father_name' => ['required'],
            'reg_date' => ['required'],
            'birth_date' => ['required'],
            'birth_place' => ['required'],
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'gender' => ['required'],
            'address' => ['required'],
        ];
    }
}
