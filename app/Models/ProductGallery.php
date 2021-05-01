<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = [
        'gallery_path',
        'status',
        'product_id'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    // Relations
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // Mutators
    public function setNameAttribute($value) {
        $this->attributes['gallery_path'] = strtolower($value);
    }
}
