<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;

class TermPeriod extends Model
{
    protected $table = 'term_periods';
    protected $fillable = [
        'name_en',
        'name_kh',
        'cur_id',
        'branch_id',
        'start_date',
        'year_id',
        'end_date',
        'created_by',
        'updated_by',
    ];

    public function lists()
    {
        return $this->hasMany(TermPeriodList::class, 'term_period_id');
    }
    #[Scope]
    public function filter($query, $filters)
    {
        return $query
            ->when(!empty($filters['search']), function ($q) use ($filters) {
                $search = $filters['search'];
                $q->where(function ($inner) use ($search) {
                    $inner->where('name_en', 'like', "%{$search}%")
                        ->orWhere('name_kh', 'like', "%{$search}%");
                });
            })
            ->when(!empty($filters['year_id']), fn ($q) => $q->where('year_id', $filters['year_id']))
            ->when(!empty($filters['cur_id']), fn ($q) => $q->where('cur_id', $filters['cur_id']));
    }
    #[Scope]
    public function whereBranch($query, $branchId)
    {
        return $query->when($branchId && $branchId !== '*', function ($q) use ($branchId) {
            $q->where('branch_id', $branchId);
        });
    }
}
