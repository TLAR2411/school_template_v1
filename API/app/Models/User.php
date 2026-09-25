<?php

namespace App\Models;

use App\Models\Address\Village;
use App\Models\Auth\PermissionUser;
use App\Models\Auth\Position;
use App\Models\Auth\Role;
use App\Models\Auth\UserBranch;
use App\Models\Core\Branch;
use App\Models\School\Teacher;
use App\Traits\TracksUserActions;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements LaratrustUser
{
    use HasFactory, Notifiable, HasRolesAndPermissions, HasApiTokens, TracksUserActions, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name_kh',
        'name_en',
        'email',
        'password',
        'username',
        'is_super',
        'is_active',
        'under_user_id',
        'manage_branch',
        'branch_id',
        'role_id',
        'position_id',
        'gender',
        'contact',
        'national_id_number',
        'national_id_issue_date',
        'join_date',
        'village_code',
        'dob',
        'default_part',
        'image_path',
        'parent_user_id',
        'type',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'created_at',
        'updated_at',
        'deleted_by',
        'created_by',
        'updated_by'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Automatically hash the password when it is set.
     *
     * @param string $value
     * @return void
     */
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()                   // Log all attributes
            ->useLogName('users')  // Optional log name
            ->dontSubmitEmptyLogs();     // Avoid empty logs
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        // ✅ Get the user's Khmer name or fallback to 'System'
        $userName = auth()->user()?->name_kh ?? 'System';

        // ✅ Translate the action
        $action = match ($eventName) {
            'created' => 'បង្កើត',
            'updated' => 'កែប្រែ',
            'deleted' => 'លុប',
            default => 'ធ្វើប្រតិបត្តិការលើ',
        };

        // ✅ Build the activity description
        $activity->description = "{$userName} បាន{$action} អ្នកប្រើប្រាស់ {$this->name_kh} {$this->code}";
    }

    #[Scope]
    public function whereBranch($query, string $branchId)
    {
        $query->when($branchId != "*", function ($query) use ($branchId) {
            return $query->where('users.branch_id', $branchId);
        })
            ->when($branchId == "*" && Auth::user()->manage_branch == 2, function ($query) use ($branchId) {
                return $query->join("user_branches as ub", 'ub.branch_id', 'users.branch_id')
                    ->where('ub.user_id', Auth::id());
            })
            ->when($branchId == "*" && Auth::user()->manage_branch == 4, function ($query) {
                return $query->whereNotIn('users.branch_id', function ($subquery) {
                    $subquery->select('branch_id')
                        ->from('user_branches')
                        ->where('user_id', Auth::id());
                });
            });
    }

    #[Scope]
    public function filter($query, array $filters)
    {
        $query->when(!empty($filters['search']), function ($query) use ($filters) {
            return $query->where(function ($q) use ($filters) {
                $searchTerm = '%' . trim($filters['search']) . '%';
                return $q->where('name_kh', 'like', $searchTerm)
                    ->orWhere('code', 'like', $searchTerm)
                    ->orWhere('name_en', 'like', $searchTerm)
                    ->orWhere('username', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        });
        $query->when(!empty($filters['user_type']), function ($query) use ($filters) {
            // T-... / S-... / FM-...
            return $query->where('code', 'like', $filters['user_type'] . '-%');
        });
    }

    public function findForPassport(string $username)
    {
        return $this->where('username', $username)->orWhere('email', $username)->first();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function underUser()
    {
        return $this->belongsTo(User::class, 'under_user_id', 'id');
    }

    public function userPermission()
    {
        return $this->hasMany(PermissionUser::class);
    }

    public function userBranch()
    {
        return $this->hasMany(UserBranch::class, 'user_id', 'id');
    }

    public function mainUser()
    {
        return $this->belongsTo(User::class, 'parent_user_id')
            ->where('is_active', true)
            ->orderByDesc('created_at');
    }

    public function subUsers()
    {
        return $this->hasMany(User::class, 'parent_user_id')
            ->where('id', '!=', auth()->id())
            ->where('is_active', true)
            ->orderByDesc('created_at');
    }

    public function siblings()
    {
        return $this->hasMany(User::class, 'parent_user_id', 'parent_user_id')
            ->where('id', '!=', auth()->id())
            ->where('is_active', true)
            ->orderByDesc('created_at');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    public function isTeacher(): bool
    {
        return $this->hasRole('teacher') || $this->role?->name === 'teacher';
    }

    public function assignedCurriculumId(): ?int
    {
        if (!$this->isTeacher()) {
            return null;
        }

        $curId = $this->teacher?->cur_id;

        return $curId ? (int) $curId : null;
    }
}
