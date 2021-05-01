<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 
        'quantity', 
        'courier',
        'product_id',
        'buyer_id',
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Relations
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function buyer() {
        return $this->belongsTo(Buyer::class, 'buyer_id', 'id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class, 'order_id');
    }
    
    // Accessors
    public function getCourierAttribute($value) {
        return strtoupper($value);
    }
}
