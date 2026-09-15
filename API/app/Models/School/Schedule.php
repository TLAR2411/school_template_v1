<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'class_id',
        'subject_id',
        'color',
        'day_id',
        'start',
        'end',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    /** True if another period on same class+day overlaps */
    public static function hasOverlap(
        int $classId,
        int $dayId,
        string $start,
        string $end,
        ?int $ignoreId = null
    ): bool {
        return static::query()
            ->where('class_id', $classId)
            ->where('day_id', $dayId)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('start', '<', $end)
            ->where('end', '>', $start)
            ->exists();
    }
}