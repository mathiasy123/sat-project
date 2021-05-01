<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 
        'name', 
        'price',
        'description',
        'weight',
        'stock',
        'category_id'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Relations
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'category_id');
    }

    public function galleries() {
        return $this->hasMany(ProductGallery::class, 'product_id');
    }

    public function firstGallery() {
        return $this->hasOne(ProductGallery::class, 'product_id');
    }

    public function getFirstImage() {
        return $this->galleries()->first();
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
