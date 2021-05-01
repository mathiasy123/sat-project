<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
        'name', 
        'phone', 
        'address',
        'email'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Relations
    public function orders() {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    // Mutators
    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    // Accessors
    public function getNameAttribute($value) {
        return ucwords($value);
    }

    public function getAddressAttribute($value) {
        return ucwords($value);
    }
}
