<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class ScoreMonthHeader extends Model
{
    protected $table = 'score_month_headers';

    protected $fillable = [
        'class_id',
        'month_id',
        'year_id',
        'cur_id',
        'divisor',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'divisor' => 'float',
    ];
}
