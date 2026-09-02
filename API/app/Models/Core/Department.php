<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name_kh',
        'name_en',
        'is_active',
    ];
}
