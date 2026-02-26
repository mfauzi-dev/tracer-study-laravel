<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DataUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'fakultas_id' => ['required'],
            'program_studi_id' => ['required'],
            'nomor_induk' => ['required', 'string', 'min:5', 'max:50'],
            'email' => ['required', 'string', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:25'],
            'role_as' => ['required', 'string']
        ];
    }
}
