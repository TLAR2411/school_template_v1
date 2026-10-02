<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class ScoreEntrySetting extends Model
{
    protected $table = 'score_entry_settings';

    protected $fillable = [
        'year_id',
        'cur_id',
        'branch_id',
        'cutoff_day',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'cutoff_day' => 'integer',
        'is_active'  => 'boolean',
    ];
}
