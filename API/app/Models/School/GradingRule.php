<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use App\Models\School\Subject;
use App\Models\School\ClassType;
use App\Models\School\Assessment;
use App\Models\School\SubjectActivityType;
class GradingRule extends Model
{
    protected $fillable = [
        "grade_id",
        "cur_id",
        "subject_id",
        "class_type_id",
        "subject_activity_type_id",
        "percentage",
        "max_score",
        "year_id",
        "term_id",
    ];

    //grading rule belongs to subject
    public function subject (){
        return $this->belongsTo(Subject::class,'subject_id');
    }

    //grading rule belongs to class type
    public function classType (){
        return $this->belongsTo(ClassType::class,'class_type_id');
    }

    //grading rule has many assessment items
    public function assessments(){
        return $this->hasMany(Assessment::class,'grading_rule_id');
    }

    // grading rule belongs to activity type
    public function activityType (){
        return $this->belongsTo(SubjectActivityType::class,'subject_activity_type_id');
    }
}
