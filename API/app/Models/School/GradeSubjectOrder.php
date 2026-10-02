<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradeSubjectOrder extends Model
{
    protected $table = 'grade_subject_orders';

    protected $fillable = [
        'grade_id',
        'subject_id',
        'sort',
        'cur_id',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
