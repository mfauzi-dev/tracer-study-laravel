<?php

namespace App\Http\Requests\Alumni;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'company_name' => ['required', 'string', 'min:4', 'max:255'],
            'company_address' => ['required', 'string', 'min:6', 'max:255'],
            'domisili_address' => ['required', 'string', 'min:4', 'max:255'],
            'position' => ['required', 'string', 'min:4', 'max:255'],
            'provinsi' => ['required'],
            'kabupaten' => ['required'],
            'longitude' => ['required'],
            'latitude' => ['required']
        ];
    }
}
