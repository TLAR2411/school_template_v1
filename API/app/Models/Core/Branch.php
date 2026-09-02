<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Branch extends Model
{
    protected $fillable = [
        'name_kh',
        'name_en',
        'abbr',
        'contact',
        'house_no',
        'street',
        'village_code',
        'region',
        'start_date',
        'location',
        'bank_id',
        'account_name',
        'account_number'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    #[Scope]
    public function whereBranch($query, string $branchId)
    {
        $query->when($branchId != "*", function ($query) use ($branchId) {
            return $query->where('branches.id', $branchId);
        })
            ->when($branchId == "*" && Auth::user()->manage_branch == 2, function ($query) use ($branchId) {
                return $query->join("user_branches as ub", 'ub.branch_id', 'branches.id')
                    ->where('ub.user_id', Auth::id());
            })
            ->when($branchId == "*" && Auth::user()->manage_branch == 4, function ($query) {
                return $query->whereNotIn('branches.id', function ($subquery) {
                    $subquery->select('branch_id')
                        ->from('user_branches')
                        ->where('user_id', Auth::id());
                });
            });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
