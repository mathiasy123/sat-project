<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = [
        'first_paragraph',
        'second_paragraph',
        'status'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];
}
