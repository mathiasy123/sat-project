<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'buyer_name' => 'present',
            'payment_receipt' => 'required|file|image|mimes:jpeg,jpg,png|max:2048'
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
            'buyer_name.present' => 'Nama pelanggan diperlukan',
            'payment_receipt.required' => 'Bukti pembayaran wajib diupload',
            'payment_receipt.file' => 'Bukti pembayaran harus berupa file',
            'payment_receipt.image' => 'Bukti pembayaran produk harus dalam bentuk gambar',
            'payment_receipt.mimes' => 'Bukti pembayaran produk harus berekstensi jpeg/jpg/png',
            'payment_receipt.max' => 'Bukti pembayaran produk maksimal berukuran 2MB',
        ];
    }
}
