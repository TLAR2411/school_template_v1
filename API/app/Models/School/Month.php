<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table = 'months';
    protected $fillable = [
        'name_en',
        'name_kh',
        'code'
    ];
}
