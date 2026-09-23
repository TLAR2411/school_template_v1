<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScoreEntry extends Model
{
    use SoftDeletes;
    protected $table = 'scores';


    protected $fillable = [
        'student_id',
        'class_id',
        'subject_id',
        'month_id',
        'year_id',
        'grading_rule_id',
        'assessment_id',
        'score',
        'is_approved',
        'teacher_id',
        'branch_id',
        'cur_id',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'score' => 'float',
        'is_approved' => 'boolean',
    ];
}
