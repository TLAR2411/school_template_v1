<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;
use App\Models\School\GradingRule;
class Subject extends Model
{
    protected $fillable = [
        'name_en',
        'name_kh',
        'name_cn',
        'parent_id',
        'symbol',
        'edu_id',
        'cur_id',
        'branch_id',
        'is_active',
    ];

    public function parent()
    {
        return $this->belongsTo(Subject::class, 'parent_id');
    }

    // Direct children of this subject
    public function children()
    {
        return $this->hasMany(Subject::class, 'parent_id');
    }

    #[Scope]
    public function whereBranch($query, $branchId)
    {
        return $query->when($branchId && $branchId !== '*', function ($q) use ($branchId) {
            $q->where('branch_id', $branchId);
        });
    }
    #[Scope]
    public function whereCurriculum($query, $curriculumId)
    {
        return $query->when($curriculumId && $curriculumId !== '*', function ($q) use ($curriculumId) {
            $q->where('cur_id', $curriculumId);
        });
    }



    #[Scope]
    public function filter($query, $filters)
    {
        return $query
            ->when(!empty($filters['search']), function ($q) use ($filters) {
                $q->where(function ($query) use ($filters) {
                    $query->where('name_kh', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('name_en', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('symbol', 'like', '%' . $filters['search'] . '%');
                });
            })
            ->when(!empty($filters['edu_id']), function ($q) use ($filters) {
                $q->where('edu_id', $filters['edu_id']);
            });
    }


    //subject has many grading rule 
    public function gradingRules (){
        return $this->hasMany(GradingRule::class,'subject_id');
    }
}
