<?php

namespace App\Models\School;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'name_en', 'name_kh', 'gender', 'dob', 'email', 'phone', 'nation',
        'photo_path', 'is_active', 'is_teaching', 'cur_id', 'manage_branch',
        'village_code', 'commune_code', 'district_code', 'province_code',
        'created_by', 'updated_by',
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
        'created_by', 'updated_by', 'deleted_by',
        // do NOT hide address codes if edit needs them
    ];

   public function teacherBranches(){
    return $this->hasMany(TeacherBranch::class, 'teacher_id', 'id');
   }

    #[Scope]
    public function whereBranch($query, string $branchId)
    {
        $query->when($branchId != '*', function ($query) use ($branchId) {
            $query->whereExists(function ($sub) use ($branchId) {
                $sub->selectRaw(1)
                    ->from('teacher_branches as tb')
                    ->whereColumn('tb.teacher_id', 'teachers.id')
                    ->where('tb.branch_id', $branchId)
                    ->whereNull('tb.deleted_at');
            });
        })
        ->when($branchId == '*' && Auth::user()?->manage_branch == 2, function ($query) {
            $query->whereExists(function ($sub) {
                $sub->selectRaw(1)
                    ->from('teacher_branches as tb')
                    ->join('user_branches as ub', 'ub.branch_id', 'tb.branch_id')
                    ->whereColumn('tb.teacher_id', 'teachers.id')
                    ->where('ub.user_id', Auth::id())
                    ->whereNull('tb.deleted_at');
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
                    ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%');
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
}
