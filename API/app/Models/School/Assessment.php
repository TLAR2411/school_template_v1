<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use App\Models\School\GradingRule;
class Assessment extends Model
{
    protected $fillable = [
        "ass_name",
        "subject_id",
        "grading_rule_id",
        "max_score",
    ];

    //assessment belongs to grading rule
    public function gradingRule (){
        return $this->belongsTo(GradingRule::class,'grading_rule_id');
    }
}
