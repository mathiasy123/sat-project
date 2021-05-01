<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'code', 
        'name', 
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Relations
    public function products() {
        return $this->hasMany(Product::class, 'category_id');
    }

    // Mutators
    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    // Accessors
    public function getNameAttribute($value) {
        return ucwords($value);
    }
}
