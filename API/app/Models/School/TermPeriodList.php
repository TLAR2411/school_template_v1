<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class TermPeriodList extends Model
{
    protected $table = 'term_period_list';
    protected $fillable = [
        'month_id',
        'term_period_id',
        'grade_id',
        'role',
        'year_id',
        'branch_id',
        'cur_id',
        'created_by',
        'updated_by'

    ];
}
