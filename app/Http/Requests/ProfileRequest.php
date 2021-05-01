<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'sometimes',
            'phone' => 'sometimes|numeric',
            'address' => 'sometimes',
            'gallery' => 'sometimes|file|image|mimes:jpeg,jpg,png|max:2048',
            'email' => 'sometimes|required|email'
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
            'name.sometimes' => 'Nama diperlukan',
            'phone.sometimes' => 'Telepon diperlukan',
            'phone.numeric' => 'Telepon harus dalam bentuk angka',
            'address.sometimes' => 'Alamat wajib diisi',
            'gallery.sometimes' => 'Gambar profil wajib diisi',
            'gallery.file' => 'Gambar profil harus berupa file',
            'gallery.image' => 'Gambar profil produk harus dalam bentuk gambar',
            'gallery.mimes' => 'Gambar profil produk harus berekstensi jpeg/jpg/png',
            'gallery.max' => 'Gambar profil produk maksimal berukuran 2MB',
            'email.sometimes' => 'Email diperlukan',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus dalam format email'
        ];
    }
}
