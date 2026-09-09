<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class StudentClass extends Model
{
    use SoftDeletes;

    protected $table = 'student_class';

    protected $fillable = [
        'student_id',
        'class_id',
        'sort',
        'rfid',
        'is_transfer_class',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
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
        'is_transfer_class' => 'boolean',
        'sort' => 'integer',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function studentCurriculum()
    {
        return $this->belongsTo(StudentCurriculum::class, 'student_id', 'student_id');
    }



    public function class()
    {
        // table is `classes`, model is Classes
        return $this->belongsTo(Classes::class, 'class_id');
    }

    #[Scope]
    public function whereClass($query, $classId)
    {
        return $query->when($classId, function ($q) use ($classId) {
            $q->where('student_class.class_id', $classId);
        });
    }

    #[Scope]
    public function whereBranch($query, $branchId)
    {
        return $query
            ->when($branchId && $branchId !== '*', function ($q) use ($branchId) {
                $q->whereHas('class', function ($c) use ($branchId) {
                    $c->where('branch_id', $branchId);
                });
            })
            ->when($branchId === '*' && Auth::user()?->manage_branch == 2, function ($q) {
                $q->whereHas('class', function ($c) {
                    $c->whereExists(function ($sub) {
                        $sub->selectRaw(1)
                            ->from('user_branches as ub')
                            ->whereColumn('ub.branch_id', 'classes.branch_id')
                            ->where('ub.user_id', Auth::id());
                    });
                });
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
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            });
        });
    }

  
}
