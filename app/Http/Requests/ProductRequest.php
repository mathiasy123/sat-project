<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name,' . $this->product . '|max:50',
            'price' => 'required|numeric',
            'description' => 'required',
            'weight' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required'
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
            'name.required' => 'Nama produk wajib diisi',
            'name.unique' => 'Nama produk ini sudah terdaftar',
            'name.max' => 'Nama produk maksimal hanya 100 karakter',
            'price.required' => 'Harga produk wajib diisi',
            'price.numeric' => 'Harga produk harus dalam bentuk angka',
            'description.required' => 'Deskripsi produk wajib diisi',
            'weight.required' => 'Berat produk wajib diisi',
            'weight.numeric' => 'Berat produk harus dalam bentuk angka',
            'stock.required' => 'Stok produk wajib diisi',
            'stock.numeric' => 'Stok produk harus dalam bentuk angka',
            'category_id.required' => 'Kategori produk wajib dipilih'
        ];
    }
}
