<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductGalleryRequest extends FormRequest
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
            'gallery_path' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
            'product_id' => 'required'
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
            'gallery_path.required' => 'Gambar produk wajib diupload',
            'gallery_path.file' => 'Gambar harus berupa file',
            'gallery_path.image' => 'Gambar produk harus dalam bentuk gambar',
            'gallery_path.mimes' => 'Gambar produk harus berekstensi jpeg/jpg/png',
            'gallery_path.max' => 'Gambar produk maksimal berukuran 2MB',
            'product_id.required' => 'Nama produk wajib dipilih'
        ];
    }
}
