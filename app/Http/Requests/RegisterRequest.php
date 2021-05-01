<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.numeric' => 'Nomor telepon harus dalam bentuk angka',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus dalam format email',
            'email.unique' => 'Email ini sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password harus sama dengan password'
        ];
    }
}
