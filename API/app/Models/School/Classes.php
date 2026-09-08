<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    use SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'name_en',
        'name_kh',
        'grade_id',
        'year_id',
        'branch_id',
        'room_id',
        'symbol',
        'description',
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
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
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
                $q->whereHas('grade', function ($g) use ($filters) {
                    $g->where('edu_id', $filters['edu_id']);
                });
            })
            ->when(!empty($filters['grade_id']), function ($q) use ($filters) {
                $q->where('grade_id', $filters['grade_id']);
            });
    }



    // class don't have field cur_id but have grade_id and table grade have field cur_id
    #[Scope]
    public function whereCurriculum($query, $curriculumId)
    {
        return $query->when($curriculumId && $curriculumId !== '*', function ($q) use ($curriculumId) {
            $q->whereHas('grade', function ($g) use ($curriculumId) {
                $g->where('cur_id', $curriculumId);
            });
        });
    }

    #[Scope]
    public function whereYear($query, $yearId)
    {
        return $query->when($yearId && $yearId !== '*', function ($q) use ($yearId) {
            $q->where('year_id', $yearId);
        });
    }
    #[Scope]
    public function whereBranch($query, $branchId)
    {
        return $query->when($branchId && $branchId !== '*', function ($q) use ($branchId) {
            $q->where('branch_id', $branchId);
        });
    }
}
