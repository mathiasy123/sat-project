<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'name', 
        'phone', 
        'address',
        'gallery',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'created_at', 
        'updated_at'
    ];

    // Relations
    public function transactions() {
        return $this->hasMany(Transaction::class, 'customer_id');
    }

    // Mutators
    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    // Accessors
    public function getNameAttribute($value) {
        return ucwords($value);
    }

    public function getAddressAttribute($value) {
        return ucwords($value);
    }
}
