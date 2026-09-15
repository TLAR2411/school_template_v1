<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'days';
    protected $fillable = [
        'name_en',
        'short',
        'name_kh'
    ];
}
