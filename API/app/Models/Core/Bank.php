<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name_kh',
        'name_en',
        'swift_bic',
        'image_path',
        'is_active',
    ];
}
