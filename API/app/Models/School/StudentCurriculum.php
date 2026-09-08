<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Support\Facades\Auth;

class StudentCurriculum extends Model
{
    protected $table = 'student_curriculums';
    protected $fillable = [
        'student_id',
        'curriculum_id',
        'branch_id',
        'student_card_id',
        "is_graduate",
        "is_transfer",
        "rfid",
        "description",
        "start_date",
        "end_date",
        'is_active',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }


    #[Scope]
    public function whereBranch($query, $branchId)
    {
        return $query
            ->when($branchId && $branchId !== '*', function ($q) use ($branchId) {
                $q->where('student_curriculums.branch_id', $branchId);
            })
            ->when($branchId === '*' && Auth::user()?->manage_branch == 2, function ($q) {
                $q->whereExists(function ($sub) {
                    $sub->selectRaw(1)
                        ->from('user_branches as ub')
                        ->whereColumn('ub.branch_id', 'student_curriculums.branch_id')
                        ->where('ub.user_id', Auth::id());
                });
            });
    }
    #[Scope]
    public function whereCurriculum($query, $curriculumId)
    {
        return $query->when($curriculumId && $curriculumId !== '*', function ($q) use ($curriculumId) {
            $q->where('student_curriculums.curriculum_id', $curriculumId);
        });
    }

    #[Scope]
    public function filter($query, $filters)
    {
        return $query->when(!empty($filters['search']), function ($q) use ($filters) {
            $search = $filters['search'];
            $q->whereHas('student', function ($sub) use ($search) {
                $sub->where(function ($inner) use ($search) {
                    $inner->where('name_en', 'like', "%{$search}%")
                        ->orWhere('name_kh', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('student_card_id', 'like', "%{$search}%");
                });
            });
        });
    }

}
