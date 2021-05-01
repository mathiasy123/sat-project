<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = [
        'customer_name',
        'testimony',
        'status'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Mutators
    public function setCustomerNameAttribute($value) {
        $this->attributes['customer_name'] = strtolower($value);
    }

    public function setTestimonyAttribute($value) {
        $this->attributes['testimony'] = strtolower($value);
    }

    // Accessors
    public function getCustomerNameAttribute($value) {
        return ucwords($value);
    }

    public function getTestimonyAttribute($value) {
        return ucfirst($value);
    }
}
