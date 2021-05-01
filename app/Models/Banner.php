<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'gallery_path',
        'status'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];
}
