<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'order.product_id' => 'present',
            'price' => 'present',
            'province_origin' => 'present',
            'city_origin' => 'present',
            'buyer.name' => 'required',
            'buyer.phone' => 'required|numeric',
            'buyer.address' => 'required',
            'buyer.email' => 'required|email',
            'order.quantity' => 'required|numeric',
            'weight' => 'sometimes|required|numeric',
            'province_id' => 'required',
            'city_id' => 'required',
            'order.courier' => 'required',
            'transaction.courier_cost' => 'required'
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
            'order.product_id.present' => 'Informasi produk diperlukan',
            'price.present' => 'Harga produk diperlukan',
            'province_origin.present' => 'Provinsi asal diperlukan',
            'city_origin.present' => 'Kota asal diperlukan',
            'buyer.name.required' => 'Nama wajib diisi',
            'buyer.phone.required' => 'Nomor telepon wajib diisi',
            'buyer.phone.numeric' => 'Nomor telepon harus dalam bentuk angka',
            'buyer.address.required' => 'Alamat wajib diisi',
            'buyer.email.required' => 'Email wajib diisi',
            'buyer.email.email' => 'Email harus dalam format email',
            'quantity.required' => 'Jumlah pesanan wajib diisi',
            'weight.required' => 'Berat produk wajib diisi',
            'weight.numeric' => 'Berat produk harus dalam bentuk angka (gram)',
            'order.quantity.required' => 'Jumlah pesanan wajib diisi',
            'order.quantity.numeric' => 'Jumlah pesanan harus dalam bentuk angka',
            'province_id.required' => 'Provinsi tujuan wajib diisi',
            'city_id.required' => 'Kota tujuan wajib diisi',
            'order.courier.required' => 'Jasa ekspedisi wajib diisi',
            'transaction.courier_cost.required' => 'Layanan ekspedisi wajib diisi',
        ];
    }
}
