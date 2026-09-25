<?php

namespace App\Models\School;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'name_en',
        'name_kh',
        'gender',
        'dob',
        'email',
        'phone',
        'nation',
        'photo_path',
        'is_active',
        'is_teaching',
        'cur_id',
        'manage_branch',
        'village_code',
        'commune_code',
        'district_code',
        'province_code',
        'created_by',
        'updated_by',
        'user_id',
        'manage_branch',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        // do NOT hide address codes if edit needs them
    ];

    public function teacherBranches()
    {
        return $this->hasMany(TeacherBranch::class, 'teacher_id', 'id');
    }

    #[Scope]
    public function whereBranch($query, string $branchId)
    {
        // Specific branch selected in header (X-Branch-Id)
        $query->when($branchId != '*', function ($query) use ($branchId) {
            $query->where(function ($q) use ($branchId) {
                // manage_branch = 1 → use users.branch_id
                $q->whereExists(function ($sub) use ($branchId) {
                    $sub->selectRaw(1)
                        ->from('users')
                        ->whereColumn('users.id', 'teachers.user_id')
                        ->where('users.manage_branch', 1)
                        ->where('users.branch_id', $branchId)
                        ->whereNull('users.deleted_at');
                })
                    // manage_branch = 2 → use user_branches (shows in every assigned branch)
                    ->orWhereExists(function ($sub) use ($branchId) {
                        $sub->selectRaw(1)
                            ->from('user_branches as ub')
                            ->whereColumn('ub.user_id', 'teachers.user_id')
                            ->where('ub.branch_id', $branchId);
                    });
            });
        })
            // "*" + logged-in user is multi-branch → only teachers in their branches
            ->when($branchId == '*' && Auth::user()?->manage_branch == 2, function ($query) {
                $query->where(function ($q) {
                    $q->whereExists(function ($sub) {
                        $sub->selectRaw(1)
                            ->from('users')
                            ->join('user_branches as my_ub', 'my_ub.branch_id', 'users.branch_id')
                            ->whereColumn('users.id', 'teachers.user_id')
                            ->where('users.manage_branch', 1)
                            ->where('my_ub.user_id', Auth::id())
                            ->whereNull('users.deleted_at');
                    })
                        ->orWhereExists(function ($sub) {
                            $sub->selectRaw(1)
                                ->from('user_branches as tb_ub')
                                ->join('user_branches as my_ub', 'my_ub.branch_id', 'tb_ub.branch_id')
                                ->whereColumn('tb_ub.user_id', 'teachers.user_id')
                                ->where('my_ub.user_id', Auth::id());
                        });
                });
            });
    }

    #[Scope]
    public function filter($query, $filters)
    {
        return $query->when(!empty($filters['search']), function ($q) use ($filters) {
            $q->where(function ($query) use ($filters) {
                $query->where('name_kh', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('name_en', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
            });
        });
    }

    #[Scope]
    public function whereCur($query, $curId)
    {
        return $query->when($curId != '*', function ($query) use ($curId) {
            $query->where('cur_id', $curId);
        });
    }

    public static function boot()
    {
        parent::boot();

        // Ensure the photo is deleted only when the model is deleted
        static::deleting(function ($item) {
            if ($item->photo_path) {
                // photo_path is saved as "storage/..." but the public disk expects the relative path
                Storage::disk('public')->delete(preg_replace('/^storage\//', '', $item->photo_path));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
