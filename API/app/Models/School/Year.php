<?php

namespace App\Models\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;


class Year extends Model
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
        $activity->description = "{$userName} បាន{$action} ឆ្នាំសិក្សា {$this->name}";
    }


    protected $table = 'years';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    #[Scope]
    public function filter($query, $filters)
    {
        return $query->when(!empty($filters['search']), function ($q) use ($filters) {
            $q->where('name', 'like', '%' . $filters['search'] . '%');
        });
    }
}
