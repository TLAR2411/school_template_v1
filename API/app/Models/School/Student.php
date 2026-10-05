<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\School\StudentClass;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use LogsActivity;

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()          // only changed fields on update
            ->useLogName('years')
            ->dontSubmitEmptyLogs();
    }
    public function tapActivity(Activity $activity, string $eventName)
    {
        $userName = auth()->user()?->name_kh ?? 'System';
        $action = match ($eventName) {
            'created' => 'បង្កើត',
            'updated' => 'កែប្រែ',
            'deleted' => 'លុប',
            default => 'ធ្វើប្រតិបត្តិការលើ',
        };
        $activity->description = "{$userName} បាន{$action} សិស្ស {$this->name}";
    }

    use SoftDeletes;
    protected $fillable = [
        'name_en',
        'name_kh',
        'dob',
        'gender',
        'nation',
        'phone',
        'email',
        'branch_id',
        'village_code',
        'commune_code',
        'district_code',
        'province_code',
        'b_village_code',
        'b_commune_code',
        'b_district_code',
        'b_province_code',
        'is_active',
        'photo_path',
        'created_by',
        'updated_by',
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
        'dob' => 'date:Y-m-d',
        'is_active' => 'boolean',
    ];

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
    public function whereBranch($query, string $branchId)
    {
        $query->when($branchId != "*", function ($query) use ($branchId) {
            return $query->where('students.branch_id', $branchId);
        })
            ->when($branchId == "*" && Auth::user()->manage_branch == 2, function ($query) {
                $query->whereExists(function ($sub) {
                    $sub->selectRaw(1)
                        ->from('user_branches as ub')
                        ->whereColumn('ub.branch_id', 'students.branch_id')
                        ->where('ub.user_id', Auth::id());
                });
            });
    }

    public function curriculums()
    {
        return $this->belongsToMany(Curriculum::class, 'student_curriculums')
            ->withPivot('created_by', 'updated_by', 'deleted_by', 'deleted_at', 'is_active', 'is_transfer', 'is_graduate', 'start_date', 'end_date')
            ->withTimestamps();
    }

    public function studentCurriculums()
    {
        return $this->hasMany(StudentCurriculum::class);
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

    #[Scope]
    public function whereCur($query, $curriculumId)
    {
        return $query->when($curriculumId && $curriculumId !== '*', function ($q) use ($curriculumId) {
            $q->whereHas('studentCurriculums', function ($g) use ($curriculumId) {
                $g->where('curriculum_id', $curriculumId);
            });
        });
    }

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class, 'student_id');
    }
}
