<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';
    protected $fillable = [
        'name_en',
        'name_kh',
        'code',
        'hour_start',
        'hour_end',
        'break_start',
        'break_end',
    ];
}
