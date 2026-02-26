<?php

namespace App\Http\Requests\Alumni;

use Illuminate\Foundation\Http\FormRequest;

class BiodataRequest extends FormRequest
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
            // 'prodi' => ['required'],
            // 'fakultas' => ['required'],
            'image' => ['required', 'image', 'mimes:jpg,png,svg'],
            'tempat_lahir' => ['required', 'string', 'min:4', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string', 'min:6', 'max:255'],
            'telepon' => ['required', 'string', 'min:8', 'max:15'],
            'jenis_kelamin' => ['required', 'string', 'max:50'],
            'nama_gelar' => ['required', 'string', 'min:2', 'max:50'],
            'ipk' => ['required', 'string', 'min:3', 'max:6'],
            'angkatan' => ['required', 'string', 'min:4', 'max:20'],
        ];
    }
}
