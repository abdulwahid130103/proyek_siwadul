<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'nama' => ['required'],
            'email' => ['required'],
            'kd_jabatan' => ['required'],
            'kode_user' => ['required'],
            'alamat' => ['required'],
            'STATUS' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Kolom nama wajib diisi!',
            'email.required' => 'Kolom email wajib diisi!',
            'kd_jabatan.required' => 'Kolom kd_jabatan wajib diisi!',
            'kode_user.required' => 'Kolom kode_user wajib diisi!',
            'alamat.required' => 'Kolom alamat wajib diisi!',
            'STATUS.required' => 'Kolom STATUS wajib diisi!'
        ];
    }
}
