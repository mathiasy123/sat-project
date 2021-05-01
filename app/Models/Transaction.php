<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'code', 
        'total', 
        'courier_cost',
        'status',
        'payment_receipt',
        'order_id',
        'customer_id'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Relations
    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    // Accessors
    public function getStatusAttribute($value) {
        if($value == 0) {
            return 'GAGAL';
        } elseif($value == 1) {
            return 'SUKSES';
        } elseif($value == 2) {
            return 'PENDING';
        } elseif($value == 3) {
            return 'SUDAH BAYAR';
        } else {
            return 'KIRIM';
        }
    }
}
